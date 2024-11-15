<?php
include(__DIR__ . '/../../dbconnect.php');

if (!isset($_GET['id'])) {
    header("Location: Forms/login.php");
    exit;
}

$supplier_id = $_GET['id'];

// Get store id
$sql = "SELECT store_id FROM store WHERE supplier_id = '$supplier_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$store_id = $row[0];

// Get search query if it exists
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Modify SQL query to include search functionality
$sql = "
    SELECT product.ProductID, product.name, product.BrandID, product.categoryID, product.photo, 
           brand.name AS brand_name, category.name AS category_name
    FROM product
    LEFT JOIN brand ON product.BrandID = brand.id
    LEFT JOIN category ON product.categoryID = category.id
    WHERE 1 ";

// If there's a search term, add search filters
if ($searchQuery !== '') {
    $sql .= " AND (product.name LIKE '%$searchQuery%' 
                 OR brand.name LIKE '%$searchQuery%' 
                 OR category.name LIKE '%$searchQuery%')";
}

$product_result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="../styles/seller_products.css">
    <link rel="stylesheet" href="../styles/products.css">
</head>

<body>
    <div class="container">
        <div class="container-modify">
            <h1>ADD PRODUCTS</h1>

            <!-- Search Form -->
            <form method="GET" action="seller_products.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($supplier_id); ?>">
                <input type="text" name="search" placeholder="Search products, brands, or categories" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit">Search</button>
            </form>

            <h2>Available Products in Spirit Store</h2>
            <div class="item-container-modify">
                <?php
                // Display products
                if ($product_result->num_rows === 0) {
                    echo "<p>No products found.</p>";
                } else {
                    while ($row_product = $product_result->fetch_assoc()) {
                        $brand_name = $row_product['brand_name'];
                        $category_name = $row_product['category_name'];

                        echo "
                        <div class='item item-seller_products'>
                            <img src='../../{$row_product['photo']}' alt='Product image'>
                            <span>$brand_name</span>
                            <span>$category_name</span>
                            <p>{$row_product['name']}</p>
                            <a class='card-button' href='../../Forms/add_more_stock.php?productID={$row_product['ProductID']}&storeID=$store_id'>Add More Stock</a>
                        </div>";
                    }
                }
                ?>
            </div>
            <div class="add-new-button">
                <a href="../Forms/add_new_product.php?id=<?php echo $store_id; ?>">Add New Product</a>
            </div>
        </div>
    </div>
</body>

</html>