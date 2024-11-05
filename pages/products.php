<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="item-card.css"> -->
    <link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>
    <?php include('../Headers\customerHeader.php') ?>
    <div class="back-image">
        <h2>PRODUCTS</h2>
    </div>
    <div class="content">
        <div class="item-filter"></div>

        <div class="item-container">
            <?php
            include("../dbconnect.php");
            //    include("dbconnect.php");

            $sql = "select * from product";
            $result = mysqli_query($connection, $sql);

            if (!$result) {
                echo (" invalid query");
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $categoryID = $row["CategoryID"];
                $name = $row["Name"];
                $description = $row["Description"];
                $photo = $row["photo"];

                $sql = "select name from category where id={$categoryID}";
                $result1 = mysqli_query($connection, $sql);
                $row1 = mysqli_fetch_assoc($result1);
                $category = $row1["name"];

                echo '
    <div class="item">
       
    <img src="../' . $photo . '"alt="photo">
    <p class="category">' . $category . ' </p>
    <p class="name">' . $name . '</p>
      <button><a href="../pages/seller_products.php?id=' . $row['ProductID'] . '">VIEW SELLERS</a></button>

    </div>';
            }

            ?>
        </div>
    </div>



</body>

</html>