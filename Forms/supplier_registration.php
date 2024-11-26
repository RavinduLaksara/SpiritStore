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
    <link rel="stylesheet" href="../styles/registration.css">
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
                            <input type="email" name="email" required>
                            <label>Email</label>
                        </div>

                        <div class="input-box">
                            <input type="email" name="email" required>
                            <label>Phone No</label>
                        </div>

                        <div class="input-box">
                            <input type="password" name="password" required>
                            <label>Password</label>
                        </div>

                        <div class="input-box">
                            <input type="password" name="con-password" required>
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
                        <button type="submit" name="submit" value="Register" required>Submit</button><br><br>
                    

                    <span>Haven't Account</span>
                    <a class="log" href="../Forms/customer_registration.php">Register now</a>
                    </div>
            </form>
        </div>
    </div>
    
</body>

<style>
    * {
        padding: 0;
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif;
    }

    .container {
        margin-left: 0px;
        height: 100vh;
        background-image: url('../image/photo1.jpg');
        /* Fixed URL */
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }


    h2,
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-container {
        margin-top: 20px;
        justify-content: space-between;
        /* Add space between sections */
        align-items: flex-start;
        /* Align items at the top */
        width: 70%;
        /* Percentage-based width for responsiveness */
        max-width: 1200px;
        /* Set a maximum width */
        padding: 30px;
        gap: 20px;
        /* Space between sections */
        background: rgba(156, 141, 141, 0.75);
        /* Slightly transparent background */
        border-radius: 20px;
        backdrop-filter: blur(10px);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

    }

    .form-box {
        display: flex;
        gap: 100px;

    }

    /* Left Section - Personal Details */
    .left {
        flex: 1;
        /* Flexible width */
        background: rgba(255, 255, 255, 0.8);
        /* Light background for contrast */
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Right Section - Additional Content */
    .right {
        flex: 1;
        /* Flexible width */
        background: rgba(255, 255, 255, 0.8);
        /* Light background for contrast */
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }


    /* Input Fields */
    .input-box {
        position: relative;
        margin: 20px 0;
    }

    .input-box label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        font-size: 14px;
        color: black;
        transition: 0.3s;
    }

    .input-box input {
        width: 100%;
        padding: 10px 10px;
        background: transparent;
        border: none;
        border-bottom: 2px solid rgba(0, 0, 0, 0.5);
        outline: none;
        font-size: 16px;
        color: black;
    }

    .input-box input:focus~label,
    .input-box input:valid~label {
        top: -10px;
        font-size: 12px;
        color: #1f1d2b;
    }

    /* Buttons */
    button {
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        background: black;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: 0.3s;
    }

    button:hover {
        background: #333;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .form-container {
            flex-direction: column;
            /* Stack sections vertically on smaller screens */
        }

        .left,
        .right {
            flex: 1 1;
            /* Full width when stacked */
            margin-bottom: 20px;
            /* Add spacing between stacked sections */
        }
    }

    @media (max-width: 576px) {
        .form-container {
            padding: 20px;
        }

        .left,
        .right {
            padding: 15px;
        }
    }
</style>

</html>