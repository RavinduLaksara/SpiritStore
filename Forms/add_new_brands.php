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

        $sql = "INSERT INTO brand (name, descri) VALUES ('$name', '$desc')";
        $result = $connection->query($sql);

        if (!$result) {
            echo "Invalid query";
            break;
        }

        $new_brand_id = $connection->insert_id;
        $_SESSION['new_brand_id'] = $new_brand_id;
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
    <title>Add New Brand</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
        <div class="form-box"></div>
          <h2>Add New Brand</h2>
          <form action="#" method="post">

          <h3>Enter Details</h3>
            <div class="input-box">
                <input type="text" name="name" required>
                <label>Brand Name</label>
            </div>
          
            <div class="input-box">
            <input type="text" name="desc" rows="4" cols="40" required>
                <label>Description</label>
                


            </div>

         <button type="submit">Next</button>

        </form>
    </div>
</body>

</html>