<?php
include(__DIR__ . '/../dbconnect.php');
include('../Headers\customerHeader.php');

if (!isset($_SESSION['userid'])) {
    header('Location: ../Forms/login.php');
    exit;
}

$customer_id = $_SESSION['userid'];

// Get customer name
$sql = "SELECT name FROM customer WHERE id = '$customer_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$customer_name = $row[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
</head>

<body>
    <h1>My Account</h1>
    <div class="left">
        <div class="nav-list">
            <a href="#">Dashboard</a>
            <a href="../pages/customer/orders.php">Orders</a>
            <a href="../pages/customer/edit_details.php">Edit Details</a>
            <a href="../pages/customer/logout.php">Log out</a>
        </div>
    </div>
    <div class="right">
        <p>Hello <?php echo $customer_name; ?></p>
        <p>From your account dashboard you can view your recent orders, manage your shipping addresses, and edit your account details.</p>
    </div>
</body>

</html>