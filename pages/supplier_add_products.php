<?php
include('../Headers\supplierHeadder.php');
include(__DIR__ . '/../dbconnect.php');

if (!isset($_GET['id'])) {
    header("Location: Forms\login.php");
    exit;
}

$supplier_id = $_GET['id'];

// Get store id
$sql = "SELECT store_id FROM store WHERE supplier_id = '$supplier_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$store_id = $row[0];


// get all products 
$sql = "SELECT ProductID, name, BrandID, categoryID, photo FROM product";
$product_result  = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
</head>

<body>
    <div class="content">
        <h1>Add Products</h1>
        <div class="available">
            <h1>Available Products in Spirit Store</h1>
            <?php
            while ($row_product = $product_result->fetch_assoc()) {
                // var_dump($row_product);
                // Get brand name
                $sql = "SELECT name FROM brand WHERE id = '$row_product[BrandID]'";
                $result = $connection->query($sql);
                $row_brand = $result->fetch_array();
                $brand_name = $row_brand[0];

                // Get category Name
                $sql = "SELECT name FROM category WHERE id = '$row_product[categoryID]'";
                $result = $connection->query($sql);
                $row_category = $result->fetch_array();
                $category_name = $row_category[0];
                echo "
                    <div>
                        <img src = '../{$row_product['photo']}' alt = 'Product image'>
                        <span>$brand_name</span>
                        <span>$category_name</span>
                        <p>{$row_product['name']}</p>
                        <button><a href='../Forms\add_more_stock.php?productID={$row_product['ProductID']}&storeID=$store_id'>Add More Stock</a></button>
                    </div>
                ";
            }
            ?>
        </div>
        <div>
            <a href="../Forms/add_new_product.php?id=<?php echo $store_id; ?>">Add New Product</a>
        </div>
    </div>
</body>

</html>