<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Registration</title>
</head>
<body>
  <style>


body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-image: url('image/login\ page\ image.jpg'); 
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #fff;
    }

    
    .form-container {
      background: rgba(255, 255, 255, 0.1); 
      backdrop-filter: blur(20px); 
      width: 350px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
      text-align: center;
      margin-top:100px;
      margin-bottom:100px;
    }

    .form-container h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .form-container label {
      display: block;
      margin-top: 10px;
      text-align: left;
    }

    .form-container input[type="text"],
    .form-container input[type="email"],
    .form-container input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      border-radius: 5px;
      border: none;
      outline: none;
      font-size: 16px;
    }

    .form-container button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #333;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }

    .form-container button:hover {
      background-color: #555;
    }

    .form-container .footer-text {
      margin-top: 15px;
      font-size: 14px;
    }

  </style>
  <div class="form-container">
    <h2>Registration</h2>
    <form action="register.php" method="POST">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Enter your username" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="phone">Phone</label>
      <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>

      <label for="state">State</label>
      <input type="text" id="state" name="state" placeholder="Enter your state" required>

      <label for="city">City</label>
      <input type="text" id="city" name="city" placeholder="Enter your city" required>

      <label for="postal_code">Postal Code</label>
      <input type="text" id="postal_code" name="postal_code" placeholder="Enter your postal code" required>

      <label>
        <input type="checkbox" name="terms" required> I agree to the terms & conditions
      </label>

      <button type="submit">Register</button>
    </form>

    <div class="footer-text">Already have an account? <a href="/SpiritStore/login/customer_login.php" style="color: #fff;">Login</a></div>
  </div>

  <?php
  // Include the database connection file
  include("dbconnect.php");

  // Check database connection
  if (!$connection) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Handle the form submission
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize and hash password
      $username = mysqli_real_escape_string($connection, $_POST['username']);
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $phone = mysqli_real_escape_string($connection, $_POST['phone']);
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $state = mysqli_real_escape_string($connection, $_POST['state']);
      $city = mysqli_real_escape_string($connection, $_POST['city']);
      $postal_code = mysqli_real_escape_string($connection, $_POST['postal_code']);

      // Prepare SQL query
      $sql = "INSERT INTO customer (name, email, phone, password, state, city, postal_code) 
              VALUES ('$username', '$email', '$phone', '$password', '$state', '$city', '$postal_code')";

      // Execute the query and handle success/failure
      if (mysqli_query($connection, $sql)) {
          echo "<script>alert('Registration successful!'); window.location.href='SpiritStore/login/customer_login.php';</script>";
      } else {
          echo "<p>Error: " . mysqli_error($connection) . "</p>";
      }
  }

  // Close the database connection
  mysqli_close($connection);
  ?>
</body>
</html>