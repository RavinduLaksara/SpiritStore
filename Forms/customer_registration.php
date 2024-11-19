<?php
include('../Headers\customerHeader.php');
include(__DIR__ . '/../dbconnect.php');

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

        if (!verifyPhoneNumber($phone)) {
            echo "Please Enter valid phone no - 07**";
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

        // create cart
        $customer_id = $connection->insert_id;
        $sql = "INSERT INTO cart (customerID, total) VALUES ('$customer_id', 0)";
        $result = $connection->query($sql);

        if (!$result) {
            echo "cart query error";
            break;
        }

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
</head>

<body>
    <div class="container">
    <div class="form-container">

        <h1>Customer Registration</h1>
        <form action="" method="POST">

        <div class="left">
            <h2>Enter Details</h2>

            <div class="input-box">
            <label>Username</label>
            <input type="text" id="username" name="username" required>
            </div>

            <div class="input-box">
            <label>Email</label>
            <input type="email" id="email" name="email" required>
            </div>

            <div class="input-box">
            <label >Phone</label>
            <input type="text" id="phone" name="phone"  required>
            </div>

            <div class="input-box">
            <label >Password</label>
            <input type="password" id="password" name="password" required>
            </div>

            <div class="input-box">
            <label >Password</label>
            <input type="password" id="password" name="con-password" required>
            </div>
        </div>

        <div class="right">
            <label for="">Enter Your Address</label><br>

            <div class="input-box">
             <label>State</label>
             <input type="text" id="state" name="state"  required>
             </div>
 
            <div class="input-box">
             <label >City</label>
             <input type="text" id="city" name="city"  required>
             </div>

            <div class="input-box">
             <label>Postal Code</label>
             <input type="text" id="postal_code" name="po-code"   required>
             </div>   

             <input type="checkbox" name="terms" required>
            <label for="terms">I agree to the <a href="#" target="_blank">terms and conditions</a>.</label><br><br>
            <input type="submit" name="submit" value="Register" required>
        </form>
    </div>
    </div>
</div>
</body>

</html>