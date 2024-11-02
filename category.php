<?php
include("dbconnect.php");
include("Headers/customerHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="style.css"  />
    

</head>
<body>


<?php
include("dbconnect.php");

// Check if 'id' is set in the URL and is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $category_id = $_GET['id'];

    // Query to get the category name and description
    $category_sql = "SELECT * FROM category WHERE id = $category_id";
    $category_result = mysqli_query($connection, $category_sql);

    if (mysqli_num_rows($category_result) > 0) {
        $category = mysqli_fetch_assoc($category_result);
        echo "<h1>" . htmlspecialchars($category['name']) . "</h1>";
        echo "<p>" . htmlspecialchars($category['descri']) . "</p>";

        // Query to get products in this category
        $product_sql = "SELECT * FROM product WHERE CategoryID = $category_id";
        $product_result = mysqli_query($connection, $product_sql);

        if (mysqli_num_rows($product_result) > 0) {
            echo "<div class='product-list'>";
            while ($product = mysqli_fetch_assoc($product_result)) {
                echo "<div class='product-item'>";
                echo "<h3>" . htmlspecialchars($product['Name']) . "</h3>";
                echo "<p>" . htmlspecialchars($product['Description']) . "</p>";
                echo "<p>ABV: " . htmlspecialchars($product['ABV']) . "%</p>";
                echo "<p>Country: " . htmlspecialchars($product['Country']) . "</p>";
                echo "<img width=200 src='".htmlspecialchars($product['photo']) . "' alt='" . htmlspecialchars($product['Name']) . "'>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No products found in this category.";
        }
    } else {
        echo "Category not found.";
    }
} else {
    echo "Invalid category ID.";
}
?>


  </body>
</html>
