<?php
include(__DIR__ . '/../../dbconnect.php');

if (!isset($_GET['id'])) {
    header("Location: ../admin_dashboard.php");
    exit;
}

$productID = $_GET['id'];

$sql = "DELETE FROM product WHERE ProductID = '$productID'";
$result = $connection->query($sql);

header("Location: ../admin_dashboard.php");
exit;
