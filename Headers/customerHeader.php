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
          
            <a class="active" href="#">HOME</a>
          
          <a href="#">Liquor and spirits</a>
          <a href="#">whiskey</a>
          <a href="#">wine</a>
          <a href="#">build a gift box</a>
          <a href="#">blog</a>


            <a href="#"><i class="fas fa-shopping-cart"></i> </a>
            <a href="#"><i class="fas fa-user"></i> </a>
          
           
              <?php 
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" class="btn">Logout</a>
                <?php else: ?>
                    <a href="../SpiritStore/login/customer_login.php" class="btn">Login</a>
                <?php endif; 
                ?>
                
            
            
            
           
               
            
            
      </div>
    </section>
  </body>
</html>
