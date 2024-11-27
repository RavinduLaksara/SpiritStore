<?php

include(__DIR__ . '/../dbconnect.php');
// include(__DIR__ . '/../Headers/adminHeader.php');

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['supplier_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $license_type = $_POST['license_type'];
    $license_no = $_POST['license_no'];
    $approve_status = $_POST['approve_status'];
    $store_name = $_POST['store_name'];
    $store_state = $_POST['store_state'];
    $store_city = $_POST['store_city'];
    $store_postal_code = $_POST['store_postal_code'];


    do {
        // update supplier table
        $sql = "UPDATE supplier SET name = '$name', email = '$email', phone = '$phone', state = '$state', city = '$city', postal_code = '$postal_code', license_type = '$license_type', license_no = '$license_no', approve_status = '$approve_status' WHERE id = $supplier_id";

        $result = $connection->query($sql);

        if (!$result) {
            echo "Supplier query error";
            break;
        }

        // update store data

        $sql = "UPDATE store SET name = '$store_name', state = '$store_state', city = '$store_city', postal_code = '$store_postal_code' WHERE supplier_id= '$supplier_id'";

        $result = $connection->query($sql);

        if (!$result) {
            echo "Store query error";
            break;
        }

        echo "Update Successfully";
        header("Location: ../pages/admin/manage_suppliers.php");
        exit;
    } while (false);
}

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
        <h1>Edit Supplier Information</h1>
        <form action="" method="POST">
            <input type="text" placeholder="Supplier Name" name="supplier_name" required value="<?php echo $row_supplier['name'] ?>"><br>
            <input type="email" placeholder="Supplier Email" name="email" required value="<?php echo $row_supplier['email'] ?>"><br>
            <input type="text" placeholder="Phone no" name="phone" required value="<?php echo $row_supplier['phone'] ?>"><br>
            <input type="text" placeholder="State" name="state" required value="<?php echo $row_supplier['state'] ?>"><br>
            <input type="text" placeholder="City" name="city" required value="<?php echo $row_supplier['city'] ?>"><br>
            <input type="text" placeholder="Postal Code" name="postal_code" required value="<?php echo $row_supplier['postal_code'] ?>"><br>
            <input type="text" placeholder="License Type" name="license_type" required value="<?php echo $row_supplier['license_type'] ?>"><br>
            <input type="text" placeholder="License No" name="license_no" required value="<?php echo $row_supplier['license_no'] ?>"><br>
            <span>Approve Status</span>
            <select name="approve_status" required>
                <option>yes</option>
                <option>no</option>
            </select><br>

            <h1>Edit Store Information</h1><br>
            <input type="text" placeholder="Store Name" name="store_name" required value="<?php echo $row_store['name'] ?>"><br>
            <input type="text" placeholder="State" name="store_state" required value="<?php echo $row_store['state'] ?>"><br>
            <input type="text" placeholder="City" name="store_city" required value="<?php echo $row_store['city'] ?>"><br>
            <input type="text" placeholder="Postal Code" name="store_postal_code" required value="<?php echo $row_store['postal_code'] ?>"><br><br><br>
            <input type="submit" value="Update Details">
        </form>

    </div>
</body>
<style>
    body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.content {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    width: 90%;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 1.8em;
    color: #333;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

form input[type="text"],
form input[type="email"],
form select {
    width: 100%;
    padding: 10px;
    font-size: 1em;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    outline: none;
    transition: border-color 0.3s ease;
}

form input[type="text"]:focus,
form input[type="email"]:focus,
form select:focus {
    border-color: #333;
}

form span {
    font-size: 1em;
    color: #333;
    margin-bottom: 5px;
}

form input[type="submit"] {
    background-color: #333;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
    background-color: #555;
}

/* Form Divider Styling */
form h1 {
    text-align: left;
    font-size: 1.5em;
    margin-top: 20px;
    margin-bottom: 10px;
    color: #555;
    border: none;
    padding: 0;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .content {
        padding: 20px;
    }

    form input[type="text"],
    form input[type="email"],
    form select {
        font-size: 0.9em;
    }

    form input[type="submit"] {
        font-size: 0.9em;
    }
}

    </style>

</html>