<?php

include(__DIR__ . '/../../dbconnect.php');
include('../../Headers\customerHeader.php');

if (!isset($_SESSION['userid'])) {
    header("Location: ../forms/login.php");
    exit;
}

$customer_id = $_SESSION['userid'];

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
    <div class="left">
        <div class="nav-list">
            <a href="../../pages/customer_dashboard.php">Dashboard</a>
            <a href="../customer/orders.php">Orders</a>
            <a href="../customer/edit_details.php">Edit Details</a>
            <a href="../customer/logout.php">Log out</a>
        </div>
    </div>
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
                            <th>Strret</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <tbody>
                ";
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>$row[OrderDate]</td>
                    <td>$row[TotalAmount]</td>
                    <td>$row[street]</td>
                    <td>$row[city]</td>
                    <td><a href = '../customer/order_info.php?id= $row[OrderID]'>View all details</a></td>
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
</body>
<style>
    /* managesupplier.css */

    /* General styles */
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
</style>

</html>