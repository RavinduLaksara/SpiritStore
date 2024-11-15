<?php
session_start();
include(__DIR__ . '/../dbconnect.php');

// Check if required data is set
if (!isset($_POST['productID']) || !isset($_POST['storeID']) || !isset($_POST['quantity']) || !isset($_POST['price'])) {
    header("Location: ../homepage.php");
    exit;
}

$productID = $_POST['productID'];
$storeID = $_POST['storeID'];
$quantity = (int)$_POST['quantity'];
$price = (float)$_POST['price'];
$subtotal = $price * $quantity;

// Check if the user is logged in
if (isset($_SESSION['userid'])) {
    // Logged-in user
    $customerID = $_SESSION['userid'];

    // Check if the user already has a cart
    $sql = "SELECT cartID FROM cart WHERE customerID = '$customerID'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Cart exists, get cart ID
        $cart = $result->fetch_assoc();
        $cartID = $cart['cartID'];
    } else {
        // No cart exists, create a new one
        $sql = "INSERT INTO cart (customerID, total) VALUES ('$customerID', 0)";
        if ($connection->query($sql) === TRUE) {
            $cartID = $connection->insert_id;
        } else {
            die("Error creating cart: " . $connection->error);
        }
    }

    // Check if product is already in cart
    $sql = "SELECT itemID FROM cartitem WHERE cartID = '$cartID' AND productID = '$productID' AND storeID = '$storeID'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Product already in cart, update quantity and subtotal
        $cartItem = $result->fetch_assoc();
        $sql = "UPDATE cartitem SET Quantity = Quantity + $quantity, subTotal = subTotal + $subtotal WHERE itemID = {$cartItem['itemID']}";
        $connection->query($sql);
    } else {
        // New product, add to cartItem table
        $sql = "INSERT INTO cartitem (cartID, productID, storeID, Quantity, subTotal) VALUES ('$cartID', '$productID', '$storeID', '$quantity', '$subtotal')";
        $connection->query($sql);
    }

    // Update the total in the cart table
    $sql = "UPDATE cart SET total = total + $subtotal WHERE cartID = '$cartID'";
    $connection->query($sql);

    echo "Product added to cart!";
} else {
    // Guest user (not logged in), store cart data in session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if product already exists in session cart
    $itemExists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['productID'] == $productID && $item['storeID'] == $storeID) {
            // Update existing item quantity and subtotal
            $item['quantity'] += $quantity;
            $item['subtotal'] += $subtotal;
            $itemExists = true;
            break;
        }
    }

    // If item does not exist, add it as a new item
    if (!$itemExists) {
        $_SESSION['cart'][] = [
            'productID' => $productID,
            'storeID' => $storeID,
            'quantity' => $quantity,
            'subtotal' => $subtotal
        ];
    }

    echo "Product added to cart for guest!";
}

header("Location: ../pages/products.php"); // Redirect to cart page after adding
exit;
