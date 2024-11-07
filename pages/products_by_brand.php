<?php
include('../Headers\customerHeader.php');
include(__DIR__ . '/../dbconnect.php');

if (!isset($_GET['id'])) {
    header("Location: Forms\login.php");
    exit;
}

$brand_id = $_GET['id'];

// Get brand Name and description
$sql = "SELECT name, descri FROM brand WHERE id = '$brand_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$brand_name = $row[0];
$brand_desc = $row[1];

// get product details in that category
$sql = "SELECT ProductID, name, BrandID, CategoryID, photo FROM product WHERE BrandID = '$brand_id'";
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
                    <h3>$brand_name</h3>
                    <p>$brand_desc</p>
                ";
            ?>
        </div>
        <div>
            <?php
            while ($product_row = $result->fetch_assoc()) {
                // Get category Name
                $sql = "SELECT name FROM category WHERE id = '$product_row[CategoryID]'";
                $result_category = $connection->query($sql);
                $row = $result_category->fetch_array();
                $category_name = $row[0];
                echo "
                        <div>
                            <img src = '../{$product_row['photo']}' alt = 'Product image'>
                            <p>$category_name</p>
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