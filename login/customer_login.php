<?php
include('../Headers\customerHeader.html');
include('../dbconnect.php');
?>

<head>
    <title>Login</title>
   
</head>
<body>
<div class="container">
     
<h1>LOGIN</h1>
   <form action="login.php" method="post" onsubmit="return validateForm()">

        <label for="Enter your username"></label>
        <input type="text"  id="name" name="name" required>
        <br><br>
        
        <label f>=
        <input type="password"  id="password" name="password" required>
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

        return true; // Submit form if validation passes
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
include('../footer.php');
?>