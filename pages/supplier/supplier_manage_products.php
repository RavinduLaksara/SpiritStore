<?php
session_start();
// include('../../Headers/supplierHeadder.php');
include(__DIR__ . '../../../dbconnect.php');

if (!isset($_SESSION['userid'])) {
    header("Location: Forms\login.php");
    exit;
}

$supplier_id = $_SESSION['userid'];

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
        <h1>SUPPLIER DASHBOARD</h1>
    </section>

    <section class="content">
        <div class="name-container">
            <?php echo "<h3>$supplier_name  -  $store_name</h3>"; ?>
        </div>

        <div class="display-products">
            <h3>Available Products</h3>
            <!-- Single Table for All Products -->
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Get product IDs that store has
                    $sql = "SELECT * FROM storeproduct WHERE storeID = '$store_id'";
                    $result = $connection->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        // Get product image and name
                        $sql = "SELECT Name, photo FROM product WHERE ProductID = '{$row['ProductID']}'";
                        $result_product = $connection->query($sql);
                        $row_product = $result_product->fetch_assoc();

                        echo "
                            <tr>
                                <td><img src='../{$row_product['photo']}' alt='Product image' style='width: 100px; height: auto;'></td>
                                <td>{$row_product['Name']}</td>
                                <td>Rs. {$row['Price']}</td>
                                <td>{$row['Quantity']}</td>
                                <td>
                                    <a href='../Forms/edit_product_details.php?productID={$row['ProductID']}&storeID=$store_id'>Edit</a> |
                                    <a href='../Forms/delete_product.php?productID={$row['ProductID']}&storeID=$store_id'>Delete</a>
                                </td>
                            </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

<style> * {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}

.content {
    margin-left: 100px;
    max-width: 1100px;
    width: 90%;
    padding: 20px;
    background: #fff; /* White container */
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    background-color: #e6e6e6; /* Light gray background */
    color: #333; /* Dark gray text */
}


/* Heading */
h1 {
    font-size: 28px;
    color: #222; /* Black heading text */
    text-align: center;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

table th,
table td {
    padding: 15px 20px;
    text-align: center;
    border: none;
}

thead {
    background-color: #444; /* Dark gray header */
    color: #fff; /* White header text */
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

tbody tr {
    background-color: #f9f9f9; /* Light gray rows */
    transition: all 0.3s ease;
}

tbody tr:nth-child(even) {
    background-color: #ececec; /* Slightly darker gray for alternating rows */
}

tbody tr:hover {
    background-color: #ddd; /* Highlight gray on hover */
    transform: scale(1.02);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

table th:first-child,
table td:first-child {
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
}

table th:last-child,
table td:last-child {
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
}

/* Action Links */
#m a {
    color: #444; /* Dark gray text */
    text-decoration: none;
    font-weight: bold;
    padding: 8px 12px;
    border: 1px solid #444; /* Dark gray border */
    border-radius: 4px;
    transition: all 0.3s ease;
}

#m a:hover {
    background-color: #444; /* Dark gray background */
    color: #fff; /* White text */
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 100%;
        padding: 15px;
    }

    table th,
    table td {
        font-size: 14px;
        padding: 10px;
    }

    h1 {
        font-size: 22px;
    }
}

</style>

</html>