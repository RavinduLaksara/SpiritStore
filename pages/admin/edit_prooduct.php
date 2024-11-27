<?php
session_start();
include(__DIR__ . '/../../dbconnect.php');
include(__DIR__ . '/../../Headers/adminHeader.php');

if (!isset($_GET['id'])) {
    header("Location: ../admin_dashboard.php");
    exit;
}

$productID = $_GET['id'];

// Get product details
$sql = "SELECT * FROM product WHERE productID = '$productID'";
$result = $connection->query($sql);
$product_row = $result->fetch_assoc();

$exicting_brand_id = $product_row['BrandID'];
$exicting_category_id = $product_row['CategoryID'];

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

        $connection->query("SET FOREIGN_KEY_CHECKS = 1");

        echo "Product Update successfully.";
        header("Location: ../admin_dashboard.php");
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
            <img src="../../<?php echo $product_row['photo']; ?>" alt="product image">
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
                <a href="../../Forms/add_new_brands.php">Add New Brand</a><br>
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
                <a href="../../Forms/add_new_category.php">Add New Category</a><br>
                <input type="text" placeholder="Country" name="country" required value="<?php echo $product_row['Country'] ?>"><br>
                <input type="text" placeholder="ABV" name="ABV" required value="<?php echo $product_row['ABV'] ?>"><br>
                <input type="submit" value="Update Details">
            </form>
        </div>
    </div>
</body>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f9f9f9;
    padding: 20px;
}

.content {
    margin-left: 300px;
    max-width: 900px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

h1 {
    width: 100%;
    font-size: 24px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

.left {
    flex: 1 1 40%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.left img {
    max-width: 100%;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.right {
    flex: 1 1 55%;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input, textarea, select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

input:focus, textarea:focus, select:focus {
    border-color: #007bff;
    outline: none;
}

textarea {
    resize: none;
}

a {
    color: #007bff;
    text-decoration: none;
    font-size: 14px;
}

a:hover {
    text-decoration: underline;
}

span {
    font-size: 14px;
    color: #555;
}

input[type="submit"] {
    background-color: gray;
    color: #fff;
    border: none;
    cursor: pointer;
    padding: 12px;
    font-size: 16px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .content {
        flex-direction: column;
        align-items: center;
    }

    .left, .right {
        flex: 1 1 100%;
    }

    .left img {
        max-width: 70%;
    }
}

</style>
</html>