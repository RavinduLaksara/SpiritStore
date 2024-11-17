<?php

include(__DIR__ . '/../../dbconnect.php');
include(__DIR__ . '/../../Headers/adminHeader.php');

// get supplier details
$sql = "SELECT id, name, phone, approve_status FROM supplier";
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
                        <th>Supplier Name</th>
                        <th>Phone No</th>
                        <th>Balance</th>
                        <th>Approve Status</th>
                        <th>View all details</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "
                                <tr>
                                    <td>$row[name]</td>
                                    <td>$row[phone]</td>
                                    <td>$row[approve_status]</td>
                                    <td><a href = '../admin/view_supplier.php?id=$row[id]'>View all</a></td>
                                    <td><a href = '../../Forms/edit_supplier_details.php?id=$row[id]'>Update</a></td>
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