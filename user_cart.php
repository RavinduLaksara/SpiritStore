<?php
include("dbconnect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="style.css"  />
    
 
</head>
<body>


 
<?php
include("Headers/customerHeader.php");

if (!isset($_SESSION['customer_id'])) {
    echo "<p>Please <a href='customer_login.php'>log in</a> to view your cart.</p>";
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Handle the update or remove requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_item'])) {
        $item_id = $_POST['item_id'];
        $quantity = $_POST['quantity'];

        // Update the quantity in the cartitem table
        $update_sql = "UPDATE cartitem 
                       SET Quantity = '$quantity', 
                           SubTotal = (SELECT Price FROM product WHERE ProductID = (SELECT ProductID FROM cartitem WHERE itemID = '$item_id')) * '$quantity' 
                       WHERE itemID = '$item_id'";
        mysqli_query($connection, $update_sql);
    } elseif (isset($_POST['remove_item'])) {
        $item_id = $_POST['item_id'];

        // Delete the item from the cartitem table
        $delete_sql = "DELETE FROM cartitem WHERE itemID = '$item_id'";
        mysqli_query($connection, $delete_sql);
    }
}

// Query to get the cart for the user
$cart_sql = "SELECT c.cartID, ci.itemID, ci.ProductID, ci.Quantity, ci.SubTotal, p.Name, p.Price 
             FROM cart c 
             JOIN cartitem ci ON c.cartID = ci.cartID 
             JOIN product p ON ci.ProductID = p.ProductID 
             WHERE c.customerID = '$customer_id'";
$cart_result = mysqli_query($connection, $cart_sql);

if (mysqli_num_rows($cart_result) > 0) {
    echo "<h1>Your Cart</h1>";
    echo "<table>";
    echo "<tr><th>Product</th><th>Quantity</th><th>Price</th><th>Subtotal</th><th>Action</th></tr>";
    
    while ($row = mysqli_fetch_assoc($cart_result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
        echo "<td>$" . htmlspecialchars($row['Price']) . "</td>";
        echo "<td>$" . htmlspecialchars($row['SubTotal']) . "</td>";
        
        // Form to update quantity and remove item
        echo "<td>
                <form method='POST' action='user_cart.php' style='display:inline;'>
                    <input type='hidden' name='item_id' value='" . $row['itemID'] . "'>
                    <input type='number' name='quantity' value='" . $row['Quantity'] . "' min='1' max='10'>
                    <button type='submit' name='update_item'>Update</button>
                </form>
                <form method='POST' action='user_cart.php' style='display:inline;'>
                    <input type='hidden' name='item_id' value='" . $row['itemID'] . "'>
                    <button type='submit' name='remove_item'>Remove</button>
                </form>
              </td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>Your cart is empty.</p>";
}
?>



  </body>
</html>

