<?php
include('Headers\supplierHeadder.html');
include('dbconnect.php');


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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $connection->real_escape_string($_POST['name']);
    $desc = $connection->real_escape_string($_POST['desc']);
    $brand_name = $_POST['brand_name'];
    $category_name = $_POST['category_name'];
    $country = $connection->real_escape_string($_POST['country']);
    $ABV = $connection->real_escape_string($_POST['ABV']);
    $local = strtolower($country) == 'sri lanka' ? 'local' : 'imported';


    $photo = $_FILES['photo']['name'];
    $target_dir = "product-images/";
    $target_file = $target_dir . basename($photo);
    $uploadOk = 1;


    $check = getimagesize($_FILES['photo']['tmp_name']);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES['photo']['error'] !== 0) {
        echo "Error uploading file.";
        $uploadOk = 0;
    }

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if ($uploadOk) {

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {

            $brand_id = getKeyByValue($brands, $brand_name);
            $category_id = getKeyByValue($categorys, $category_name);

            do {

                if (empty($name) || empty($desc) || empty($brand_id) || empty($category_id) || empty($country) || empty($local) || empty($ABV)) {
                    echo "All details are required.";
                    break;
                }


                $sql = "INSERT INTO product (Name, Description, BrandID, CategoryID, Local_Imported, Country, ABV, photo) 
                        VALUES ('$name', '$desc', '$brand_id', '$category_id', '$local', '$country', '$ABV', '$target_file')";

                $result = $connection->query($sql);

                if (!$result) {
                    echo "Error: Could not insert product into database.";
                    break;
                }

                echo "Product added successfully.";
            } while (false);
        } else {
            echo "Error: Unable to move the uploaded file.";
        }
    } else {
        echo "Error: File upload failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="webpage\style.css">
    <title>Add Products</title>
</head>

<body>
    <div class="container">
        <h1>Products Details</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="Product Name" name="name" required><br>
            <textarea name="desc" placeholder="Description" rows="4" cols="40" required></textarea><br>
            <select name="brand_name" required>
                <option>Select Brand</option>
                <?php
                foreach ($brands as $key => $value) {
                    echo "<option> " . $value . "</option>";
                }
                ?>
            </select>
            <span> OR </span>
            <a href="Forms\add_new_brands.php">Add New Brand</a><br>
            <select name="category_name" required>
                <option>Select Category</option>
                <?php
                foreach ($categorys as $key => $value) {
                    echo "<option> " . $value . "</option>";
                }
                ?>
            </select>
            <span> OR </span>
            <a href="Forms\add_new_category.php">Add New Category</a><br>
            <input type="text" placeholder="Country" name="country" required><br>
            <input type="text" placeholder="ABV" name="ABV" required><br>
            <label for="photo">Upload Product Image</label>
            <input type="file" name="photo" accept="image/*" required><br><br>
            <input type="submit" value="Add Product">
        </form>
    </div>
</body>

</html>