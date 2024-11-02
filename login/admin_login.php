<?php
include('../Headers/customerHeader.php');

?>

<head>
    <title>Login</title>
   
</head>
<body>
<div class="container">
     
<h1>LOGIN</h1>
    <form action="customer_login.php" method="POST" onsubmit="return validateForm()">
        <label for="name">Username:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        
        <input type="submit" value="Login">
    </form>
    <a href="../register.php">Register Now</a>

</div>


    <script>
    function validateForm() {
        let name = document.getElementById("name").value;
        let password = document.getElementById("password").value;
        
        if (username == "") {
            alert("Name must be filled out.");
            return false;
        }
        
        if (password == "") {
            alert("Password must be filled out.");
            return false;
        }
        
        if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        }

        return true; 
    }
</script>
<style>
    input[type="text"],
    input[type="password"],
    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: rgb(165, 162, 162);
      color: white;
      border: none;
      border-bottom: 2px solid black; 
      border-radius: 4px;
    }
</style>
</body>
<?php


if (isset($_SESSION['customer_id'])!=null){
    header("Location: ../homepage.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($connection, $_POST['name']); // Assuming 'name' is the email
    $password = $_POST['password']; // Do not hash the password here

    // Prepare SQL query to fetch user
    $sql = "SELECT * FROM customer WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $user['email'];
            $_SESSION['customer_id'] = $user['id']; 
            header("Location: /SpiritStore/homepage.php"); // Redirect to homepage
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Incorrect password.'); window.location.href='customer_login.php';</script>";
        }
    } else {
        // User not found
        echo "<script>alert('No account found with that email address.'); window.location.href='customer_login.php';</script>";
    }
}
?>
