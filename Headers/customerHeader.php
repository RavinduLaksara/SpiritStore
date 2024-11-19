<?php
include(__DIR__ . '/../dbconnect.php');
include('../Headers\customerHeader.php');

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
    $license_type = $_POST['license_type'];
    $license_no = $_POST['license_no'];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($con_password) || empty($state) || empty($city) || empty($po_code) || empty($license_type) || empty($license_no)) {
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

        if (!verifyPhoneNumber($phone)) {
            echo "Please Enter valid phone no - 07**";
            break;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO supplier (name, email, phone, password, state, city, postal_code, license_type, license_no,	approve_status) VALUES ('$name', '$email', '$phone', '$hashedPassword', '$state', '$city', '$po_code', '$license_type', '$license_no', 'no')";

        $result = $connection->query($sql);
        if (!$result) {
            echo 'Invalid query';
            break;
        }

        echo 'Registration Successfully';

        $supplier_id = $connection->insert_id;

        header("Location: ../Forms/store_registration.php?id=$supplier_id");
        exit();
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="webpage\style.css">
    <title>Supplier Registration</title>
</head>

<body>
<div class="container">
<div class="form-container">
        <h1>Supplier Registration</h1>

        <form action="" method="post">
<div class="form-box">
        <div id="left">
            <h3>Enter Personal Details</h3>

            <div class="input-box">
            <input type="text" name="username" required>
            <label>Your name</label>
            </div>

            <div class="input-box">
            <input type="email"  name="email" required>
            <label>Email</label>
            </div>

            <div class="input-box">
            <input type="email"  name="email" required>
            <label>Phone No</label>
            </div>

            <div class="input-box">
            <input type="password"  name="password" required>
            <label>Password</label>
            </div>

            <div class="input-box">
            <input type="password"  name="con-password" required>
            <label>Confirm Password</label>
            </div>
            
</div>

<div id="right">
            <h3>Enter Your Address</h3>


            <div class="input-box">
            <input type="text" name="state" required>
            <label>State</label>
            </div>

            <div class="input-box">
            <input type="text" name="city" required>
            <label>City</label>
            </div>

            <div class="input-box">
            <input type="text" name="po-code" required>
            <label>Postal Code</label>
            </div>
</div>
<div id="right1">
            <h3>Enter Your License Details</h3>

            <div class="input-box">
            <input type="text" name="license_type" required>
            <label>Postal Code</label>
            </div>

            <div class="input-box">
            <input type="text" name="license_no" required>
            <label>License No</label>
            </div>
<br>
            <input type="checkbox" name="terms" required>
            
            <label for="terms">I agree to the <a href="#" target="_blank">terms and conditions</a>.</label><br><br>
            <br>
            <button type="submit" name="submit" value="Register" required>Submit</button>
</div>
</form>
    </div>
    </div>
</body>

</html>