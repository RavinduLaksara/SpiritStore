<?php require(__DIR__ . '/../config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title></title>

  <link rel="stylesheet" href="../styles/supplierh.css" />

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
    <nav class="navbar">

      <h2 class="logo">SPIRIT STORE</h2>

      <a class="active" href="<?= APP_URL ?>/pages/supplier/supplier_manage_products.php">Manage Products</a>
      <a href="<?= APP_URL ?>/pages/supplier/supplier_add_products.php">Add products</a>
      <a href="<?= APP_URL ?>/pages/supplier/order_details.php">Check Orders</a>
      <a href="<?= APP_URL ?>/pages/supplier/supplier_reports.php">Reports</a>
      <a href="<?= APP_URL ?>/homepage.php">Site Home</a>

      <a href="<?= APP_URL ?>/pages/customer/logout.php">Logout</a>

    </nav>
  </section>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Roboto", sans-serif;
    }

    #header {
      display: flex;
      background: white;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
      z-index: 999;
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 400px;
      /* Set the width for the vertical sidebar */
      padding: 20px;
    }

    .navbar {
      display: flex;
      flex-direction: column;
      /* Arrange links vertically */
      align-items: center;
      width: 100%;
      /* Full width */
    }

    .logo {

      margin-bottom: 20px;
      letter-spacing: 2px;
      margin-left: 100px;
    }

    .navbar a {
      text-decoration: none;
      padding: 10px 0;
    }

    .right-icons {
      margin-top: auto;
      display: flex;
      align-items: center;
    }

    .right-icons a {
      margin-left: 10px;
      color: #14151a;
      font-size: 20px;
    }

    .right-icons a:hover {
      color: rgb(223, 86, 51);
    }
  </style>
</body>

</html>