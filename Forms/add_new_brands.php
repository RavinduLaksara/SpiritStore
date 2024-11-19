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

        $sql = "INSERT INTO brand (name, descri) VALUES ('$nsame', '$desc')";
        $result = $connection->query($sql);

        if (!$result) {
            echo "Invalid query";
            break;
        }

        $new_brand_id = $connection->insert_id;
        $_SESSION['new_brand_id'] = $new_brand_id;
        header("Location: ./add_new_product.php");
        exit();
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Add New Brand</title>
</head>

<body>
    <div class="container">
        <div class="form-container">

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
            <style>
                * {margin-left: 0;
  margin-top: 0;
    margin-right: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
  }
  
  .container {
    margin-top: 0;
    height: 100vh;
    background-image: url('photo1.../image/photo1.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .form-container {
    width: 400px;
    padding: 30px;
    background: rgba(156, 141, 141, 0.753);
    border-radius: 35px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
  }
  
  h2 {
    text-align: center;
    color: black;
    margin-bottom: 20px;
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
  
            </style>
        </div>
</body>

</html>