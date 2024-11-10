<?php
include(__DIR__ . '/../dbconnect.php');

if (!isset($_GET['productID']) && !isset($_GET['storeID'])) {
    header("Location: ../pages\supplier-dashboard.php");
    exit;
}

$productID = $_GET['productID'];
$storeID = $_GET['storeID'];

$sql = "DELETE FROM storeproduct WHERE StoreID = '$storeID' AND ProductID = '$productID'";
$result = $connection->query($sql);

if (!$result) {
    echo "Invalid Query";
}

// Get supplier id
$sql = "SELECT supplier_id FROM store WHERE store_id = '$storeID'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$supplier_id = $row[0];

header("Location: ../pages\supplier-dashboard.php?id=" . $supplier_id);
exit;
