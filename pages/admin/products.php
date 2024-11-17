<?php

include(__DIR__ . '/../../dbconnect.php');
include(__DIR__ . '/../../Headers/adminHeader.php');

// Get products details
$sql = "SELECT * FROM product";
$result = $connection->query($sql);

// Get Brand & Category details
function getKeyByValue($array, $index)
{
    foreach ($array as $key => $val) {
        if ($key == $index) {
            return $val;
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <div class="content">
        <h1>All Products</h1>
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Country</th>
                    <th>ABV</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    $brand_name =  getKeyByValue($brands, $row['BrandID']);
                    $category_name = getKeyByValue($categorys, $row['CategoryID']);
                    echo "
                            <tr>
                                <td><img src = '../../{$row['photo']}' alt = 'Product image'></td>
                                <td>$row[Name]</td>
                                <td>$brand_name</td>
                                <td>$category_name</td>
                                <td>$row[Country]</td>
                                <td>$row[ABV]</td>
                                <td><a href = '../admin/edit_prooduct.php?id=$row[ProductID]'>Edit</a></td>
                                <td><a href = '../admin/delete_products.php?id=$row[ProductID]'>Delete</a></td>
                            </tr>
                        ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>