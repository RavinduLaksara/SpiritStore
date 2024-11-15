<?php
include(__DIR__ . '/../dbconnect.php');
include('../Headers\customerHeader.php');

// Check if user is logged in and has items in the cart
if (!isset($_SESSION['userid']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Fetch user and cart details
$customerID = $_SESSION['userid'];
$totalAmount = 0; // Set to 0 initially, and calculate based on the cart items

// Calculate total amount
foreach ($_SESSION['cart'] as $productID => $item) {
    $totalAmount += $item['subtotal'];
}

// Get customer data
$sql = "SELECT * FROM customer WHERE id = '$customerID'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$state = $row['state'];
$city = $row['city'];
$postal_code = $row['postal_code'];

// PayHere sandbox details
$merchantID = "1228639"; // Use your Sandbox Merchant ID here
$returnURL = "../homepage.php"; // Replace with your return URL
$cancelURL = "../pages/cart.php"; // Replace with your cancel URL
$notifyURL = "http://yourdomain.com/notify"; // Replace with your notify URL

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>

<body>

    <h1>Checkout</h1>

    <!-- PayHere Payment Form -->
    <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
        <!-- Merchant Details -->
        <input type="hidden" name="merchant_id" value="<?= $merchantID ?>"> <!-- Sandbox Merchant ID -->
        <input type="hidden" name="return_url" value="<?= $returnURL ?>">
        <input type="hidden" name="cancel_url" value="<?= $cancelURL ?>">
        <input type="hidden" name="notify_url" value="<?= $notifyURL ?>">

        <!-- Order Details -->
        <input type="hidden" name="order_id" value="ORDER12345"> <!-- Use a unique order ID for each transaction -->
        <input type="hidden" name="items" value="Order from Spirit Store">
        <input type="hidden" name="currency" value="LKR">
        <input type="hidden" name="amount" value="<?= $totalAmount ?>">

        <!-- Customer Details -->
        <input type="hidden" name="first_name" value="<?= $firstName ?>">
        <input type="hidden" name="last_name" value="<?= $lastName ?>">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="phone" value="<?= $phone ?>">
        <input type="hidden" name="address" value="<?= $address ?>">
        <input type="hidden" name="city" value="<?= $city ?>">
        <input type="hidden" name="country" value="<?= $country ?>">

        <button type="submit">Pay Now with PayHere</button>
    </form>

</body>

</html>