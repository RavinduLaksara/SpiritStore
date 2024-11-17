<?php
include(__DIR__ . '/../../dbconnect.php');
include('../../Headers/supplierHeadder.php');

if (!isset($_GET['id'])) {
    header("Location: ../../Forms/login.php");
    exit;
}

$supplier_id = $_GET['id'];

// Get approve status
$sql = "SELECT approve_status FROM supplier WHERE id = '$supplier_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();

if ($row[0] != 'yes') {
    header("Location: ../../pages/pending_approve.php");
    exit;
}

// Get supplier name
$sql = "SELECT name FROM supplier WHERE id = '$supplier_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$supplier_name = $row[0];

// Get store name
$sql = "SELECT name FROM store WHERE supplier_id = '$supplier_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$store_name = $row[0];

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
        <p><?php echo $store_name ?></p>
        <p><?php echo $supplier_name ?></p>
        <p>From your account dashboard you can manage your products, add new products, get details about orders and check your balance</p>
    </div>
</body>

</html>