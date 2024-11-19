<?php
include(__DIR__ . '/../../dbconnect.php');
include('../../Headers/customerHeader.php');

if (!isset($_SESSION['userid'])) {
    header('Location: ../Forms/login.php');
    exit;
}

$customer_id = $_SESSION['userid'];

// Get order details
$sql = "SELECT * FROM orders WHERE CustomerID = '$customer_id'";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #000000;
        }

        table a {
            text-decoration: none;
            color: #000;
        }

        .container {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            gap: 20px;
        }

        .left {
            width: 25%;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .left .nav-list a {
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            color: #000000;
            text-decoration: none;
            font-size: 1.1em;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .left .nav-list a:hover {
            background-color: #f0f0f0;
        }

        .right {
            width: 75%;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .right table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .right table thead {
            background-color: #000;
            color: #ffffff;
        }

        .right table thead th {
            padding: 10px;
            text-align: left;
            font-size: 1em;
        }

        .right table tbody tr {
            border-bottom: 1px solid #ddd;
        }

        .right table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .right table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .right table tbody td {
            padding: 10px;
            font-size: 0.9em;
        }

        .right table tbody td:last-child {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left">
            <div class="nav-list">
                <a href="../../pages/customer_dashboard.php">Dashboard</a>
                <a href="../customer/orders.php">Orders</a>
                <a href="../customer/edit_details.php">Edit Details</a>
                <a href="../customer/logout.php">Log out</a>
            </div>
        </div>

        <!-- Right Section -->
        <div class="right">
            <?php
            if ($result->num_rows == 0) {
                echo "<p>No order has been made yet.</p>";
            } else {
                echo "
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total Amount</th>
                                <th>Street</th>
                                <th>City</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                    ";
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['OrderDate']}</td>
                        <td>RS. {$row['TotalAmount']}</td>
                        <td>{$row['street']}</td>
                        <td>{$row['city']}</td>
                        <td><a href='../customer/order_info.php?id={$row['OrderID']}'>View all details</a></td>
                    </tr>
                    ";
                }
                echo "
                        </tbody>
                    </table>
                ";
            }
            ?>
        </div>
    </div>
</body>

</html>