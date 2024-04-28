<?php
session_start();
include_once '../utils/db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location = $_POST['location'];
    $total = $_POST['total'];
    $user_id = $_SESSION['user_id']; // assuming the user_id is stored in session
    $cart = $_SESSION['cart'];

    // insert a new row into the orders table
    $query = "INSERT INTO orders (user_id, location,total) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isi', $user_id, $location, $total);
    $stmt->execute();
    $order_id = $conn->insert_id;

    // insert a new row into the order_items table for each item in the cart
    foreach ($cart as $item) {
        $query = "INSERT INTO order_items (order_id, food_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iii', $order_id, $item['id'], $item['quantity']);
        $stmt->execute();
    }

    // clear the cart
    $_SESSION['cart'] = [];

    // redirect to the orders page
    header('Location: ../index.php');
}
?>