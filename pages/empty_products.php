<?php include('../Headers/customerHeader.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Out of Stock</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .out-of-stock {
            text-align: center;
            max-width: 400px;
        }

        .out-of-stock p {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .out-of-stock img {
            max-width: 100%;
            height: auto;
            margin-bottom: 1.5rem;
        }

        .out-of-stock a {
            display: inline-block;
            background-color: #000000;
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .out-of-stock a:hover {
            background-color: #333333;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .out-of-stock p {
                font-size: 1.25rem;
            }
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="out-of-stock">
            <p>Sorry, No Products Available</p>
            <img src="../image/out of stock.png" alt="Out of stock">
            <a href="../pages/products.php">Go to Products</a>
        </div>
    </div>
    <?php include('../footer/footer.php') ?>
</body>

</html>