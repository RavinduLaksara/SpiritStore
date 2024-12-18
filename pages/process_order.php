<?php
include('../vendor/autoload.php');
include('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $totalAmount = $_POST['totalAmount'];

    session_start();

    try {
        $connection->begin_transaction();

        if (isset($_SESSION['userid'])) {
            // For logged-in users
            $customerID = $_SESSION['userid'];

            // Insert into orders for logged-in users
            $insertOrderQuery = "INSERT INTO orders (CustomerID, TotalAmount, Street, City, OrderDate) 
                                 VALUES (?, ?, ?, ?, NOW())";
            $stmt = $connection->prepare($insertOrderQuery);
            $stmt->bind_param('idss', $customerID, $totalAmount, $street, $city);
            $stmt->execute();
            $orderID = $connection->insert_id;
        } else {
            // For guest users, create an order record but don't link to a customer
            // Use NULL for the CustomerID and other fields
            $insertOrderQuery = "INSERT INTO orders (CustomerID, TotalAmount, Street, City, OrderDate) 
                                 VALUES (NULL, ?, ?, ?, NOW())";
            $stmt = $connection->prepare($insertOrderQuery);
            $stmt->bind_param('dss', $totalAmount, $street, $city);
            $stmt->execute();
            $orderID = $connection->insert_id; // Use the generated OrderID
        }

        // Process cart items
        if (!empty($_SESSION['cartDetails'])) {
            foreach ($_SESSION['cartDetails'] as $item) {
                $productID = $item['ProductID'];
                $storeID = $item['StoreID'];
                $quantity = $item['quantity'];
                $subtotal = $item['subtotal'];

                // Insert into orderdetails
                $insertOrderDetailQuery = "INSERT INTO orderdetails (OrderID, ProductID, StoreID, Quantity, Subtotal) 
                                           VALUES (?, ?, ?, ?, ?)";
                $stmt = $connection->prepare($insertOrderDetailQuery);
                $stmt->bind_param('iiiid', $orderID, $productID, $storeID, $quantity, $subtotal);
                $stmt->execute();

                // Update quantity in storeproduct
                $updateStoreProductQuery = "UPDATE storeproduct 
                                            SET Quantity = Quantity - ? 
                                            WHERE ProductID = ? AND StoreID = ?";
                $updateStmt = $connection->prepare($updateStoreProductQuery);
                $updateStmt->bind_param('iii', $quantity, $productID, $storeID);
                $updateStmt->execute();

                // Update store balance and commission
                // Assume store commission is a percentage of the subtotal, e.g., 10%
                $commissionPercentage = 0.10;

                // Calculate commission and update store balance
                $commissionAmount = $subtotal * $commissionPercentage;

                // Update the store's balance (add the subtotal to the balance)
                $updateStoreBalanceQuery = "UPDATE store
                                            SET balance = balance + ?, commision = commision + ?
                                            WHERE store_id = ?";
                $updateBalanceStmt = $connection->prepare($updateStoreBalanceQuery);
                $updateBalanceStmt->bind_param('dii', $subtotal, $commissionAmount, $storeID);
                $updateBalanceStmt->execute();
            }
        }

        // Clear cart items in database if the user is logged in
        if (isset($customerID)) {
            // Delete cart items for the logged-in user
            $clearCartQuery = "DELETE FROM cartitem WHERE CartID = (SELECT CartID FROM cart WHERE CustomerID = ?)";
            $clearCartStmt = $connection->prepare($clearCartQuery);
            $clearCartStmt->bind_param('i', $customerID);
            $clearCartStmt->execute();

            // Optionally, delete the cart record if no items remain
            $deleteCartQuery = "DELETE FROM cart WHERE CustomerID = ?";
            $deleteCartStmt = $connection->prepare($deleteCartQuery);
            $deleteCartStmt->bind_param('i', $customerID);
            $deleteCartStmt->execute();
        }

        // Clear session cart details
        unset($_SESSION['cart']);
        unset($_SESSION['cartDetails']);

        $connection->commit();

        // Redirect to Stripe Checkout
        $stripe_secret_key = "sk_test_51QLqOEJdpXUcmuFpi8EsCLDfaAMV5575GdZJX7KmUmCK0dFkZgfrzN2VystaPmtuluJxtKmeBakq6wAbyFprjAWf00Eb3BH0zE";
        \Stripe\Stripe::setApiKey($stripe_secret_key);

        $checkout_session = \Stripe\Checkout\Session::create([
            "payment_method_types" => ["card"],
            "line_items" => [
                [
                    "price_data" => [
                        "currency" => "lkr",
                        "product_data" => [
                            "name" => "Spirit Store Order #" . ($customerID ?? "Guest") . " - " . $orderID
                        ],
                        "unit_amount" => intval($totalAmount * 100)
                    ],
                    "quantity" => 1
                ]
            ],
            "mode" => "payment",
            "success_url" => "http://localhost/spiritStore/homepage.php?session_id={CHECKOUT_SESSION_ID}",
            "cancel_url" => "http://localhost/spiritStore/pages/checkout.php"
        ]);

        http_response_code(303);
        header("Location: " . $checkout_session->url);
    } catch (Exception $e) {
        $connection->rollback();
        echo 'Error processing the order: ' . $e->getMessage();
    }
}
