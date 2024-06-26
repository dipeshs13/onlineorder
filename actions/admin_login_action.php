<?php
include_once '../utils/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        header('Location: ../login.php?error= All fields are required');
    } else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header('Location: ../login.php?error= Invalid email');
        }
    }
    
    $query = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        // verify password
        $email = $row["email"];
        //verify password
        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['ad_id'] = $row['id'];
            $_SESSION['isAdmin'] = true;
            header('Location: ../admin/dashboard.php');
        } else {
            header('Location: ../admin/login.php?error= Incorrect password');
        }
    } else {
        header('Location: ../admin/login.php?error= User not found');
    }
    $conn->close();
    


}