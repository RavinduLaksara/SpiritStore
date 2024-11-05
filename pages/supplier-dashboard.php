<?php
include('../Headers\supplierHeadder.html');
include(__DIR__ . '/../dbconnect.php');

if (!isset($_GET['id'])) {
    header("Location: Forms\login.php");
    exit;
}

$supplier_id = $_GET['id'];

// Get supplier name
$sql = "SELECT name FROM supplier WHERE id = '$supplier_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$supplier_name = $row[0];

// Get store name and id
$sql = "SELECT store_id, name FROM store WHERE supplier_id = '$supplier_id'";
$result = $connection->query($sql);
$row = $result->fetch_array();
$store_name = $row[1];
$store_id = $row[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <section class="heros">
        <img src="../image/dashboard.jpeg" class="animated-images">
        <h1>SUPPLIER DASHBOARD</h1>
    </section>

    <section class="content">
        <div class="name-container">
            <?php echo "<h3>$supplier_name  -  $store_name</h3>"; ?>
        </div>

        <div class="display-products">
            <h3>Available Products</h3>
            <?php
            // Get prooduct ids that store have
            $sql = "SELECT * FROM storeproduct WHERE storeID = '$store_id'";
            $result = $connection->query($sql);
            while ($row = $result->fetch_assoc()) {
                // Get product image and name
                $sql = "SELECT Name, photo from product WHERE ProductID = '$row[ProductID]'";
                $result_product = $connection->query($sql);
                $row_product = $result_product->fetch_assoc();

                echo "
                    <div>
                        <img src = '../{$row_product['photo']}' alt = 'Product image'>
                        <p>{$row_product['Name']}</p>
                        <p>Price Rs. {$row['Price']}</p>
                        <p>Quntity - {$row['Quantity']}</p>
                        <button><a href='../Forms/edit_product_details.php?productID={$row['ProductID']}&storeID=$store_id'>Edit</a></button>
                        <button><a href='../Forms\delete_product.php?productID={$row['ProductID']}&storeID=$store_id'>Delete</a></button>
                    </div>
                ";
            }
            ?>
        </div>
    </section>

</body>

</html>