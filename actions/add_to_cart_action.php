<?php
session_start();

// Check if the 'cart' session array was created
// If it is NOT, create the 'cart' session array
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['food_id'];
    $product_name = $_POST['name'];
    $product_quantity = $_POST['quantity'];
    

    // Check if the same product is in the cart array
    if(in_array($product_id, array_column($_SESSION['cart'], 'id'))) {
        // If product is in the cart, only increase the quantity
        foreach($_SESSION['cart'] as $key => $value) {
            if($value['id'] == $product_id) {
                $_SESSION['cart'][$key]['quantity'] += $product_quantity;
            }
        }
    } else {
        // If product is NOT in the cart, add it to the cart
        $product_array = array(
            'id' => $product_id,
            'name' => $product_name,
            'quantity' => $product_quantity
        );
        $_SESSION['cart'][] = $product_array;
    }
}

// Redirect to the product list page
header('Location: ../cart.php');