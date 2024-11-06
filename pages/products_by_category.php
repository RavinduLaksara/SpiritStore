<?php
include('../Headers\customerHeader.php');
include(__DIR__ . '/../dbconnect.php');

if (!isset($_GET['id'])) {
    header("Location: Forms\login.php");
    exit;
}

$category_id = $_GET['id'];

// Get category Name and description
$sql = "SELECT name, descri FROM category WHERE id = '$category_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$category_name = $row[0];
$category_desc = $row[1];

// get product details in that category
$sql = "SELECT ProductID, name, BrandID, photo FROM product WHERE CategoryID = '$category_id'";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category_name; ?></title>
</head>

<body>
    <div class="content">
        <div class="title">
            <?php
            echo "
                    <h3>$category_name</h3>
                    <p>$category_desc</p>
                ";
            ?>
        </div>
        <div>
            <?php
            while ($product_row = $result->fetch_assoc()) {
                // Get brand Name
                $sql = "SELECT name FROM brand WHERE id = '$product_row[BrandID]'";
                $result_brand = $connection->query($sql);
                $row = $result_brand->fetch_array();
                $brand_name = $row[0];
                echo "
                        <div>
                            <img src = '../{$product_row['photo']}' alt = 'Product image'>
                            <p>$brand_name</p>
                            <p>{$product_row['name']}</p>
                            <button><a href = '../pages/seller_products.php?id= $product_row[ProductID]''>View Sellers</a></button>
                        </div>
                    ";
            }
            ?>
        </div>
    </div>
</body>

</html>