<?php
include('../Headers/supplierHeadder.html');
include('../dbconnect.php');


if (!isset($_GET['id'])) {
    header("location: index.php");
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $po_code = $_POST['po-code'];

    do {
        if (empty($name) || empty($state) || empty($city) || empty($po_code)) {
            echo "All details are Requird";
            break;
        }

        $sql = "INSERT INTO store (name, supplier_id, state, city, postal_code) VALUES ('$name', '$id', '$state', '$city', '$po_code')";

        $result = $connection->query($sql);

        if (!$result) {
            echo "Invalid Query";
            break;
        }

        echo "Registration Successfully";
        header("location: index.php");
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Store Registration</title>
</head>

<body>
    <div class="container">
        <h1>Store Registration</h1>
        <form action="" method="post">
            <label for="">Enter Your Store Details</label>
            <input type="text" name="name" placeholder="Store Name" required><br><br>
            <label for="">Enter Your Address</label><br>
            <input type="text" name="state" placeholder="State" required><br>
            <input type="text" name="city" placeholder="City" required><br>
            <input type="text" name="po-code" placeholder="Postal Code" required><br><br>
            <input type="submit" value="Register Store">
        </form>
    </div>
</body>

</html>