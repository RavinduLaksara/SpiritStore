<?php require(__DIR__ . '/../config.php'); ?>
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
      <a href="#"><i class="fas fa-shopping-cart"></i> </a>
      <a href="#"><i class="fas fa-user"></i> </a>


    </div>
  </section>
</body>

</html>