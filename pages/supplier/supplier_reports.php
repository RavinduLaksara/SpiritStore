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
    <title></title>
</head>

<body>
    <div>
        <div>
            <p>Total Products</p>
            <p><?php echo $products_count ?></p>
        </div>
        <div>
            <p>Total Orders</p>
            <p><?php echo $order_count ?></p>
        </div>
        <div>
            <p>Balance</p>
            <p><?php echo $balance ?></p>
        </div>
        <div>
            <p>Commission</p>
            <p><?php echo $commision ?></p>
        </div>
    </div>
</body>

</html>