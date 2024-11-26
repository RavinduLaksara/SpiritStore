<?php

include('../../Headers/supplierHeadder.php');
include(__DIR__ . '../../../dbconnect.php');

if (!isset($_SESSION['userid'])) {
    header("Location: Forms/login.php");
    exit;
}

$supplier_id = $_SESSION['userid'];

// Get store id
$sql = "SELECT store_id FROM store WHERE supplier_id = '$supplier_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$store_id = $row[0];

// total products
$sql = "SELECT COUNT(*) FROM storeproduct WHERE StoreID = '$store_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$products_count = $row[0];

// total orders
$sql = "SELECT COUNT(*) FROM orderdetails WHERE storeID = '$store_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$order_count = $row[0];

// balance & commision
$sql = "SELECT balance, commision FROM store WHERE store_id = '$store_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$balance = $row[0];
$commision = $row[1];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Dashboard</title>

    <style>
        * {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;

        }

        .container {
            margin-left: 500px;
            height: 100vh;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            width: 80%;
            max-width: 600px;
        }

        .box {
            height: 100px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        .box p:first-child {
            font-size: 18px;
            font-weight: bold;
            color: #555;
            margin: 0;
        }

        .box p:last-child {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 5px 0 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <p>Total Products</p>
            <p><?php echo $products_count ?></p>
        </div>
        <div class="box">
            <p>Total Orders</p>
            <p><?php echo $order_count ?></p>
        </div>
        <div class="box">
            <p>Balance</p>
            <p><?php echo $balance ?></p>
        </div>
        <div class="box">
            <p>Commission</p>
            <p><?php echo $commision ?></p>
        </div>
    </div>
</body>

</html>