<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../styles/products.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include('../Headers/customerHeader.php') ?>

    <div class="back-image">
        <h2>PRODUCTS</h2>
    </div>

    <!-- Search Form -->
    <div class="search-container">
        <form method="GET" action="products.php">
            <input type="text" name="search" placeholder="Search for products, brands, or categories" required>
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="content">
        <div class="item-filter">
            <!-- Filter Form -->
            <form method="GET" action="products.php">
                <!-- Category Filter -->
                <h4>Filter by Category</h4>
                <?php
                include("../dbconnect.php");

                $categoryResult = $connection->query("SELECT id, name FROM category");
                while ($category = $categoryResult->fetch_assoc()) {
                    $checked = (isset($_GET['category']) && in_array($category['id'], $_GET['category'])) ? 'checked' : '';
                    echo '<label><input type="checkbox" name="category[]" value="' . $category['id'] . '" ' . $checked . '> ' . $category['name'] . '</label><br>';
                }
                ?>

                <!-- Brand Filter -->
                <h4>Filter by Brand</h4>
                <?php
                $brandResult = $connection->query("SELECT id, name FROM brand");
                while ($brand = $brandResult->fetch_assoc()) {
                    $checked = (isset($_GET['brand']) && in_array($brand['id'], $_GET['brand'])) ? 'checked' : '';
                    echo '<label><input type="checkbox" name="brand[]" value="' . $brand['id'] . '" ' . $checked . '> ' . $brand['name'] . '</label><br>';
                }
                ?>

                <button type="submit">Apply Filters</button>
            </form>
        </div>

        <div class="item-container">
            <?php
            // Get the search and filter parameters
            $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
            $selectedCategories = isset($_GET['category']) ? $_GET['category'] : [];
            $selectedBrands = isset($_GET['brand']) ? $_GET['brand'] : [];

            // Prepare SQL query with filters
            $query = "
                SELECT DISTINCT product.ProductID, product.Name AS product_name, product.photo, product.Description, 
                       category.name AS category_name, brand.name AS brand_name
                FROM product
                LEFT JOIN category ON product.CategoryID = category.id
                LEFT JOIN brand ON product.BrandID = brand.id
                LEFT JOIN storeproduct ON storeproduct.ProductID = product.ProductID
                WHERE 1 ";

            // Add search condition
            if ($searchQuery !== '') {
                $query .= " AND (product.Name LIKE '%$searchQuery%' 
                            OR category.name LIKE '%$searchQuery%' 
                            OR brand.name LIKE '%$searchQuery%')";
            }

            // Add category filter condition
            if (!empty($selectedCategories)) {
                $categoryFilter = implode(",", array_map('intval', $selectedCategories));
                $query .= " AND category.id IN ($categoryFilter)";
            }

            // Add brand filter condition
            if (!empty($selectedBrands)) {
                $brandFilter = implode(",", array_map('intval', $selectedBrands));
                $query .= " AND brand.id IN ($brandFilter)";
            }

            $result = $connection->query($query);
            $products = $result->fetch_all(MYSQLI_ASSOC);

            // Display products
            if (empty($products)) {
                echo "<p>No products found.</p>";
            } else {
                foreach ($products as $product) {
                    echo '
                        <div class="item">
                            <img src="../' . $product['photo'] . '" alt="photo">
                            <p class="category">' . htmlspecialchars($product['category_name']) . '</p>
                            <p class="name">' . htmlspecialchars($product['product_name']) . '</p>
                            <p class="brand">' . htmlspecialchars($product['brand_name']) . '</p>
                            <a class="card-button" href="../pages/seller_products.php?id=' . $product['ProductID'] . '">VIEW SELLERS</a>
                        </div>
                    ';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>