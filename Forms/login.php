<?php
include(__DIR__ . '/../dbconnect.php');
include('../Headers/customerHeader.php');

function checkData($connection, $email, $password, $table)
{
    $sql = "SELECT id, password FROM $table WHERE email = '$email'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            return $user['id'];
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    do {
        if (empty($email) || empty($password)) {
            echo "All details are required";
            break;
        }
        if ($userid = checkData($connection, $email, $password, 'customer')) {
            $_SESSION['userid'] = $userid;
            header('Location: ../homepage.php');
            exit;
        } else if ($userid = checkData($connection, $email, $password, 'supplier')) {
            $_SESSION['userid'] = $userid;
            header('Location: ../pages/supplier/supplier_dashboard.php?id=' . $userid);
            exit;
        } else if ($userid = checkData($connection, $email, $password, 'admin')) {
            header('Location: ../pages/admin_dashboard.php?id=' . $userid);
            exit;
        } else {
            echo "Invalid email or password";
        }
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin-left: 0;
            margin-top: 0;
            margin-right: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 0;
            height: 100vh;
            background-image: url('photo1.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 400px;
            padding: 30px;
            background: rgba(156, 141, 141, 0.753);
            border-radius: 35px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        h2 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
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

        .input-box input:focus~label,
        .input-box input:valid~label {
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

        .form-container a {
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form-box"></div>
            <h2>Login</h2>
            <form action="#" method="post">



                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>

                <button type="submit">Login</button><br><br><br>
                <span>Haven't Account</span>
                <a href="../Forms/customer_registration.php">Register now</a>



                <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


            </form>
        </div>
    </div>
</body>

</html>