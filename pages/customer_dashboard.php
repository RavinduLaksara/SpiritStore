<?php
include(__DIR__ . '/../dbconnect.php');
include('../Headers/customerHeader.php');

// get customer name
if (!isset($_SESSION['userid'])) {
    header("Location: ../Forms/login.php");
    exit;
}

$customer_id = $_SESSION['userid'];
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            /* Set white background */
            color: #000000;
            /* Ensure text is black */
        }

        h1 {
            font-size: 2.5em;
            margin: 20px;
            color: #000000;
            /* Black header text */
        }

        .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            gap: 20px;
        }

        .left {
            width: 25%;
            background-color: #ffffff;
            /* White background for menu */
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .left .nav-list a {
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            color: #000000;
            /* Black text for links */
            text-decoration: none;
            font-size: 1.1em;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .left .nav-list a:hover {
            background-color: #f0f0f0;
            /* Light gray hover effect */
            color: #000000;
            /* Keep text black on hover */
        }

        .right {
            width: 75%;
            background-color: #ffffff;
            /* White background for content */
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .right p {
            margin: 10px 0;
            font-size: 1.1em;
            color: #000000;
            /* Black text for content */
        }

        .right p a {
            color: #0073aa;
            /* Blue for inline links */
            text-decoration: none;
        }

        .right p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>My Account</h1>
    <div class="container">
        <div class="left">
            <div class="nav-list">
                <a href="#">Dashboard</a>
                <a href="../pages/customer/orders.php">Orders</a>
                <a href="../pages/customer/edit_details.php">Edit Details</a>
                <a href="../pages/customer/logout.php">Log out</a>
            </div>
        </div>
        <div class="right">
            <p>Hello <strong><?php echo $customer_name; ?></strong></p>
            <p>
                From your account dashboard you can view your recent orders, manage your shipping addresses and edit your account details.
            </p>
        </div>
    </div>