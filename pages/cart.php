<?php

include(__DIR__ . '/../dbconnect.php');
include('../Headers/customerHeader.php');

$cartItems = [];
$total = 0;

// Check if the user is logged in
if (isset($_SESSION['userid'])) {
    $customerID = $_SESSION['userid'];

    // Retrieve cart items from the database for logged-in users
    $sql = "SELECT cartitem.itemID, product.Name, product.photo, storeproduct.Price, cartitem.Quantity, 
            (storeproduct.Price * cartitem.Quantity) AS subtotal
            FROM cartitem
            INNER JOIN cart ON cart.cartID = cartitem.cartID
            INNER JOIN product ON product.ProductID = cartitem.ProductID
            INNER JOIN storeproduct ON storeproduct.ProductID = cartitem.ProductID
            WHERE cart.customerID = ? AND cartitem.StoreID = storeproduct.StoreID";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $customerID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['quantity'] = $row['Quantity']; // Normalize the key
            unset($row['Quantity']); // Optional: Remove the original key if not needed
            $row['subtotal'] = $row['Price'] * $row['quantity'];
            $cartItems[] = $row;
            $total += $row['subtotal'];
        }
    }
    $stmt->close();
} else {
    // For guest users, retrieve cart items from the session
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            if (isset($item['productID'], $item['storeID'], $item['quantity'])) {
                $productID = $item['productID'];
                $storeID = $item['storeID'];
                $quantity = $item['quantity'];

                $sql = "SELECT product.ProductID, product.Name, product.photo, storeproduct.Price 
                        FROM product
                        INNER JOIN storeproduct ON product.ProductID = storeproduct.ProductID
                        WHERE product.ProductID = ? AND storeproduct.StoreID = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param('ii', $productID, $storeID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $product = $result->fetch_assoc();
                    $product['itemID'] = $item['itemID'] ?? null; // Make sure itemID exists, if not, set it as null
                    $product['quantity'] = $quantity;
                    $product['subtotal'] = $product['Price'] * $quantity;
                    $cartItems[] = $product;
                    $total += $product['subtotal'];
                }
                $stmt->close();
            }
        }
    }
}

// Handle item deletion
if (isset($_GET['remove']) && isset($_GET['itemID'])) {
    $itemID = $_GET['itemID'];

    if (isset($_SESSION['userid'])) {
        $sql = "DELETE FROM cartitem WHERE itemID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('i', $itemID);
        $stmt->execute();
        $stmt->close();
    } else {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['itemID'] == $itemID) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>

<body>
    <h1>Your Cart</h1>

    <div class="cart-container">

        <?php if (empty($cartItems)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($item['photo'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($item['Name'] ?? 'No Name') ?>" width="50" height="50"></td>
                            <td><?= htmlspecialchars($item['Name'] ?? 'Unknown Product') ?></td>
                            <td>Rs. <?= number_format($item['Price'], 2) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>Rs. <?= number_format($item['subtotal'], 2) ?></td>
                            <td><a href="cart.php?remove=1&itemID=<?= htmlspecialchars($item['itemID'] ?? '') ?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Total: Rs. <?= number_format($total, 2) ?></h3>
            <div class="cart-actions">
                <a href="checkout.php" class="checkout-button">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
    <?php include('../footer/footer.php') ?>
</body>

</html>