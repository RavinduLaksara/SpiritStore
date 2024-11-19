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
    <div class="content">
        <h1><?php echo $store_name ?></h1>
        <h2><?php echo $supplier_name ?></h2>
        <h3>From your account  dashboard  you can manage your products,&nbsp; add new products,&nbsp; get details about orders and check your balance</h3>
    </div>
</body>
<style>

    * {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}

.content {
    
    margin-left: 230px;
    max-width: 1100px;
    width: 90%;
    padding: 20px;
    background: #fff; /* White container */
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    background-color: #e6e6e6; /* Light gray background */
    color: #333; /* Dark gray text */
}


/* Heading */
h1 {
    margin-top: 100px;
    bottom: 200px;
    font-size: 28px;
    color: #222; /* Black heading text */
    text-align: center;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

h2 {
    font-size: 24px;
    color: #222; /* Black heading text */
    text-align: center;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 1.2px;
}

h3 {
    font-size: 20px;
    color: #222; /* Black heading text */
    text-align: center;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
</style>

</html>