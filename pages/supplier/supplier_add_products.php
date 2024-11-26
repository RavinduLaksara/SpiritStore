<?php

include('../../Headers/supplierHeadder.php');
include(__DIR__ . '../../../dbconnect.php');

if (!isset($_SESSION['userid'])) {
    header("Location: Forms/login.php");
    exit;
}

$supplier_id = $_SESSION['userid'];

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
    <div class="content">
        <div class="container-modify">
            <h1>ADD PRODUCTS</h1>

            <!-- Search Form -->
            <form method="GET" action="seller_products.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($supplier_id); ?>">
                <input type="text" name="search" placeholder="Search products, brands, or categories" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit">Search</button>
            </form>

            <h2>Available Products in Spirit Store</h2>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display products in table rows
                    if ($product_result->num_rows === 0) {
                        echo "<tr><td colspan='5'>No products found.</td></tr>";
                    } else {
                        while ($row_product = $product_result->fetch_assoc()) {
                            $brand_name = $row_product['brand_name'];
                            $category_name = $row_product['category_name'];
                            echo "
                <tr>
                    <td><img src='../{$row_product['photo']}' alt='Product image' width='50' height='50'></td>
                    <td>{$row_product['name']}</td>
                    <td>$brand_name</td>
                    <td>$category_name</td>
                    <td>
                        <a class='card-button' href='../../Forms/add_more_stock.php?productID={$row_product['ProductID']}&storeID=$store_id'>Add More Stock</a>
                    </td>
                </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table><br><br><br><br>
            <span>OR</span>
            <a class="add" href="../../Forms/add_new_product.php">Add new product</a>
</body>
<style>
    /* Form styles */
    form {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .add {
        padding: 10px;
        background-color: #000;
        text-decoration: none;
        color: #fff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border-radius: 4px;

    }

    form input[type="text"] {
        padding: 10px;
        width: 60%;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        margin-right: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    form button {
        padding: 10px 20px;
        background-color: #444;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #222;
    }

    * {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    .content {
        margin-left: 300px;
        max-width: 1100px;
        width: 90%;
        padding: 20px;
        background: #fff;
        /* White container */
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        background-color: #e6e6e6;
        /* Light gray background */
        color: #333;
        /* Dark gray text */
    }

    /* Heading */
    h1 {
        font-size: 28px;
        color: #222;
        /* Black heading text */
        text-align: center;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    table th,
    table td {
        padding: 15px 20px;
        text-align: center;
        border: none;
    }

    thead {
        background-color: #444;
        /* Dark gray header */
        color: #fff;
        /* White header text */
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    tbody tr {
        background-color: #f9f9f9;
        /* Light gray rows */
        transition: all 0.3s ease;
    }

    tbody tr:nth-child(even) {
        background-color: #ececec;
        /* Slightly darker gray for alternating rows */
    }

    tbody tr:hover {
        background-color: #ddd;
        /* Highlight gray on hover */
        transform: scale(1.02);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    table th:first-child,
    table td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    table th:last-child,
    table td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    /* Action Links */
    .card-button {
        display: inline-block;
        padding: 8px 12px;
        background-color: #444;
        /* Dark gray background */
        color: #fff;
        /* White text */
        text-decoration: none;
        font-weight: bold;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .card-button:hover {
        background-color: #333;
        /* Darker gray background */
        color: #fff;
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .content {
            width: 100%;
            padding: 15px;
        }

        table th,
        table td {
            font-size: 14px;
            padding: 10px;
        }

        h1 {
            font-size: 22px;
        }
    }
</style>

</html>