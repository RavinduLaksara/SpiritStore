<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>customer registration</title>

  <body>
       <div class="wrapper">
          <div class="form-box"></div>
          <h2>Login</h2>
          <form action=""
       </div>
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
</head>
<body>

  <div class="form-container">
    <h2>Registration</h2>
    <form>
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Enter your username">

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email">

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password">

      <label>
        <input type="checkbox" name="terms"> I agree to the terms & conditions
      </label>

      <button type="submit">Register</button>
    </form>
    <div class="footer-text">Already have an account? <a href="#" style="color: #fff;">Login</a></div>
  </div>

</body>
</html>
