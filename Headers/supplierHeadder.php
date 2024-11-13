<?php require(__DIR__ . '/../config.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title></title>
  <!-- <link rel="stylesheet" href="../style.css" /> -->

  <script
    src="https://kit.fontawesome.com/a076d05399.js"
    crossorigin="anonymous"></script>

  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>
  <section id="header">


    <div class="navbar">

      <h2 class="logo">SPIRIT STORE</h2>

      <a class="active" href="#">Manage Products</a>
      <a href="#">Add products</a>
      <a href="#">Check Orders</a>
      <a href="#">Reports</a>
      <a href="<?= APP_URL ?>/homepage.php">Site Home</a>

      <a href="#"><i class="fas fa-user"></i></a>

    </div>
  </section>
</body>

</html>