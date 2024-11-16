<?php
include(__DIR__ . '/../../dbconnect.php');

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
