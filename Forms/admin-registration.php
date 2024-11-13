<?php

include(__DIR__ . '/../dbconnect.php');
include(__DIR__ . '/../Headers/adminHeader.php');

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
    $con_password = $_POST['con_password'];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($password)) {
            echo "All details are required.";
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

        $sql = "INSERT INTO admin (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashedPassword')";
        $result = $connection->query($sql);

        if (!$result) {
            echo "Invalid Query";
            break;
        }

        echo "New admin registration successfully";
        header("location: pages\admin- dashboard.php");
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>New Admin</title>
</head>

<body>
    <div class="content">
        <div class="form-container">
            <div class="form-box"></div>

            <h2>Add New Admin</h2>
            <form action="#" method="post">

                <h3>Enter Details</h3>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <input type="text" name="name" required>
                    <label>Name</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                    <input type="text" name="phone" required>
                    <label>Phone Number</label>
                </div>

                <br>
                <br>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="con-password" required>
                    <label>Conferm Password</label>
                </div>

                <button type="submit" value="Add Admin">Next</button>



                <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

            </form>
        </div>
</body>

</html>