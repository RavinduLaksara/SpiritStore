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
    <title>New Admin</title>
    <link rel="stylesheet" href="adminregistration.css">
</head>

<body>
    <div class="container">
        <div class="form-container">

            <h1>Add New Admin</h1>

            <form action="#" method="post">

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
        <style>
            * {

margin-top: 0;
margin-bottom: 0;
margin-right: 0;
box-sizing: border-box;
font-family: 'Roboto', sans-serif;

}

h1{
text-align: center;
}
.container {
margin-left: 200px;
height: 100vh;
background-image: url('../image/photo1.jpg.jpg');
background-size: cover;
background-position: center;
display: flex;
justify-content: center;
align-items: center;
}

.form-container {
align-items: center;
width: 400px;
padding: 30px;
background: rgba(156, 141, 141, 0.753);
border-radius: 35px;
box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
backdrop-filter: blur(10px);
}



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

.input-box input:focus ~ label,
.input-box input:valid ~ label {
top: -10px;
font-size: 12px;
color: #1f1d2b;
}

.input-box .icon {
position: absolute;
top: 50%;
right: 10px;
transform: translateY(-50%);
font-size: 18px;
color: black;
}

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

.image-upload-container {
display: flex;
justify-content: center;
align-items: center;
flex-direction: column;
margin: 20px auto;
max-width: 400px;
}

.upload-rectangle {
margin-top: 130px;
width: 300px; /* Rectangle width */
height: 200px; /* Rectangle height */
border: 2px dashed #070707; /* Dashed border */
border-radius: 10px; /* Rounded corners */
display: flex;
justify-content: center;
align-items: center;
flex-direction: column;
color: #020202; /* Text color */
font-size: 1em;
cursor: pointer;
text-align: center;
transition: background-color 0.3s ease, border-color 0.3s ease;
}

.upload-rectangle:hover {
background-color: #f4f8ff; /* Light background on hover */
border-color: #0c0c0c; /* Darker border color on hover */
}

.upload-rectangle i {
font-size: 2em;
margin-bottom: 10px; /* Spacing below the icon */
}

.upload-rectangle .small-text {
font-size: 0.9em;
color: #666;
}

#image-input {
display: none; /* Hide the actual file input */
}

        </style>
</body>

</html>