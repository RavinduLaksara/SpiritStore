<?php

include(__DIR__ . '/../../dbconnect.php');
include(__DIR__ . '/../../Headers/adminHeader.php');

if (!isset($_GET['id'])) {
    header("Location: ../manage_suppliers.php");
    exit;
}

$supplier_id = $_GET['id'];

// Get supplier data
$sql = "SELECT * from supplier WHERE id = '$supplier_id'";
$result = $connection->query($sql);
$row_supplier = $result->fetch_assoc();

// Get store data
$sql = "SELECT * FROM store WHERE supplier_id = '$supplier_id'";
$result = $connection->query($sql);
$row_store = $result->fetch_assoc();

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
        <h1>Supplier Details</h1>
        <div class="details">
            <table>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $row_supplier['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $row_supplier['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Phone no</td>
                        <td><?php echo $row_supplier['phone'] ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?php echo $row_supplier['city'] ?></td>
                    </tr>
                    <tr>
                        <td>License Type</td>
                        <td><?php echo $row_supplier['license_type'] ?></td>
                    </tr>
                    <tr>
                        <td>License No</td>
                        <td><?php echo $row_supplier['license_no'] ?></td>
                    </tr>
                    <tr>
                        <td>Approve Status</td>
                        <td><?php echo $row_supplier['approve_status'] ?></td>
                    </tr>
                    <tr>
                        <td>Balance</td>
                        <td><?php echo $row_supplier['balance'] ?></td>
                    </tr>
                    <tr>
                        <td>Commision</td>
                        <td><?php echo $row_supplier['commision'] ?></td>
                    </tr>
                </tbody>
            </table>

            <h1>Store Details</h1>
            <table>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $row_store['name'] ?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $row_store['state'] ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?php echo $row_store['city'] ?></td>
                    </tr>
                </tbody>
            </table>
            <a href='../../Forms/edit_supplier_details.php?id=<?php echo $supplier_id; ?>'>Edit Details</a>
        </div>
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
</style>

</html>