<?php
include(__DIR__ . '/../dbconnect.php');

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
        header("Location: ../pages\supplier-dashboard.php?id=" . $supplier_id);
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
    <div class="content">
        <h1>Add More Stock</h1>
        <div class="left">
            <img src="../<?php echo $product_row['photo']; ?>" alt="product image">
        </div>
        <div class="right">
            <?php echo "<h3>$product_row[Name]</h3>"; ?>
            <form action="" method="post">
                <input type="text" placeholder="Price RS." name="price" required><br>
                <input type="number" placeholder="Quantity" name="quantity" required><br>
                <input type="submit" value="Add Stock">
            </form>
        </div>
    </div>
</body>

</html>