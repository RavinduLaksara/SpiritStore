<?php
session_start();

// Destroy the session
session_unset();  // Unset all session variables
session_destroy(); // Destroy the session itself
// Redirect to the login page or homepage
header("Location: ../../Forms/login.php"); // Change "login.php" to your desired location
exit();
