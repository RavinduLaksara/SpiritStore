<?php

include(__DIR__ . '/../../dbconnect.php');
include(__DIR__ . '/../../Headers/adminHeader.php');

if (!isset($_GET['id'])) {
    header("Location: ../admin_dashboard.php");
    exit;
}

$customer_id = $_GET['id'];

// Get customer details
$sql = "SELECT * FROM customer WHERE '$customer_id'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['supplier_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];

    $sql = "UPDATE customer SET name = '$name', email = '$email', phone = '$phone', state = '$state', city = '$city', postal_code = '$postal_code' WHERE id = '$customer_id'";

    $result = $connection->query($sql);

    if (!$result) {
        echo "Supplier query error";
        exit;
    }

    echo "Update Successfully";
    header("Location: ../admin_dashboard.php");
    exit;
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
        <form action="" method="POST">
            <input type="text" placeholder="Customer Name" name="name" required value="<?php echo $row['name'] ?>"><br>
            <input type="email" placeholder="Customer Email" name="email" required value="<?php echo $row['email'] ?>"><br>
            <input type="text" placeholder="Phone no" name="phone" required value="<?php echo $row['phone'] ?>"><br>
            <input type="text" placeholder="State" name="state" required value="<?php echo $row['state'] ?>"><br>
            <input type="text" placeholder="City" name="city" required value="<?php echo $row['city'] ?>"><br>
            <input type="text" placeholder="Postal Code" name="postal_code" required value="<?php echo $row['postal_code'] ?>"><br><br>
            <input type="submit" value="Update Deetails">
        </form>
    </div>
</body>

</html>