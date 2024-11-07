<?php
session_start();
include(__DIR__ . '/../dbconnect.php');
include('../Headers\customerHeader.php');

if (!isset($_GET['productID']) && !isset($_GET['storeID'])) {
    header("Location: ../pages\supplier-dashboard.php");
    exit;
}

$productID = $_GET['productID'];
$storeID = $_GET['storeID'];

// Get product details
$sql = "SELECT * FROM product WHERE productID = '$productID'";
$result = $connection->query($sql);
$product_row = $result->fetch_assoc();

// Get price and quntity
$sql = "SELECT Price, Quantity FROM storeproduct WHERE StoreID = '$storeID' AND ProductID = '$productID'";
$result = $connection->query($sql);
$price_quantity = $result->fetch_array();

$price = $price_quantity[0];
$quantity = $price_quantity[1];

// Get brand name
$sql = "SELECT name FROM brand WHERE id = $product_row[BrandID]";
$result = $connection->query($sql);
$row = $result->fetch_array();
$brand_name = $row[0];

// Get brand name
$sql = "SELECT name FROM category WHERE id = $product_row[CategoryID]";
$result = $connection->query($sql);
$row = $result->fetch_array();
$category_name = $row[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product_row['Name']; ?></title>
    <!-- <link rel="stylesheet" href="../style.css"> -->
    <link rel="stylesheet" href="../styles\product_view.css">
</head>

<body>
    <div class="content">
        <div class="left">
            <img src="../<?php echo $product_row['photo']; ?>" alt="product image">
        </div>
        <div class="right">
            <?php
            echo "
                    <p>{$product_row['Name']}</p>
                    <p>Price Rs. $price</p>
                    <p>{$product_row['Description']}</p>
                    <p>$quantity in stock</p>
                    <a href = '../pages\products_by_brand.php?id= $product_row[BrandID]'>$brand_name</a>
                    <a href = '../pages\products_by_category.php?id= $product_row[CategoryID]'>$category_name</a><br>
                    <button><a href =''>Add to Cart</a></button>
                ";
            ?>
        </div>
        <div class="additional">
            <h3>Additional Information</h3>
            <?php
            echo "
                    <p>Country - {$product_row['Country']}</p>
                    <p>Local / Imported - {$product_row['Local_Imported']}</p>
                    <p>ABV - {$product_row['ABV']}%</p>
                ";
            ?>
        </div>
    </div>
</body>

</html>