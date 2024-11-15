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

</html>