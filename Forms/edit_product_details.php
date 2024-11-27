<?php
session_start();
include(__DIR__ . '/../dbconnect.php');

if (!isset($_GET['productID']) && !isset($_GET['storeID'])) {
    header("Location: ../pages\supplier-dashboard.php");
    exit;
}

$productID = $_GET['productID'];
$storeID = $_GET['storeID'];

// Get supplier id
$sql = "SELECT supplier_id FROM store WHERE store_id = '$storeID'";
$result_id = $connection->query($sql);
$row_id = $result_id->fetch_array();
$supplier_id = $row_id[0];

// Get product details
$sql = "SELECT * FROM product WHERE productID = '$productID'";
$result = $connection->query($sql);
$product_row = $result->fetch_assoc();

$exicting_brand_id = $product_row['BrandID'];
$exicting_category_id = $product_row['CategoryID'];

// Get price and quntity
$sql = "SELECT Price, Quantity FROM storeproduct WHERE StoreID = '$storeID' AND ProductID = '$productID'";
$result = $connection->query($sql);
$price_quantity = $result->fetch_array();

$price = $price_quantity[0];
$quantity = $price_quantity[1];


function getKeyByValue($array, $value)
{
    foreach ($array as $key => $val) {
        if ($val == $value) {
            return $key;
        }
    }
    return null;
}


function getArray($result)
{
    $arr = array();
    while ($row = $result->fetch_assoc()) {
        $arr[$row['id']] = $row['name'];
    }
    return $arr;
}


$sql = "SELECT id, name FROM brand";
$brand_result = $connection->query($sql);
$brands = getArray($brand_result);

$sql = "SELECT id, name FROM category";
$category_result = $connection->query($sql);
$categorys = getArray($category_result);

$new_brand_id = isset($_SESSION['new_brand_id']) ? $_SESSION['new_brand_id'] : null;
unset($_SESSION['new_brand_id']);

$new_category_id = isset($_SESSION['new_category_id']) ? $_SESSION['new_category_id'] : null;
unset($_SESSION['new_category_id']);

// Update details in database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $brand_id = $_POST['brand'];
    $category_id = $_POST['category'];
    $country = $_POST['country'];
    $ABV = $_POST['ABV'];
    $local = strtolower($country) == 'sri lanka' ? 'local' : 'imported';
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    do {
        if (empty($name) || empty($desc) || empty($brand_id) || empty($category_id) || empty($country) || empty($ABV) || empty($local)) {
            echo "All details are Required";
            break;
        }
        $connection->query("SET FOREIGN_KEY_CHECKS = 0");

        $sql = "UPDATE product SET Name = '$name', Description = '$desc', BrandID = '$brand_id', CategoryID = '$category_id', Local_imported = '$local', Country = '$country', ABV = '$ABV' WHERE ProductID = '$productID'";

        $result = $connection->query($sql);

        if (!$result) {
            echo "Invalid Query";
            break;
        }

        $sql = "UPDATE storeproduct SET Quantity = '$quantity', Price = '$price' WHERE StoreID = '$storeID' AND ProductID = '$productID'";

        $result = $connection->query($sql);

        if (!$result) {
            echo "Invalid Query";
            break;
        }

        $connection->query("SET FOREIGN_KEY_CHECKS = 1");

        echo "Product Update successfully.";
        header("Location: ../pages/supplier/supplier_dashboard.php?id=" . $supplier_id);
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>

<body>
    <div class="content">
        <h1>Edit Product Details</h1>
        <div class="left">
            <img src="<?php echo $product_row['photo']; ?>" alt="product image">
        </div>
        <div class="right">
            <form action="" method="post">
                <input type="text" placeholder="Product Name" name="name" required value="<?php echo $product_row['Name'] ?>"><br>
                <textarea name="desc" placeholder="Description" rows="4" cols="40" required><?php echo $product_row['Description'] ?></textarea><br>
                <select name="brand" required>
                    <option></option>
                    <?php
                    foreach ($brands as $key => $value) {
                        $selected = ($key == $exicting_brand_id || $key == $new_brand_id) ? 'selected' : '';
                        echo "<option value='$key' $selected>$value</option>";
                    }
                    ?>
                </select>
                <span> OR </span>
                <a href="Forms\add_new_brands.php">Add New Brand</a><br>
                <select name="category" required>
                    <option>Select Category</option>
                    <?php
                    foreach ($categorys as $key => $value) {
                        $selected = ($key == $exicting_category_id || $key == $new_category_id) ? 'selected' : '';
                        echo "<option value='$key' $selected>$value</option>";
                    }
                    ?>
                </select>
                <span> OR </span>
                <a href="Forms\add_new_category.php">Add New Category</a><br>
                <input type="text" placeholder="Country" name="country" required value="<?php echo $product_row['Country'] ?>"><br>
                <input type="text" placeholder="ABV" name="ABV" required value="<?php echo $product_row['ABV'] ?>"><br>
                <input type="text" placeholder="Price Rs." name="price" required value="<?php echo $price ?>"><br>
                <input type="number" placeholder="Quantity" name="quantity" min="1" value="<?php echo $quantity ?>"><br>
                <input type="submit" value="Update Details">
            </form>
        </div>
    </div>
</body>
<style>
    body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.content {
    display: flex;
    gap: 20px;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 900px;
    width: 90%;
    flex-wrap: wrap; /* Makes it responsive */
}

h1 {
    text-align: center;
    width: 100%;
    margin-bottom: 20px;
    font-size: 1.8em;
    color: #333;
}

/* Left Section (Image) */
.left img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
    max-height: 400px;
    display: block;
    margin: auto;
}

/* Right Section (Form) */
.right {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 10px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

form input[type="text"],
form input[type="number"],
form textarea,
form select {
    width: 100%;
    padding: 10px;
    font-size: 1em;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    outline: none;
    transition: border-color 0.3s ease;
}

form input[type="text"]:focus,
form input[type="number"]:focus,
form textarea:focus,
form select:focus {
    border-color: #333;
}

form textarea {
    resize: none;
}

form input[type="submit"] {
    background-color: #333;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
    background-color: #555;
}

/* Links for "Add New Brand/Category" */
form span {
    font-size: 0.9em;
    color: #555;
}

form a {
    font-size: 0.9em;
    color: #007bff;
    text-decoration: none;
}

form a:hover {
    text-decoration: underline;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .content {
        flex-direction: column;
        align-items: center;
    }

    .left,
    .right {
        width: 100%;
    }
}
</style>
</html>