
<?php
session_start();

?>

<?php
include("dbconnect.php");
?>


<?php

if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart_id'])) {
     
        $customer_id = $_SESSION['customer_id']; 

        // Insert a new cart
        $cart_sql = "INSERT INTO cart (customerID, total) VALUES ('$customer_id', 0)";
        mysqli_query($connection, $cart_sql);
        $_SESSION['cart_id'] = mysqli_insert_id($connection); 
    }

    $cart_id = $_SESSION['cart_id'];

    // Check if the product already exists in the cart
    $check_item_sql = "SELECT * FROM cartitem WHERE cartID = $cart_id AND ProductID = $product_id";
    $check_item_result = mysqli_query($connection, $check_item_sql);

    if (mysqli_num_rows($check_item_result) > 0) {
        // Update quantity if the product already exists in the cart
        $cartitem = mysqli_fetch_assoc($check_item_result);
        $new_quantity = $cartitem['Quantity'] + $quantity;
        $update_item_sql = "UPDATE cartitem SET Quantity = $new_quantity, SubTotal = SubTotal + (SELECT Price FROM product WHERE ProductID = $product_id) * $quantity WHERE cartID = $cart_id AND ProductID = $product_id";
        mysqli_query($connection, $update_item_sql);
    } else {
        // Insert new item into cartitem table
        $product_price_query = "SELECT Price FROM product WHERE ProductID = $product_id";
        $product_price_result = mysqli_query($connection, $product_price_query);
        $product_price = mysqli_fetch_assoc($product_price_result)['Price'];

        $subtotal = $product_price * $quantity;
        $insert_item_sql = "INSERT INTO cartitem (cartID, ProductID, Quantity, SubTotal) VALUES ($cart_id, $product_id, $quantity, $subtotal)";
        mysqli_query($connection, $insert_item_sql);
    }

    // Update cart total
    $update_cart_total_sql = "UPDATE cart SET total = (SELECT SUM(SubTotal) FROM cartitem WHERE cartID = $cart_id) WHERE cartID = $cart_id";
    mysqli_query($connection, $update_cart_total_sql);

    // Redirect back to the product page or show a success message
    header("Location: category.php?id=" . $_GET['id']);
    exit;
} else {
    echo "Invalid product or quantity.";
}
?>
