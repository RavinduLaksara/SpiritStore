<?php
session_start();

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
      crossorigin="anonymous"
    ></script>

    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  </head>

  <body>
    <section id="header">
      
      
      <div class="navbar">

        <h2 class="logo">SPIRIT STORE</h2>
          
            <a class="active" href="/SpiritStore/homepage.php">HOME</a>
          
            <?php
          include($_SERVER['DOCUMENT_ROOT'] . "/SpiritStore/dbconnect.php");
                // Query to get all categories
                $sql = "SELECT * FROM category";
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                  // Loop through each category and display as a link
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo '<a href="/SpiritStore/category.php?id=' . urlencode($row['id']) . '">' . htmlspecialchars($row['name']) . '</a>';
                  }
                } else {
                    echo "No categories found.";
                }
                ?>


            <a href="../SpiritStore/user_cart.php"><i class="fas fa-shopping-cart"></i> </a>
            <a href="#"><i class="fas fa-user"></i> </a>
          
           
              <?php 
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="../SpiritStore/logout.php" class="btn">Logout</a>
                <?php else: ?>
                    <a href="../SpiritStore/login/customer_login.php" class="btn">Login</a>
                <?php endif; 
                ?>
        </div>
    </section>
  </body>
</html>

