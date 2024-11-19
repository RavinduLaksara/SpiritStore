<?php
include(__DIR__ . '/../../dbconnect.php');
include('../../Headers\customerHeader.php');

if (!isset($_SESSION['userid'])) {
    header('Location: ../Forms/login.php');
    exit;
}

$customer_id = $_SESSION['userid'];

// Get customer details
$sql = "SELECT * FROM customer WHERE id = '$customer_id'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $state = htmlspecialchars($_POST['state']);
    $city = htmlspecialchars($_POST['city']);
    $postal_code = htmlspecialchars($_POST['postal_code']);
    $password = isset($_POST['password']) && !empty($_POST['password'])
        ? password_hash($_POST['password'], PASSWORD_DEFAULT)
        : null;

    try {
        $query = "UPDATE customer SET name = ?, email = ?, phone = ?, state = ?, city = ?, postal_code = ?";
        $params = [$name, $email, $phone, $state, $city, $postal_code];

        if ($password) {
            $query .= ", password = ?";
            $params[] = $password;
        }

        $query .= " WHERE id = ?";
        $params[] = $customer_id;

        $stmt = $connection->prepare($query);
        $stmt->bind_param(str_repeat('s', count($params) - 1) . 'i', ...$params);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Details updated successfully.";
        } else {
            echo "No changes were made.";
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Error updating details: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Details</title>
    <link rel="stylesheet" href="../styles/form.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
        color: #000000;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        gap: 20px;
    }

    .left {
        width: 25%;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .left .nav-list a {
        display: block;
        padding: 10px 15px;
        margin: 5px 0;
        color: #000000;
        text-decoration: none;
        font-size: 1.1em;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .left .nav-list a:hover {
        background-color: #f0f0f0;
    }

    .right {
        width: 75%;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        font-size: 2em;
        margin-bottom: 20px;
        color: #000000;
    }

    .form-container form label {
        display: block;
        margin-top: 15px;
        font-size: 1.1em;
        color: #000000;
    }

    .form-container form input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-container form button {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 1em;
        color: #ffffff;
        background-color: #000;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form-container form button:hover {
        background-color: #fff;
        color: #000;
    }
</style>

<body>
    <div class="container">
        <div class="left">
            <div class="nav-list">
                <a href="../../pages/customer_dashboard.php">Dashboard</a>
                <a href="../customer/orders.php">Orders</a>
                <a href="../customer/edit_details.php">Edit Details</a>
                <a href="../customer/logout.php">Log out</a>
            </div>
        </div>
        <div class="right">
            <div class="form-container">
                <h2>Update Your Details</h2>
                <form action="" method="POST">
                    <label for="name">Name *</label>
                    <input type="text" name="name" value="<?php echo $row['name'] ?>" required>

                    <label for="email">Email *</label>
                    <input type="email" name="email" value="<?php echo $row['email'] ?>" required>

                    <label for="phone">Phone *</label>
                    <input type="tel" name="phone" value="<?php echo $row['phone'] ?>" required>

                    <label for="password">New Password (leave blank to keep current password)</label>
                    <input type="password" name="password" id="password">

                    <label for="state">State *</label>
                    <input type="text" name="state" value="<?php echo $row['state'] ?>" required>

                    <label for="city">City *</label>
                    <input type="text" name="city" value="<?php echo $row['city'] ?>" required>

                    <label for="postal_code">Postal Code *</label>
                    <input type="text" name="postal_code" value="<?php echo $row['postal_code'] ?>" required>

                    <button type="submit">Update Details</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>