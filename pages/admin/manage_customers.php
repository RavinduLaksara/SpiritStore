<?php

include(__DIR__ . '/../../dbconnect.php');
include(__DIR__ . '/../../Headers/adminHeader.php');

// get supplier details
$sql = "SELECT id, name, phone, city FROM customer";
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
        <div>
            <h1>Suppliers List</h1>
            <table>
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Phone No</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "
                                <tr>
                                    <td>$row[name]</td>
                                    <td>$row[phone]</td>
                                    <td>$row[city]</td>
                                    <td><a href = '../admin/edit_customer.php?id=$row[id]'>Edit</a></td>
                                    <td><a href = '#'>View Orders</a></td>
                                </tr>
                            ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>