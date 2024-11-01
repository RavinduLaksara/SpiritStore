<?php
session_start();
include(__DIR__ . '/../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['desc'];

    do {
        if (empty($name) || empty($desc)) {
            echo "All details are required";
            break;
        }

        $sql = "INSERT INTO category (name, descri) VALUES ('$name', '$desc')";
        $result = $connection->query($sql);

        if (!$result) {
            echo "Invalid query";
            break;
        }

        $new_category_id = $connection->insert_id;
        $_SESSION['new_category_id'] = $new_category_id;
        header("Location: ../Forms/products._add.php");
        exit();
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="webpage\style.css">
    <title>Add New Category</title>
</head>

<body>
    <div class="container">
        <h1>Add New Category</h1>
        <form action="" method="post">
            <input type="text" name="name" placeholder="Category Name"><br>
            <textarea name="desc" placeholder="Description" rows="4" cols="40"></textarea><br><br>
            <input type="submit">
        </form>
    </div>
</body>

</html>