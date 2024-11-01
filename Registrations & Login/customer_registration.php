<?php
include('../Headers\customerHeader.html');
include('../dbconnect.php');

function verifyPhoneNumber($phoneNumber)
{
    if (strlen($phoneNumber) == 10) {
        return true;
    } else {
        return false;
    }
}

function verifyPassword($password)
{
    if (strlen($password) >= 8) {
        return true;
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $con_password = $_POST['con-password'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $po_code = $_POST['po-code'];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($con_password) || empty($state) || empty($city) || empty($po_code)) {
            echo "all details are required";
            break;
        }

        if (!verifyPassword($password)) {
            echo "Please Enter Strong Password";
            break;
        }

        if ($password != $con_password) {
            echo "Password & Confirm password not equal";
            break;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO customer (name, email, phone, password, state, city, postal_code) VALUES ('$name', '$email', '$phone', '$hashedPassword', '$state', '$city', '$po_code')";

        $result = $connection->query($sql);

        if (!$result) {
            echo 'Invalid query';
            break;
        }

        echo 'Registration Successfully';
        header('location:index.php');
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>




<!--
    <div class="container">
        <h1>Customer Registration</h1>
        <form action="" method="POST">
            <label for="">Enter Details</label>
            <br>
            <input type="text" name="name" placeholder="Your Name" required>
            <br>
            <input type="email" name="email" placeholder="Email" required>
            <br>
            <input type="text" name="phone" placeholder="Phone No   07**" required>
            <br><br>

            <input type="password" name="password" placeholder="Password (min 8 charactors)" required>
            <br>
            <input type="password" name="con-password" placeholder="Confirm Password" required>
            <br><br>

            <label for="">Enter Your Address</label>
            <br>
            <input type="text" name="state" placeholder="State" required>
            <br>
            <input type="text" name="city" placeholder="City" required>
            <br>
            <input type="text" name="po-code" placeholder="Postal Code" required>
            <br><br>

            <input type="checkbox" name="terms" required>
            <label for="terms">I agree to the <a href="#" target="_blank">terms and conditions</a>.</label>
            <br><br>

            <input type="submit" name="submit" value="Register" required>
        </form>
    </div>
-->

</body>

</html>