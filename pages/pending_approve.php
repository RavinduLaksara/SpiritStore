<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval Pending</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #333;
            margin-top: 0;
            margin-bottom: 1rem;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 1rem;
        }

        p {
            color: #666;
            margin-bottom: 1.5rem;
        }

        a {
            display: inline-block;
            background-color: #000;
            color: #fff;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        a:hover {
            background-color: #333;
            transform: translateY(-2px);
        }

        @media (max-width: 480px) {
            .container {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>You are not approved yet!</h2>
        <img src="../image/approve.png" alt="Approval pending illustration">
        <p>Admin will check your details and approve as soon as possible.</p>
        <a href="../homepage.php">Go to Home page</a>
    </div>
</body>

</html>