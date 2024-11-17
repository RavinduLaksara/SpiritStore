<?php
include('../dbconnect.php');
include('../Headers\customerHeader.php');

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
    <link rel="stylesheet" href="../styles/checkout.css">
</head>

<body>
    <div class="checkout-container">
        <div class="billing-details">
            <h2>Billing Details</h2>
            <form action="process_order.php" method="POST">
                <label for="name">Name *</label>
                <input type="text" name="name" required>

                <label for="street">Street Address *</label>
                <input type="text" name="street" placeholder="Street name" required>

                <label for="city">Town / City *</label>
                <input type="text" name="city" required>

                <label for="phone">Phone *</label>
                <input type="tel" name="phone" id="phone" required>

                <!-- Hidden input to pass the total amount -->
                <input type="hidden" name="totalAmount" value="<?php echo htmlspecialchars($totalAmount); ?>">

                <button type="submit" class="place-order-button">Place Order</button>
            </form>
        </div>

        <div class="order-summary">
            <h2>Your Order</h2>
            <div class="order-items">
                <?php if (empty($cartDetails)) : ?>
                    <p>Your cart is empty.</p>
                <?php else : ?>
                    <?php foreach ($cartDetails as $item) : ?>
                        <div class="order-item">
                            <img src="../<?php echo htmlspecialchars($item['photo']); ?>" alt="Product image" width="50" height="50">
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
    </div>
</body>

</html>