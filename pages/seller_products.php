<?php
include('../Headers\customerHeader.php');
include(__DIR__ . '/../dbconnect.php');

if (!isset($_GET['id'])) {
    header("Location: Forms\login.php");
    exit;
}

$product_id = $_GET['id'];

// Get prooduct details
$sql = "SELECT Name, photo FROM product WHERE ProductID = '$product_id'";
$result = $connection->query($sql);
$product_row = $result->fetch_assoc();

// Get store, price and quantity
$sql = "SELECT * FROM storeproduct WHERE ProductID = '$product_id'";
$result_store = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Sellers</title>
    <link rel="stylesheet" href="../styles\seller_products.css">
    <link rel="stylesheet" href="../styles\products.css">
    <!-- <link rel="stylesheet" href="../style.css"> -->


</head>

<body>
    <h1>Available Sellers</h1>

    <div class="item-container">
        <?php
        if ($result_store->num_rows == 0) {
            header("Location: ../pages/empty_products.php");
            exit;
        }
        while ($row_store = $result_store->fetch_assoc()) {
            // Get seller name
            $sql = "SELECT name FROM store WHERE store_id = '$row_store[StoreID]'";
            $result = $connection->query($sql);
            $row = $result->fetch_array();
            // $seller_name = $row[0];

            echo "
                    <div class='item item-seller_products'>

                        <p>seller name</p>
                        <img src = '{$product_row['photo']}' alt = 'Product image'>
                        <p>{$product_row['Name']}</p>
                        <p>Price Rs. {$row_store['Price']}</p>";
            if ($row_store['Quantity'] == 0) {
                echo "<span style='color: red;'>* Out of Stock</span><br>";
            } else {
                echo "<p>Quantity - {$row_store['Quantity']}</p>
                <a class='card-button' href='../pages\product_view.php?productID={$product_id}&storeID={$row_store['StoreID']}'>View Product</a>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>