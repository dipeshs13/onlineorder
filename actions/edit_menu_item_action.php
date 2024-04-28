<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];

        // validate the data
        if(empty($name) || empty($description) || empty($price)){
            header('Location: ../admin/menu.php?error= All fields are required');
            exit();
        }
        if(!is_numeric($price)){
            header('Location: ../admin/menu.php?error= Price must be a number');
            exit();
        }
        if(!is_numeric($id)){
            header('Location: ../admin/menu.php?error= Invalid request');
            exit();
        }
        
        if(!empty($image) && !in_array(pathinfo($image, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])){
            header('Location: ../admin/menu.php?error= Invalid image format');
            exit();
        }
        include_once '../utils/db.php';
        $query = "SELECT * FROM foods WHERE id = $id";
        $result = $conn->query($query);
        if($result->num_rows == 0){
            header('Location: ../admin/menu.php?error= Menu item not found');
            exit();
        }

        if(empty($image)){
            $query = "UPDATE foods SET name = '$name', description = '$description', price = '$price' WHERE id = $id";
            if($conn->query($query) === TRUE){
                header('Location: ../admin/menu.php?success=Menu item updated successfully');
            } else {
                header('Location: ../admin/menu.php?error=Error updating menu item');
            }
        }else{
            //remove the old image
            $old_image = $result->fetch_assoc()['image_path'];
            if(file_exists("../".$old_image)){
                unlink("../".$old_image);
            }
            // upload the new image
            $new_name = uniqid('', true).'.'.pathinfo($image, PATHINFO_EXTENSION);
            $target = "../images/".$new_name;
            $image_path = "images/".$new_name;
            
            move_uploaded_file($_FILES['image']['tmp_name'], $target);

        
            $query = "UPDATE foods SET name = '$name', description = '$description', price = '$price', image_path = '$image_path' WHERE id = $id";
            if($conn->query($query) === TRUE){
                header('Location: ../admin/menu.php?success=Menu item updated successfully');
            } else {
                header('Location: ../admin/menu.php?error=Error updating menu item');
            }
        }
    } else {
        header('Location: ../admin/login.php');
    }
}
