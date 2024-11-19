<?php
session_start();
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../dbconnect.php');

$cartCount = 0;

// Check if user is logged in
if (isset($_SESSION['userid'])) {
  // Fetch item count from `cartItem` table for logged-in users
  $customerID = $_SESSION['userid'];
  $sql = "SELECT COUNT(*) AS count FROM cartitem 
            INNER JOIN cart ON cart.cartID = cartitem.cartID
            WHERE cart.customerID = '$customerID'";
  $result = $connection->query($sql);
  if ($result) {
    $row = $result->fetch_assoc();
    $cartCount = $row['count'];
  }
} else {
  // For guest users, count items in session-based cart
  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
      $cartCount += $item['quantity'];
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title></title>


  <script
    src="https://kit.fontawesome.com/a076d05399.js"
    crossorigin="anonymous"></script>
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
</head>

<body>
  <section id="header">


    <div class="navbar">

      <h3 class="logo">SPIRIT STORE</h3>

      <a class="active" href="<?= APP_URL ?>/homepage.php">Home</a>

      <a href="<?= APP_URL ?>/pages/products.php">Products</a>
      <a href="<?= APP_URL ?>/pages/products_by_category.php?id=4">Whiskey</a>
      <a href="<?= APP_URL ?>/pages/products_by_category.php?id=9">Arrack</a>
      <a href="<?= APP_URL ?>/pages/products_by_category.php?id=10">Beers</a>
      <a href="<?= APP_URL ?>/Forms/supplier_registration.php">Join as a Supplier</a>
      <div class="right-section">
        <a href="<?= APP_URL ?>/pages/cart.php">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-count">
            (<?= $cartCount ?>)
          </span>
        </a>
        <a href="<?= APP_URL ?>/pages/customer_dashboard.php"><i class="fas fa-user"></i> </a>
      </div>

    </div>
  </section>
<style>
  * {
    font-family: 'Roboto', sans-serif;
    
  }
  
  header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 10px 100px;
    background: white;
    display: flex;
    justify-content: space-between;
    align-items: start;
    color: black;
    z-index: 99;
  }
  
  /* Logo Section */
  .logo {
    color: black;
    user-select: none;
    font-size: 1.6em;
    font-weight: bold;
    letter-spacing: 2px;
  }
  
  
  /* Navigation Links */
  .navbar {
    display: flex;
    align-items: center;
    gap: 80px;
    flex: 1; /* Allows space for right-section to align properly */
  }
  
  /* Nav Links Styling */
  .navbar a {
    position: relative;
    font-size: 1.1em;
    color: black;
    text-decoration: none;
    font-weight: 500;
    
  }
  
  .navbar a::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 3px;
    background: black;
    border-radius: 5px;
    left: 0;
    bottom: -6px;
    transform-origin: right;
    transform: scaleX(0);
    transition: transform 0.5s;
  }
  
  .navbar a:hover::after {
    transform-origin: left;
    transform: scaleX(1);
  }
  
  .navbar a i {
    margin-right: 5px;
    font-size: 1.1em;
  }
  
  /* Right Section (Cart and Profile) */
  .right-section {
    display: flex;
    align-items: center;
    gap: 50px;
  }
  
  .right-section .btn-cart {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 1.1em;
    color: black;
    text-decoration: none;
    font-weight: 500;
    cursor: pointer;
    transition: color 0.3s ease;
  }
  
  .right-section .btn-cart:hover {
    color: gray;
  }
  
  .right-section .btn-cart span {
    color: red;
    font-weight: bold;
  }
  
  .right-section .btn-profile {
    font-size: 1.5em;
    color: black;
    cursor: pointer;
    transition: color 0.3s ease;
  }
  
  .right-section .btn-profile:hover {
    color: gray;
  }
  
  
  /* Cart Count Badge */
  .cart-count {
    position: absolute;
    top: -8px; /* Adjust to move above the icon */
    right: -12px; /* Adjust to align with the icon */
    color:red;
    font-size: 0.6em;
    font-weight: bold;
    border-radius: 100%;
    padding: 2px 6px;
    min-width: 18px; /* Ensure circular shape */
    text-align: center;
    line-height: 1;
  }
  
  
</style>

</body>

</html>