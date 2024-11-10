<?php
session_start();
include(__DIR__ . '/../dbconnect.php');
include('Headers\customerHeader.html');

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
            header('Location: pages\home.php?id=' . $userid);
            exit;
        } else if ($userid = checkData($connection, $email, $password, 'supplier')) {
            header('Location: pages\supplier-dashboard.php?id=' . $userid);
            exit;
        } else if ($userid = checkData($connection, $email, $password, 'admin')) {
            header('Location: pages\admin- dashboard.php?id=' . $userid);
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
                <label>Name</label>
            </div>

            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <button type="submit">Login</button>


            
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

        
        </form>
    </div>
     </div>
</body>

</html>