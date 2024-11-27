<?php
include(__DIR__ . '/../dbconnect.php');
include('../Headers\customerHeader.php');


if (!isset($_GET['id'])) {
    header("location: index.php");
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $po_code = $_POST['postal_code'];

    do {
        if (empty($name) || empty($state) || empty($city) || empty($po_code)) {
            echo "All details are Requird";
            break;
        }

        $sql = "INSERT INTO store (name, supplier_id, state, city, postal_code) VALUES ('$name', '$id', '$state', '$city', '$po_code')";

        $result = $connection->query($sql);

        if (!$result) {
            echo "Invalid Query";
            break;
        }

        echo "Registration Successfully";
        header("location: ../pages/pending_approve.php");
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../webpage/style.css">
    <title>Store Registration</title>

    <style>
        * {
            margin-left: 0;
            margin-top: 0;
            margin-right: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 0;
            height: 100vh;
            background-image: url('../image/photo1.jpg');
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

        .form-container a {
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <div class="form-box"></div>
            <h2>Store Registration</h2>
            <form action="#" method="post">

                <h3>Enter Your Store Details</h3>
                <div class="input-box">
                    <input type="text" name="name" required>
                    <label>Store Name</label>
                </div>

                <h3>Enter Your Address</h3>
                <div class="input-box">
                    <span class="icon"><ion-icon name="location-outline"></ion-icon></span>
                    <input type="text" name="state" required>
                    <label>State</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="location-outline"></ion-icon></span>
                    <input type="text" name="city" required>
                    <label>City</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="location-outline"></ion-icon></span>
                    <input type="text" name="postal_code" required>
                    <label>Postel Code</label>
                </div>


                <button type="submit" value="Register Store"> Submit</button>
            </form>
        </div>
</body>

</html>