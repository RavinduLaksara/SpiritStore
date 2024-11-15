<?php
include(__DIR__ . '/../dbconnect.php');
include('../Headers\customerHeader.php');

$cartItems = [];
$total = 0;

// Check if the user is logged in
if (isset($_SESSION['userid'])) {
    $customerID = $_SESSION['userid'];

    // Retrieve cart items from the database for logged-in users
    $sql = "SELECT cartitem.itemID, product.Name, product.photo, storeproduct.Price, cartitem.Quantity, 
            (storeproduct.Price * cartitem.quantity) AS subtotal
            FROM cartitem
            INNER JOIN cart ON cart.cartID = cartitem.cartID
            INNER JOIN product ON product.ProductID = cartitem.ProductID
            INNER JOIN storeproduct ON storeproduct.ProductID = cartitem.ProductID
            WHERE cart.customerID = '$customerID' 
            AND cartitem.StoreID = storeproduct.StoreID"; // Ensure product is from the specific store
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
            $total += $row['subtotal'];
        }
    }
} else {
    // For guest users, retrieve cart items from the session
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productID => $item) {
            // Retrieve store-specific product details for each item in the cart
            $storeID = $item['storeID'];
            $sql = "SELECT product.Name, product.photo, storeproduct.Price
                    FROM product
                    INNER JOIN storeproduct ON storeproduct.ProductID = product.ProductID
                    WHERE product.ProductID = '$productID' AND storeproduct.StoreID = '$storeID'";
            $result = $connection->query($sql);
            $product = $result->fetch_assoc();

            if ($product) {
                $product['quantity'] = $item['quantity'];
                $product['subtotal'] = $product['Price'] * $item['quantity'];
                $product['productID'] = $productID;
                $cartItems[] = $product;
                $total += $product['subtotal'];
            }
        }
    }
}

// Handle item deletion
if (isset($_GET['remove'])) {
    $productID = $_GET['remove'];
    $storeID = $_GET['storeID']; // Get the StoreID from the URL for specific removal

    if (isset($_SESSION['userid'])) {
        // Delete item from database cart for logged-in users
        $sql = "DELETE FROM cartitem WHERE ProductID = '$productID' AND StoreID = '$storeID' AND cartID = 
                (SELECT cartID FROM cart WHERE customerID = '$customerID')";
        $connection->query($sql);
    } else {
        // Remove item from session cart for guest users
        unset($_SESSION['cart'][$productID]);
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
    <!-- Link your stylesheet here -->
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
                            <td><img src="../<?= $item['photo'] ?>" alt="<?= $item['Name'] ?>" width="50" height="50"></td>
                            <td><?= $item['Name'] ?></td>
                            <td>Rs. <?= $item['Price'] ?></td>
                            <td><?= $item['Quantity'] ?></td>
                            <td>Rs. <?= $item['subtotal'] ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-total">
                <h3>Total: Rs. <?= $total ?></h3>
            </div>

            <div class="cart-actions">
                <a href="checkout.php" class="checkout-button">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>