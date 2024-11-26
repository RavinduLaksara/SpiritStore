<?php
include('../dbconnect.php');
include('../Headers/customerHeader.php');

// Initialize variables
$cartDetails = [];
$totalAmount = 0;

if (isset($_SESSION['userid'])) {
    // Handle logged-in users
    $customerID = $_SESSION['userid'];

    // Modified SQL query to handle multiple stores for the same product
    $sql = "SELECT cartitem.ProductID, cartitem.StoreID, cartitem.Quantity, 
                   product.Name, product.photo, storeproduct.Price 
            FROM cartitem
            INNER JOIN cart ON cart.cartID = cartitem.cartID
            INNER JOIN product ON product.ProductID = cartitem.ProductID
            INNER JOIN storeproduct ON storeproduct.ProductID = cartitem.ProductID 
            AND storeproduct.StoreID = cartitem.StoreID  -- Ensure StoreID matches
            WHERE cart.customerID = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $customerID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['quantity'] = $row['Quantity']; // Normalize the key
            unset($row['Quantity']); // Optional: Remove the original key if not needed
            $row['subtotal'] = $row['Price'] * $row['quantity'];
            $cartDetails[] = $row;
            $totalAmount += $row['subtotal'];
        }
    }

    $stmt->close();
} elseif (!empty($_SESSION['cart'])) {
    // Handle guest users
    foreach ($_SESSION['cart'] as $item) {
        if (isset($item['productID'], $item['storeID'], $item['quantity'])) {
            $productID = $item['productID'];
            $storeID = $item['storeID'];
            $quantity = $item['quantity'];

            // Modified query to handle the StoreID for guest users as well
            $sql = "SELECT product.ProductID, product.Name, product.photo, storeproduct.Price 
                    FROM product
                    INNER JOIN storeproduct ON product.ProductID = storeproduct.ProductID
                    WHERE product.ProductID = ? AND storeproduct.StoreID = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param('ii', $productID, $storeID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $product['quantity'] = $quantity;
                $product['StoreID'] = $storeID; // Add StoreID
                $product['subtotal'] = $product['Price'] * $quantity;
                $cartDetails[] = $product;
                $totalAmount += $product['subtotal'];
            }

            $stmt->close();
        }
    }
}

// Store cart details in session for later use
$_SESSION['cartDetails'] = $cartDetails;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- <link rel="stylesheet" href="../styles/checkout.css"> -->
    <style>
        .checkout-container {
            margin-top: 0;
            height: 100vh;
            background-image: url('../image/login\ page\ image.jpg');
            /* Fixed the URL to avoid spaces */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h2 {
            text-align: center;
        }

        .form-container {
            display: flex;
            /* Ensure elements are aligned side-by-side */
            justify-content: space-between;
            /* Add space between the sections */
            align-items: flex-start;
            /* Align items at the top */
            width: 90%;
            /* Width as a percentage for responsiveness */
            max-width: 1200px;
            /* Set a maximum width */
            gap: 40px;
        }


        .billing-details {
            flex: 1;
            /* Flexible width */
            padding: 30px;
            gap: 10px;
            /* Add space between sections */
            backdrop-filter: blur(10px);
            background-color: rgba(156, 141, 141, 0.75);
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Order Summary Section - Left */
        .order-summary {
            flex: 1;
            /* Flexible width */
            padding: 20px;
            gap: 10px;
            /* Add space between sections */
            backdrop-filter: blur(10px);
            background-color: rgba(156, 141, 141, 0.75);
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }


        /* Input Fields */
        .input-box {
            position: relative;
            margin: 20px 0;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 14px;
            color: black;
            transition: 0.3s;
        }

        .input-box input {
            width: 100%;
            padding: 10px 10px;
            background: transparent;
            border: none;
            border-bottom: 2px solid rgba(0, 0, 0, 0.5);
            outline: none;
            font-size: 16px;
            color: black;
        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: -10px;
            font-size: 12px;
            color: #1f1d2b;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        button:hover {
            background: #333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                flex-direction: row;
                /* Keep side-by-side layout until necessary */
                flex-wrap: wrap;
                /* Allow wrapping if space becomes tight */
                gap: 10px;
                /* Adjust spacing for smaller screens */
            }

            .order-summary,
            .billing-details {
                flex: 1 1 48%;
                /* Take up roughly half the width */
                min-width: 300px;
                /* Ensure minimum width for readability */
            }
        }

        @media (max-width: 576px) {
            .form-container {
                flex-direction: column;
                /* Stack vertically for very small screens */
            }

            .order-summary,
            .billing-details {
                flex: 1 1 100%;
                /* Take full width when stacked */
            }
        }
    </style>
</head>

<body>
    <div class="checkout-container">
        <div class="form-container">

            <div class="order-summary">
                <h2>Your Order</h2>
                <div class="order-items">
                    <?php if (empty($cartDetails)) : ?>
                        <p>Your cart is empty.</p>
                    <?php else : ?>
                        <?php foreach ($cartDetails as $item) : ?>
                            <div class="order-item">
                                <img src="<?php echo htmlspecialchars($item['photo']); ?>" alt="Product image" width="50" height="50">
                                <p><?php echo htmlspecialchars($item['Name']); ?></p>
                                <p>Quantity: <?php echo $item['quantity']; ?></p>
                                <p>Subtotal: LKR <?php echo number_format($item['subtotal'], 2); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="order-total">
                    <h3>Total: LKR <?php echo number_format($totalAmount, 2); ?></h3>
                </div>
            </div>
            <div class="billing-details">

                <h2>Billing Details</h2>
                <form action="process_order.php" method="POST">

                    <div class="input-box">
                        <input type="text" name="name" required>
                        <label for="name">Name *</label>
                    </div>

                    <div class="input-box">
                        <input type="text" name="street" required>
                        <label for="street">Street Address *</label>
                    </div>

                    <div class="input-box">
                        <input type="text" name="city" required>
                        <label for="city">Town / City *</label>
                    </div>

                    <div class="input-box">
                        <input type="tel" name="phone" id="phone" required>
                        <label for="phone">Phone *</label>
                    </div>

                    <!-- Hidden input to pass the total amount -->
                    <input type="hidden" name="totalAmount" value="<?php echo htmlspecialchars($totalAmount); ?>">

                    <button type="submit" class="place-order-button">Place Order</button>
                </form>
            </div>

        </div>
    </div>
    <?php include('../footer/footer.php') ?>
</body>

</html>