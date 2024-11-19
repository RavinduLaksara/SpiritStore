<?php

include(__DIR__ . '../../../dbconnect.php');
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
                        // get balance 
                        $sql = "SELECT name FROM store WHERE supplier_id = '$row[id]'";
                        $r = $connection->query($sql);
                        $re = $r->fetch_array();
                        $balance = $re[0];
                        echo "
                                <tr>
                                    <td>$row[name]</td>
                                    <td>$row[phone]</td>
                                    <td>$balance</td>
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
    background: #fff; /* White container */
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    background-color: #e6e6e6; /* Light gray background */
    color: #333; /* Dark gray text */
}


/* Heading */
h1 {
    font-size: 28px;
    color: #222; /* Black heading text */
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
    background-color: #444; /* Dark gray header */
    color: #fff; /* White header text */
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

tbody tr {
    background-color: #f9f9f9; /* Light gray rows */
    transition: all 0.3s ease;
}

tbody tr:nth-child(even) {
    background-color: #ececec; /* Slightly darker gray for alternating rows */
}

tbody tr:hover {
    background-color: #ddd; /* Highlight gray on hover */
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
    color: #444; /* Dark gray text */
    text-decoration: none;
    font-weight: bold;
    padding: 8px 12px;
    border: 1px solid #444; /* Dark gray border */
    border-radius: 4px;
    transition: all 0.3s ease;
}

#m a:hover {
    background-color: #444; /* Dark gray background */
    color: #fff; /* White text */
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
</body>

</html>