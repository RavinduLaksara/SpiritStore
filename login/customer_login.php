<?php
include('../Headers/customerHeader.php');
include('../dbconnect.php');
?>

<head>
    <title>Login</title>
   
</head>
<body>
<div class="container">
     
<h1>LOGIN</h1>
    <form action="customer_login.php" method="post" onsubmit="return validateForm()">
        <label for="name">Username:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        
        <input type="submit" value="Login">
    </form>

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
include ('footer.php');
session_start();

include('../dbconnect.php');


// Start the session
session_start();


include('../dbconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $sql = "SELECT * FROM customer WHERE name = '$name' AND password = '$password'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $name;
        header("Location: ../homepage.php");
        exit();
    } else {
        echo "<script>alert('Incorrect username or password.'); window.location.href='customer_login.php';</script>";
    }
}
?>
