<?php
include('Headers\supplierHeadder.html');
include('dbconnect.php');

$sql = "SELECT id, name FROM brand";
$brand_result = $connection->query($sql);

$sql = "SELECT id, name FROM category";
$category_result = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="webpage\style.css">
    <title>Add Products</title>
</head>
<!-- **********File Upload - checck chatgpt note *****************-->

<body>
    <div class="container">
        <h1>Products Details</h1>
        <form action="" method="post">
            <input type="text" placeholder="Product Name" name="name" required><br>
            <textarea name="desc" placeholder="Description" rows="4" cols="40" required></textarea><br>
            <select name="brand_id" required>
                <option>Select Brand</option>
                <?php
                while ($brands = $brand_result->fetch_assoc()) {
                    echo "<option> " . $brands['name'] . "</option>";
                }
                ?>
            </select>
            <span> OR </span>
            <a href="Forms\add_new_brands.php">Add New Brand</a><br>
            <select name="brand_id" required>
                <option>Select Category</option>
                <?php
                while ($category = $category_result->fetch_assoc()) {
                    echo "<option> " . $category['name'] . "</option>";
                }
                ?>
            </select>
            <span> OR </span>
            <a href="Forms\add_new_category.php">Add New Category</a><br>
            <input type="text" placeholder="Country" name="country" required><br>
            <input type="text" placeholder="ABV" name="ABV" required><br>
            <input type="file" placeholder="Upload Product Image" name="photo" accept="image/*" required><br><br>
            <input type="submit" value="Add Product">
        </form>
    </div>
</body>

</html>