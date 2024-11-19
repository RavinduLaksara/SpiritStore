<?php
session_start();
include(__DIR__ . '/../dbconnect.php');

if (!isset($_SESSION['userid'])) {
    header("Lacation: ../Forms/login.php");
}

$supplier_id = $_SESSION['userid'];

// Add store id and price and store data in storeproduct table.
function getDetailsToArray($result)
{
    $arr = array();
    while ($row = $result->fetch_assoc()) {
        $arr[$row['id']] = $row['name'];
    }
    return $arr;
}


$sql = 'SELECT id, name FROM brand';
$result = $connection->query($sql);
$brands = getDetailsToArray($result);

$sql = 'SELECT id, name FROM category';
$result = $connection->query($sql);
$categorys = getDetailsToArray($result);

$new_brand_id = isset($_SESSION['new_brand_id']) ? $_SESSION['new_brand_id'] : null;
unset($_SESSION['new_brand_id']);

$new_category_id = isset($_SESSION['new_category_id']) ? $_SESSION['new_category_id'] : null;
unset($_SESSION['new_category_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $brand_id = $_POST['brand'];
    $category_id = $_POST['category'];
    $country = $_POST['country'];
    $ABV = $_POST['ABV'];
    $local = strtolower($country) == 'sri lanka' ? 'local' : 'imported';



    $photo = $_FILES['photo']['name'];
    $target_dir = "../product-images/";
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

    echo $uploadOk;
    if ($uploadOk) {

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            do {
                if (empty($name) || empty($desc) || empty($brand_id) || empty($category_id) || empty($country) || empty($ABV) || empty($local)) {
                    echo "All details are Required";
                    break;
                }

                $sql = "INSERT INTO product (Name, Description, BrandID, CategoryID, Local_Imported, Country, ABV, photo) VALUES ('$name', '$desc', '$brand_id', '$category_id', '$local', '$country', '$ABV', '$target_file')";

                $result = $connection->query($sql);

                if (!$result) {
                    echo "Invalid Query";
                    break;
                }

                echo "Product added successfully.";
                header("Location: ../pages/supplier/supplier_add_products.php?id= '$supplier_id'");
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
    <title>Add New Product</title>
   
</head>

<body>
<div class="container">
        <div class="form-container">
       
        <h1>Product Details</h1>

        <form action="" method="post" enctype="multipart/form-data">

        <div class="left">

<div class="input-box">
    <div class="image-upload-container">
    <label for="image-input" class="upload-rectangle">
      <i class="fas fa-upload"></i>
      <p>Click to upload an image</p>
      <p class="small-text">(Supported formats: JPG, PNG, GIF)</p>
    </label>
    <input type="file" id="image-input" accept="image/*" />
     </div>
 </div>



 </div>

        <div class="right">            
        <div class="input-box">
                    <input type="text" name="name" required>
                    <label>Product Name</label>
                </div>


        <div class="input-box">
                    <input type="text" name="Description" rows="4" cols="40"  required> 
                    <label>Description</label>
                </div>
              
        <div class="input-box">
            <select name="brand" required><br>
                <option>Select Brand</option>
                <?php
                foreach ($brands as $key => $value) {
                    $selected = ($key == $new_brand_id) ? 'selected' : '';
                    echo "<option value='$key' $selected>$value</option>";
                }
                ?>
            </select>

            <span>or</span>

            <a href="./add_new_brands.php">Add new brand</a><br>
        </div>

            <div class="input-box">
            <select name="category" required>
                <option>Select Category</option>
                <?php
                foreach ($categorys as $key => $value) {
                    $selected = ($key == $new_category_id) ? 'selected' : '';
                    echo "<option value='$key' $selected>$value</option>";
                }
                ?>
            </select>

            <span>or</span>

            <a href="./add_new_category.php">Add new category</a>

            <div class="input-box">
                    <input type="text" name="country" required>
                    <label>Country</label>
                </div>

                <div class="input-box">
                    <input type="text" name="ABV" required>
                    <label>ABV</label>
                </div>
                <button type="submit" value="Add product">Submit</button>

            </div>
            </div>
           
        </form>
    </div>
    <style>
        * {

margin-top: 0;
margin-bottom: 0;
margin-right: 0;
box-sizing: border-box;
font-family: 'Roboto', sans-serif;

}

.h1{
text-align: center;
}

.container {
height: 100vh;
background-image: url('../image/photo1.jpg.jpg');
background-size: cover;
background-position: center;
display: flex;
justify-content: center;
align-items: center;
}

.form-container {
align-items: center;
width: 800px;
padding: 30px;
background: rgba(156, 141, 141, 0.753);
border-radius: 35px;
box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
backdrop-filter: blur(10px);
}



.left{
left: 0;
width: 50%;
}

.right{
margin-left: 50%;
width:50%;
}


.input-box {
position: relative;
margin: 20px 0;
}

.input-box label {
position: absolute;
top: 50%;
left: 10px;
transform: translateY(-50%);
font-size: 14px;
color: black;
transition: 0.3s;
}

.input-box input {
width: 100%;
padding: 10px 10px;
background: transparent;
border: none;
border-bottom: 2px solid rgba(0, 0, 0, 0.5);
outline: none;
font-size: 16px;
color: black;
}

.input-box input:focus ~ label,
.input-box input:valid ~ label {
top: -10px;
font-size: 12px;
color: #1f1d2b;
}

.input-box .icon {
position: absolute;
top: 50%;
right: 10px;
transform: translateY(-50%);
font-size: 18px;
color: black;
}

button {
width: 100%;
padding: 10px;
margin-top: 20px;
background: black;
color: white;
border: none;
border-radius: 5px;
cursor: pointer;
font-size: 16px;
transition: 0.3s;
}

button:hover {
background: #333;
}

.image-upload-container {
margin-top: 20px;;
display: flex;
justify-content: center;
align-items: center;
flex-direction: column;
margin: 20px auto;
max-width: 400px;
}

.upload-rectangle {
margin-top: 180px;
width: 300px; /* Rectangle width */
height: 200px; /* Rectangle height */
border: 2px dashed #070707; /* Dashed border */
border-radius: 10px; /* Rounded corners */
display: flex;
justify-content: center;
align-items: center;
flex-direction: column;
color: #020202; /* Text color */
font-size: 1em;
cursor: pointer;
text-align: center;
transition: background-color 0.3s ease, border-color 0.3s ease;
}

.upload-rectangle:hover {
background-color: #f4f8ff; /* Light background on hover */
border-color: #0c0c0c; /* Darker border color on hover */
}

.upload-rectangle i {
font-size: 2em;
margin-bottom: 10px; /* Spacing below the icon */
}

.upload-rectangle .small-text {
font-size: 0.9em;
color: #666;
}

#image-input {
display: none; /* Hide the actual file input */
}

    </style>
</body>

</html>