<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        include_once '../utils/db.php';
        $query = "UPDATE foods SET name = '$name', price = $price, category = '$category', description = '$description', image = '$image' WHERE id = $id";
        if($conn->query($query) === TRUE){
            header('Location: ../admin/menu.php?success=Menu item updated successfully');
        } else {
            header('Location: ../admin/menu.php?error=Error updating menu item');
        }
    } else {
        header('Location: ../admin/login.php');
    }
}