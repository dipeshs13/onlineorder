<?php
session_start();
include_once '../utils/db.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $new_name = uniqid('', true).'.'.pathinfo($image, PATHINFO_EXTENSION);

        $target = "../images/".$new_name;
        $image_path = "images/".$new_name;

        // Prepare the SQL statement with placeholders
        $query = "INSERT INTO foods (name, price, description, image_path) VALUES (?, ?, ?, ?)";
        
        // Prepare and bind parameters
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siss", $name, $price, $description, $image_path);

        if($stmt->execute()){
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            header('Location: ../admin/menu.php?success=Menu item added successfully');
        } else {
            header('Location: ../admin/menu.php?error=Error adding menu item');
        }
    } else {
        header('Location: ../admin/login.php');
    }
}
?>
