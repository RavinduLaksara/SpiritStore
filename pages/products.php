<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../styles/products.css">
</head>

<body>
    <?php include('../Headers/customerHeader.php'); ?>

    <div class="back-image">
        <h2>PRODUCTS</h2>
    </div>

    <!-- Search Form -->
    <div class="search-container">
        <form method="GET" action="products.php">
            <input type="text" name="search" placeholder="Search for products, brands, or categories" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="content">
        <div class="item-filter">
            <!-- Filter Form -->
            <form method="GET" action="products.php">
                <div class="filter-section">
                    <h4>Filter by Category</h4>
                    <?php
                    include("../dbconnect.php");

                    $categoryResult = $connection->query("SELECT id, name FROM category");
                    while ($category = $categoryResult->fetch_assoc()) {
                        $checked = (isset($_GET['category']) && in_array($category['id'], $_GET['category'])) ? 'checked' : '';
                        echo '<label class="filter-option"><input type="checkbox" name="category[]" value="' . $category['id'] . '" ' . $checked . '> ' . $category['name'] . '</label>';
                    }
                    ?>
                </div>

                <div class="filter-section">
                    <h4>Filter by Brand</h4>
                    <?php
                    $brandResult = $connection->query("SELECT id, name FROM brand");
                    while ($brand = $brandResult->fetch_assoc()) {
                        $checked = (isset($_GET['brand']) && in_array($brand['id'], $_GET['brand'])) ? 'checked' : '';
                        echo '<label class="filter-option"><input type="checkbox" name="brand[]" value="' . $brand['id'] . '" ' . $checked . '> ' . $brand['name'] . '</label>';
                    }
                    ?>
                </div>

                <button type="submit">Apply Filters</button>
            </form>
        </div>

        <div class="item-container">
            <?php
            // Pagination setup
            $itemsPerPage = 10;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $itemsPerPage;

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

            // Count total items for pagination
            $countQuery = "SELECT COUNT(*) AS total_items FROM ($query) AS sub_query";
            $countResult = $connection->query($countQuery);
            $totalItems = $countResult->fetch_assoc()['total_items'];
            $totalPages = ceil($totalItems / $itemsPerPage);

            // Add LIMIT clause for pagination
            $query .= " LIMIT $offset, $itemsPerPage";

            $result = $connection->query($query);
            $products = $result->fetch_all(MYSQLI_ASSOC);

            // Display products
            if (empty($products)) {
                echo "<p>No products found.</p>";
            } else {
                foreach ($products as $product) {
                    echo '
                        <div class="item">
                            <img src="' . $product['photo'] . '" alt="' . htmlspecialchars($product['product_name']) . '">
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


    <?php include('../footer/footer.php'); ?>

</body>

</html>