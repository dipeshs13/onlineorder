<?php
session_start();

// Check if the id parameter is set in the URL
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Check if the product is in the cart array
    if(in_array($product_id, array_column($_SESSION['cart'], 'id'))) {
        // If product is in the cart, find its key and remove it from the cart
        foreach($_SESSION['cart'] as $key => $item) {
            if($item['id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
}

// Redirect to the cart page
header('Location: ../cart.php');
