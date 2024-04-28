<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){
        if(isset($_GET['id']) && isset($_GET['status'])){
            $id = $_GET['id'];
            $status = $_GET['status'];
            include_once '../utils/db.php';
            $query = "UPDATE orders SET status = '$status' WHERE id = $id";
            if($conn->query($query) === TRUE){
                header('Location: ../admin/orders.php?success=Order status updated successfully');
            } else {
                header('Location: ../admin/orders.php?error=Error updating order status');
            }
        } else {
            header('Location: ../admin/orders.php?error=Invalid request');
        }
    } else {
        header('Location: ../admin/login.php');
    }
}
