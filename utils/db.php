<?php
// new mysqli connection to the database

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'online_food_ordering';

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die('Database error: ' . $conn->connect_error);
}
