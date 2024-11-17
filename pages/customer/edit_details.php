<?php
include(__DIR__ . '/../../dbconnect.php');
include('../../Headers\customerHeader.php');


if (!isset($_SESSION['userid'])) {
    header('Location: ../Forms/login.php');
    exit;
}

$customer_id = $_SESSION['userid'];

// get customer details
$sql = "SELECT * FROM customer WHERE id = '$customer_id'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $state = htmlspecialchars($_POST['state']);
    $city = htmlspecialchars($_POST['city']);
    $postal_code = htmlspecialchars($_POST['postal_code']);
    $password = isset($_POST['password']) && !empty($_POST['password'])
        ? password_hash($_POST['password'], PASSWORD_DEFAULT)
        : null;

    try {
        // Build the SQL query dynamically based on inputs
        $query = "UPDATE customer SET name = ?, email = ?, phone = ?, state = ?, city = ?, postal_code = ?";
        $params = [$name, $email, $phone, $state, $city, $postal_code];

        if ($password) {
            $query .= ", password = ?";
            $params[] = $password;
        }

        $query .= " WHERE CustomerID = ?";
        $params[] = $customerID;

        // Prepare and execute the statement
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

<body>
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
                <input type="text" name="name" value="<?php echo $row['name'] ?>" required><br>

                <label for="email">Email *</label>
                <input type="email" name="email" value="<?php echo $row['email'] ?>" required><br>

                <label for="phone">Phone *</label>
                <input type="tel" name="phone" value="<?php echo $row['phone'] ?>" required><br>

                <label for="password">New Password (leave blank to keep current password)</label>
                <input type="password" name="password" id="password"><br>

                <label for="state">State *</label>
                <input type="text" name="state" value="<?php echo $row['state'] ?>" required><br>

                <label for="city">City *</label>
                <input type="text" name="city" value="<?php echo $row['city'] ?>" required><br>

                <label for="postal_code">Postal Code *</label>
                <input type="text" name="postal_code" value="<?php echo $row['postal_code'] ?>" required><br><br>

                <button type="submit">Update Details</button>
            </form>
        </div>
    </div>
</body>

</html>