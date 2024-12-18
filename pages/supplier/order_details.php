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

// Get details
$sql = "SELECT * FROM orderdetails WHERE storeID = '$store_id'";
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
    <div class="content">
        <h1>Order Details</h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>

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

                    // Get customer name
                    // $sql = "SELECT name FROM customer WHERE id = '$customer_id'";
                    // $re = $connection->query($sql);
                    // $r = $re->fetch_array();
                    // $customer_name = $r[0];

                    // Display details
                    echo "
                    <tr>
                        <td>$date</td>
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
        background: #fff;
        /* White container */
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        background-color: #e6e6e6;
        /* Light gray background */
        color: #333;
        /* Dark gray text */
    }


    /* Heading */
    h1 {
        font-size: 28px;
        color: #222;
        /* Black heading text */
        text-align: center;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    table th,
    table td {
        padding: 15px 20px;
        text-align: center;
        border: none;
    }

    thead {
        background-color: #444;
        /* Dark gray header */
        color: #fff;
        /* White header text */
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    tbody tr {
        background-color: #f9f9f9;
        /* Light gray rows */
        transition: all 0.3s ease;
    }

    tbody tr:nth-child(even) {
        background-color: #ececec;
        /* Slightly darker gray for alternating rows */
    }

    tbody tr:hover {
        background-color: #ddd;
        /* Highlight gray on hover */
        transform: scale(1.02);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    table th:first-child,
    table td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    table th:last-child,
    table td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    /* Action Links */
    #m a {
        color: #444;
        /* Dark gray text */
        text-decoration: none;
        font-weight: bold;
        padding: 8px 12px;
        border: 1px solid #444;
        /* Dark gray border */
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    #m a:hover {
        background-color: #444;
        /* Dark gray background */
        color: #fff;
        /* White text */
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            width: 100%;
            padding: 15px;
        }

        table th,
        table td {
            font-size: 14px;
            padding: 10px;
        }

        h1 {
            font-size: 22px;
        }
    }
</style>

</html>