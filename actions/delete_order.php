<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
        if (isset($_GET['orderid'])) {
            $id = $_GET['orderid'];
            include_once '../utils/db.php';
            
            // Delete related rows from order_items table first
            $query_delete_items = "DELETE FROM order_items WHERE order_id = $id";
            if ($conn->query($query_delete_items) === TRUE) {
                // Now, delete the row from the orders table
                $query_delete_order = "DELETE FROM orders WHERE id = $id";
                if ($conn->query($query_delete_order) === TRUE) {
                    header('Location: ../admin/orders.php?success=Order deleted successfully');
                } else {
                    header('Location: ../admin/orders.php?error=Error deleting order');
                }
            } else {
                header('Location: ../admin/orders.php?error=Error deleting order items');
            }
        } else {
            header('Location: ../admin/orders.php?error=Invalid request');
        }
    } else {
        header('Location: ../admin/login.php');
    }
}
?>
