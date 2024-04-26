<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){
        $id = $_GET['id'];
        include_once '../utils/db.php';
        $query = "DELETE FROM foods WHERE id = $id";
        if($conn->query($query) === TRUE){
            header('Location: ../admin/menu.php?success=Menu item deleted successfully');
        } else {
            header('Location: ../admin/menu.php?error=Error deleting menu item');
        }
    } else {
        header('Location: ../admin/login.php');
    }
}
