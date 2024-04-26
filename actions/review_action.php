<?php
include_once '../utils/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $userid = $_POST['userid'];
    $comment= $_POST['review_text'];

        $sql = "INSERT INTO review (u_id, r_comment) VALUES ('$userid', '$comment')";
        
        // Execute the query
        if (mysqli_query($conn, $sql)) {
           header("location: ../index.php?success");
           exit();
        } else {
            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);

            header("location: ../index.php?failure");
            exit();
        }
    } 
    
   

?>



?>