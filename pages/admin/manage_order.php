<?php

include(__DIR__ . '/../../dbconnect.php');
include(__DIR__ . '/../../Headers/adminHeader.php');

// Get details
$sql = "SELECT * FROM orderdetails";
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
    <h1>Order details</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Sub Total</th>
                <th>Store Name</th>
                <th>Customer Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                // Get date
                $sql = "SELECT OrderDate, CustomerID FROM orders WHERE OrderID = '$row[OrderID]'";
                $re = $connection->query($sql);
                $r = $re->fetch_array();
                $date = $r[0];
                $customer_id = $r[1];

                // Get product name
                $sql = "SELECT Name FROM product WHERE ProductID = '$row[ProductID]'";
                $re = $connection->query($sql);
                $r = $re->fetch_array();
                $product_name = $r[0];

                // Get Customer Name
                $sql = "SELECT name FROM customer WHERE id = '$customer_id'";
                $re = $connection->query($sql);
                $r = $re->fetch_array();
                $customer_name = $r[0];

                // get store name
                $sql = "SELECT name FROM store WHERE store_id = '$row[storeID]'";
                $re = $connection->query($sql);
                $r = $re->fetch_array();
                $store_name = $r[0];

                // display details
                echo "
                        <tr>
                            <td>$date</td>
                            <td>$product_name</td>
                            <td>$row[Quantity]</td>
                            <td>$row[SubTotal]</td>
                            <td>$store_name</td>
                            <td>$customer_name</td>
                        </tr>
                    ";
            }
            ?>
        </tbody>
    </table>
</body>

</html>