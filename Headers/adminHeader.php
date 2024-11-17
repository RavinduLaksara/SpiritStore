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
      <a href="<?= APP_URL ?>pages/admin/manage_order.php">Manage Orders</a>
      <a href="<?= APP_URL ?>/pages/admin/products.php">Manage Products</a>
      <a href="<?= APP_URL ?>/pages/admin/manage_customers.php">Manage Customers</a>
      <a href="<?= APP_URL ?>/Forms/add_new_brands">Add new Brand</a>
      <a href="<?= APP_URL ?>/Forms/add_new_category.php">Add new Category</a>
      <a href="<?= APP_URL ?>/Forms/admin-registration.php">Add new Admin</a>
      <a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-user"></i></a>

    </nav>
  </section>

</body>

</html>