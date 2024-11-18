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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../styles\seller_products.css">
    <link rel="stylesheet" href="../styles\products.css">

</head>

<body>
    <div>
        <div class='title'>
            <?php
            echo "
                    <h3>$brand_name</h3>
                    <p>$brand_desc</p>
                ";
            ?>
        </div>
        <div class='item-container-modify'>
            <?php
            if ($result->num_rows == 0) {
                header("Location: ../pages/empty_products.php");
                exit;
            }
            while ($product_row = $result->fetch_assoc()) {
                // Get category Name
                $sql = "SELECT name FROM category WHERE id = '$product_row[CategoryID]'";
                $result_category = $connection->query($sql);
                $row = $result_category->fetch_array();
                $category_name = $row[0];
                echo "
                        <div class='item item-seller_products'>
                            <img src = '{$product_row['photo']}' alt = 'Product image'>
                            <p>$category_name</p>
                            <p>{$product_row['name']}</p>
                            <a class='card-button' href = '../pages/seller_products.php?id= $product_row[ProductID]''>View Sellers</a>
                        </div>
                    ";
            }
            ?>
        </div>
    </div>
</body>

</html>