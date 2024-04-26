<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_SESSION['user_id'])){
        // 	CustomerID	FoodID	loation	
        $food_id = $_POST['food_id'];
        $location = $_POST['location'];
        $user_id = $_SESSION['user_id'];
        include_once '../utils/db.php';
        $query = "INSERT INTO orders (CustomerID, FoodID, location) VALUES ('$user_id', '$food_id', '$location')";
        if($conn->query($query) === TRUE){
            header('Location: ../index.php?success=Order placed successfully');
        } else {
            header('Location: ../index.php?error=Error placing order');
        }
    } else {
        header('Location: ../login.php');
    }
}