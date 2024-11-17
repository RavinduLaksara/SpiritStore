<?php
include(__DIR__ . '/../../dbconnect.php');
include('../../Headers\customerHeader.php');

if (!isset($_SESSION['userid'])) {
    header('Location: ../Forms/login.php');
    exit;
}

$customer_id = $_SESSION['userid'];

// Get order id
if (!isset($_GET['id'])) {
    header("Location: ../customer/orders.php");
    exit;
}

$order_id = $_GET['id'];

// get orser details
$sql = "SELECT * FROM orderdetails WHERE OrderID = '$order_id'";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <div class="left">

        <div class="nav-list">
            <a href="../../pages/customer_dashboard.php">Dashboard</a>
            <a href="../customer/orders.php">Orders</a>
            <a href="../customer/edit_details.php">Edit Details</a>
            <a href="../customer/logout.php">Log out</a>
        </div>

    </div>
    <div class="right">
        <table>
            <thead>
                <th>Product</th>
                <th>Quantity</th>
                <th>Sub Total</th>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    // get product name
                    $sql = "SELECT Name FROM product WHERE ProductID = '$row[ProductID]'";
                    $re = $connection->query($sql);
                    $r = $re->fetch_array();
                    $product_name = $r[0];

                    // display details
                    echo "
                        <tr>
                            <td>$product_name</td>
                            <td>$row[Quantity]</td>
                            <td>$row[SubTotal]</td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>