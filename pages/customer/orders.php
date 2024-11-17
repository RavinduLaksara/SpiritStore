<?php
include(__DIR__ . '/../../dbconnect.php');
include('../../Headers\customerHeader.php');

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

</html>