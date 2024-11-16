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
  <!-- <link rel="stylesheet" href="../styles/customer.css"> -->
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

      <h3 class="logo">&nbsp;&nbsp;SPIRIT STORE</h3>

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

</body>

</html>