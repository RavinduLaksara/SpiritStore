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
  <title>Customer</title>
  <link rel="stylesheet" href="../style.css" />
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
      <h2 class="logo">SPIRIT STORE</h2>

      <a class="active" href="<?= APP_URL ?>/homepage.php">Home</a>

      <a href="<?= APP_URL ?>/pages/products.php">Products</a>
      <a href="<?= APP_URL ?>/pages/products_by_category.php?id=4">Whiskey</a>
      <a href="<?= APP_URL ?>/pages/products_by_category.php?id=9">Arrack</a>
      <a href="<?= APP_URL ?>/pages/products_by_category.php?id=10">Beers</a>
      <a href="#">blog</a>
      <a href="<?= APP_URL ?>/pages/cart.php">
        <i class="fas fa-shopping-cart"></i>
        <span style="color: red; font-weight: bold;">
          (<?= $cartCount ?>)
        </span>
      </a>

      <a href="<?= APP_URL ?>/pages/customer_dashboard.php"><i class="fas fa-user"></i> </a>


    </div>
  </section>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Roboto", sans-serif;
      /* Changed to Roboto font */
    }

    #header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 80px;
      background: white;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
      z-index: 999;
      position: sticky;
      top: 0;
      left: 0;
      padding-left: 100px;
    }

    #navbar {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-grow: 1;
      /* Ensures the navbar takes up available space */
    }

    #navbar li {
      list-style: none;
      padding: 0 20px;
      position: relative;

    }

    select {
      color: #f2f8f7;
      background-color: #14151a;
    }

    #navbar li a {
      text-decoration: none;
      font-size: 16px;
      font-weight: 600;
      color: #f6f7f7;
      transition: 0.3s ease;
      width: 50px;
    }

    #navbar li a:hover,
    #navbar li a.active {
      color: rgb(223, 86, 51);
    }

    #navbar li a.active::after,
    #navbar li a:hover::after {
      content: "";
      width: 30%;
      height: 2px;
      background: #088178;
      position: absolute;
      bottom: -4px;
      left: 20px;
    }

    /* Adjust layout for icons on the right */
    #header .navbar {
      display: flex;
      justify-content: space-between;
      width: 100%;
      /* Ensure the navbar takes up the full width */
    }

    #header .navbar .right-icons {
      display: flex;
      align-items: center;
      margin-left: auto;
      /* Push icons to the right */
    }

    #header .navbar .right-icons a {
      margin-left: 15px;
      /* Add space between icons */
    }

    img {
      height: 50px;
    }

    /* Optional: Adjust icon sizes */
    #header .navbar .right-icons i {
      font-size: 20px;
      color: white;
      transition: color 0.3s;
    }

    #header .navbar .right-icons i:hover {
      color: rgb(223, 86, 51);
    }

    .logo {
      letter-spacing: 2px;
    }
  </style>
</body>

</html>