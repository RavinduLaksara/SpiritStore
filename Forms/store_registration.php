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
        header("location: pages\supplier-dashboard.php");
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../webpage/style.css">
    <title>Store Registration</title>
</head>

<body>

<div class="container">
       <div class="form-container">
          <div class="form-box"></div>
          <h2>Store Registration</h2>
          <form action="#" method="post">

          <h3>Enter Your Store Details</h3>
            <div class="input-box">
                <input type="text" name="name" required>
                <label>Store Name</label>
            </div>
        
            <h3>Enter Your Address</h3>
            <div class="input-box">
                <span class="icon"><ion-icon name="location-outline"></ion-icon></span>
                <input type="text" required>
                <label>State</label>
            </div>

            <div class="input-box">
                <span class="icon"><ion-icon name="location-outline"></ion-icon></span>
                <input type="text" required>
                <label>City</label>
            </div>

            <div class="input-box">
                <span class="icon"><ion-icon name="location-outline"></ion-icon></span>
                <input type="text" required>
                <label>Postel Code</label>
            </div>
    
        
            <button type="submit" value="Register Store"> Submit</button>
        </form>
    </div>
</body>

</html>