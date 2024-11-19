<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            background-color: #1a1a1a;
            color: #ffffff;
            padding: 3rem 2rem;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            font-family: Arial, sans-serif;
        }

        .nav-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .nav-container h2 {
            font-size: 1.1rem;
            margin: 0;
            font-weight: 500;
        }

        .nav-container h2:first-child {
            color: #9ca3af;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .nav-container a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .nav-container a:hover {
            color: #9ca3af;
        }

        .nav-container img {
            max-width: 200px;
            height: auto;
            margin: 1rem 0;
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php include(__DIR__ . '/../dbconnect.php'); ?>

    <div class="container">
        <div class="nav-container">
            <h2>Spirit Store</h2>
            <h2>E-commerce <br>
                Platform for
                liquor stores
            </h2>
        </div>

        <div class="nav-container">
            <h2>Quick Links</h2>
            <h2><a href="<?= APP_URL ?>/homepage.php">Home</a></h2>
            <h2><a href="<?= APP_URL ?>/pages/products.php">Products</a></h2>
            <h2><a href="<?= APP_URL ?>/pages/products_by_category.php?id=4">Whisky</a></h2>
            <h2><a href="<?= APP_URL ?>/pages/products_by_category.php?id=9">Arrack</a></h2>
            <h2><a href="<?= APP_URL ?>/pages/products_by_category.php?id=10">Beers</a></h2>
        </div>

        <div class="nav-container">
            <h2>Information</h2>
            <h2><a href="<?= APP_URL ?>/pages/aboutus.php">About us</a></h2>
            <h2><a href="<?= APP_URL ?>/pages/contactus.php">Contact us</a></h2>
            <h2><a href="<?= APP_URL ?>/pages/privacy_policy.php">Privacy Policy</a></h2>
            <h2><a href="<?= APP_URL ?>/pages/terms_conditions.php">Terms and Conditions</a></h2>
        </div>

        <div class="nav-container">
            <h2>Payment Method</h2>
            <img src="<?= APP_URL ?>/image/payment method.jpg" alt="Payment Methods">
            <h2>Developed by
                <a href="<?= APP_URL ?>/group.php" target="_blank"><br>Group 14</a>
            </h2>
        </div>
    </div>
</body>

</html>