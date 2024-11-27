<?php
include(__DIR__ . '/../dbconnect.php');
include('../Headers/supplierHeadder.php');
if (!isset($_GET['productID']) && !isset($_GET['storeID'])) {
    header("Location: ../pages\supplier-dashboard.php");
    exit;
}

$productID = $_GET['productID'];
$storeID = $_GET['storeID'];

// Get product details
$sql = "SELECT Name, photo FROM product WHERE productID = '$productID'";
$result = $connection->query($sql);
$product_row = $result->fetch_assoc();

// Get supplier id
$sql = "SELECT supplier_id FROM store WHERE store_id = '$storeID'";
$result_id = $connection->query($sql);
$row_id = $result_id->fetch_array();
$supplier_id = $row_id[0];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    do {
        if (empty($price) || empty($quantity)) {
            echo "All details are required.";
            break;
        }

        $connection->query("SET FOREIGN_KEY_CHECKS = 0");

        $sql = "INSERT INTO storeproduct (StoreID, ProductID, Quantity, Price) VALUES ('$storeID', '$productID', '$quantity', '$price')";

        $result = $connection->query($sql);

        if (!$result) {
            echo "Invalid Query";
            break;
        }

        $connection->query("SET FOREIGN_KEY_CHECKS = 1");

        echo "Add stock successfully.";
        header("Location: ../pages/supplier/supplier_dashboard.php?id=" . $supplier_id);
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add More Stock</title>

</head>

<body>
    <div class="container">
        <div class="form-container">

            <h1>Add More Stock</h1>

            <!-- <div class="left">

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

         </div> -->

            <div class="right">

                <form action="" method="post">

                    <div class="input-box">
                        <input type="text" name="price" required>
                        <label>Price RS.</label>
                    </div>

                    <br>


                    <div class="input-box">
                        <input type="number" name="quantity" required>
                        <label>Quantity</label>
                    </div>

                    <br>

                    <button type="submit" value="Add Stock">Submit</button>

                </form>
            </div>
        </div>

        <style>
            * {

                margin-top: 0;
                margin-bottom: 0;
                margin-right: 0;
                margin-left: 0;
                box-sizing: border-box;
                font-family: 'Roboto', sans-serif;

            }

            h1 {
                text-align: center;
            }

            .container {
                height: 100vh;
                background-image: url('../image/photo1.jpg');
                background-size: cover;
                background-position: center;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .form-container {
                align-items: center;
                width: 400px;
                padding: 30px;
                background: rgba(156, 141, 141, 0.753);
                border-radius: 35px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                backdrop-filter: blur(10px);
            }



            /* .left {
                left: 0;
                width: 50%;
            } 

            .right {
                /* margin-left: 50%; */
                /* width: 50%; */
            /* } */


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

            .input-box input:focus~label,
            .input-box input:valid~label {
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
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                margin: 20px auto;
                max-width: 400px;
            }

            .upload-rectangle {
                margin-top: 130px;
                width: 300px;
                /* Rectangle width */
                height: 200px;
                /* Rectangle height */
                border: 2px dashed #070707;
                /* Dashed border */
                border-radius: 10px;
                /* Rounded corners */
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                color: #020202;
                /* Text color */
                font-size: 1em;
                cursor: pointer;
                text-align: center;
                transition: background-color 0.3s ease, border-color 0.3s ease;
            }

            .upload-rectangle:hover {
                background-color: #f4f8ff;
                /* Light background on hover */
                border-color: #0c0c0c;
                /* Darker border color on hover */
            }

            .upload-rectangle i {
                font-size: 2em;
                margin-bottom: 10px;
                /* Spacing below the icon */
            }

            .upload-rectangle .small-text {
                font-size: 0.9em;
                color: #666;
            }

            #image-input {
                display: none;
                /* Hide the actual file input */
            }
        </style>
</body>

</html>