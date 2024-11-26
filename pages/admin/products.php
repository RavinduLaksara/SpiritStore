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
                                <td><img src = '../{$row['photo']}' alt = 'Product image' width = 50 height = 60></td>
                                <td>$row[Name]</td>
                                <td>$brand_name</td>
                                <td>$category_name</td>
                                <td>$row[Country]</td>
                                <td>$row[ABV]</td>
                                <td>  <a href = '../admin/edit_prooduct.php?id=$row[ProductID]'>Edit</a></td>
                                <td>  <a href = '../admin/delete_products.php?id=$row[ProductID]'>Delete</a></td>
                            </tr>
                        ";
                }
                ?>
            </tbody>
        </table>
    </div>
    <style>
        /* managesupplier.css */

        /* General styles */
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .content {
            margin-left: 230px;
            max-width: 1100px;
            width: 90%;
            padding: 20px;
            background: #fff;
            /* White container */
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            background-color: #e6e6e6;
            /* Light gray background */
            color: #333;
            /* Dark gray text */
        }

        .content a {
            text-decoration: none;
            color: #000;
        }

        .content a:hover {
            text-decoration: underline;
        }


        /* Heading */
        h1 {
            font-size: 28px;
            color: #222;
            /* Black heading text */
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
            background-color: #444;
            /* Dark gray header */
            color: #fff;
            /* White header text */
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tbody tr {
            background-color: #f9f9f9;
            /* Light gray rows */
            transition: all 0.3s ease;
        }

        tbody tr:nth-child(even) {
            background-color: #ececec;
            /* Slightly darker gray for alternating rows */
        }

        tbody tr:hover {
            background-color: #ddd;
            /* Highlight gray on hover */
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
            color: #444;
            /* Dark gray text */
            text-decoration: none;
            font-weight: bold;
            padding: 8px 12px;
            border: 1px solid #444;
            /* Dark gray border */
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        #m a:hover {
            background-color: #444;
            /* Dark gray background */
            color: #fff;
            /* White text */
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
</body>

</html>