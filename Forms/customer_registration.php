<?php
include('../Headers/customerHeader.php');
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
                <div class="form-box">
                    <div class="left">
                        <h2>Enter Details</h2>

                        <div class="input-box">
                            <input type="text" id="username" name="username" required>
                            <label>Username</label>
                        </div>

                        <div class="input-box">
                            <input type="email" id="email" name="email" required>
                            <label>Email</label>
                        </div>

                        <div class="input-box">
                            <input type="text" id="phone" name="phone" required>
                            <label>Phone</label>
                        </div>

                        <div class="input-box">
                            <input type="password" id="password" name="password" required>
                            <label>Password</label>
                        </div>

                        <div class="input-box">
                            <input type="password" id="password" name="con-password" required>
                            <label>Password</label>
                        </div>
                    </div>

                    <div class="right">
                        <h2>Enter Your Address<h2>

                                <div class="input-box">

                                    <input type="text" id="state" name="state" required>
                                    <label>State</label>
                                </div>

                                <div class="input-box">

                                    <input type="text" id="city" name="city" required>
                                    <label>City</label>
                                </div>

                                <div class="input-box">

                                    <input type="text" id="postal_code" name="po-code" required>
                                    <label>Postal Code</label>
                                </div>

                                <input type="checkbox" name="terms" required>
                                <label for="terms">I agree to the <a href="../pages/terms_conditions.php" target="_blank">terms and conditions</a>.</label><br><br>
                                <button type="submit" name="submit" value="Register" required>Submit</button>
            </form>
        </div>
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