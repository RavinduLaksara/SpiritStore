<?php
include('../vendor/autoload.php');
include('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $totalAmount = $_POST['totalAmount'];

    // Stripe secret key
    $stripe_secret_key = "sk_test_51QLqOEJdpXUcmuFpi8EsCLDfaAMV5575GdZJX7KmUmCK0dFkZgfrzN2VystaPmtuluJxtKmeBakq6wAbyFprjAWf00Eb3BH0zE";

    \Stripe\Stripe::setApiKey($stripe_secret_key);

    try {
        // Create Stripe checkout session
        $checkout_session = \Stripe\Checkout\Session::create([
            "payment_method_types" => ["card"],
            "line_items" => [
                [
                    "price_data" => [
                        "currency" => "lkr",
                        "product_data" => [
                            "name" => "Spirit Store" // A placeholder name for the order
                        ],
                        "unit_amount" => intval($totalAmount * 100) // Convert total amount to cents
                    ],
                    "quantity" => 1 // Required field, set default to 1
                ]
            ],
            "mode" => "payment",
            "success_url" => "http://localhost/spiritStore/homepage.php?session_id={CHECKOUT_SESSION_ID}",
            "cancel_url" => "http://localhost/spiritStore/pages/checkout.php"
        ]);

        // Redirect to Stripe Checkout
        http_response_code(303);
        header("Location: " . $checkout_session->url);
    } catch (Exception $e) {
        echo 'Error creating checkout session: ' . $e->getMessage();
    }
}
