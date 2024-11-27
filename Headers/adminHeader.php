<?php require(__DIR__ . '/../config.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="stylesheet" href="../styles/adminh.css" />
  <script
    src="https://kit.fontawesome.com/a076d05399.js"
    crossorigin="anonymous"></script>
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
    rel="stylesheet">
</head>

<body>
  <section id="header">
    <nav class="navbar">

      <h2 class="logo">SPIRIT STORE</h2>
      <a href="<?= APP_URL ?>/pages/admin/manage_suppliers.php">Manage Suppliers</a>
      <a href="<?= APP_URL ?>/pages/admin/manage_order.php">Manage Orders</a>
      <a href="<?= APP_URL ?>/pages/admin/products.php">Manage Products</a>
      <a href="<?= APP_URL ?>/pages/admin/manage_customers.php">Manage Customers</a>
      <a href="<?= APP_URL ?>/Forms/admin-registration.php">Add new Admin</a>
      <a href="<?= APP_URL ?>/pages/customer/logout.php">Logout</a>

    </nav>
  </section>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap");

    * {

      font-family: "Roboto", sans-serif;
    }

    #header {
      display: flex;
      align-items: start;
      justify-content: space-between;
      background: white;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
      z-index: 999;
      position: sticky;
      height: 100vh;
      width: 230px;
      position: fixed;
    }


    .logo {
      color: black;
      user-select: none;
      font-size: 1.7em;
      font-weight: bold;
      letter-spacing: 2px;
    }

    .navbar {
      display: flex;
      flex-direction: column;
      width: 200px;
      gap: 20px;
      /* Space between items */
      background-color: #f4f4f4;
      /* Optional: Light background for navbar */
      padding: 10px 10px;
      /* Padding around the navbar */
    }

    .navbar a {
      text-decoration: none;
      color: #333;
      /* Text color */
      font-size: 1em;
      padding: 12px;
      border-radius: 5px;
      /* Rounded corners */
      transition: background-color 0.3s ease;
      /* Smooth hover effect */
    }

    .navbar a:hover {
      background-color: #ddd;
      /* Hover background color */
    }

    .navbar .active {
      background-color: #212324;
      /* Active link background color */
      color: white;
      /* Active link text color */
      font-weight: bold;
      /* Emphasize active link */
    }
  </style>
</body>

</html>