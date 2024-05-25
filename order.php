<?php session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
    exit();
}
include_once './utils/db.php';
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM orders WHERE user_id = $user_id";
$result = $conn->query($query);
$orders = $result->fetch_all(MYSQLI_ASSOC);
$order_items = [];
foreach ($orders as $order) {
    $order_id = $order['id'];
    $query = "SELECT foods.name, foods.price, order_items.quantity 
    FROM order_items JOIN foods ON order_items.food_id = foods.id WHERE order_items.order_id = $order_id";
    $result = $conn->query($query);
    $order_items[$order_id] = $result->fetch_all(MYSQLI_ASSOC);
    $order_items[$order_id]['status'] = $order['status'];
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Food Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
        }

        nav {
            background-color: black;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
        }

        nav h1 {
            display: inline;
        }

        nav ul {
            display: inline;
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-left: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #f44336;
            text-decoration: none;
        }

        a:hover {
            color: #555;
        }

        #modle {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        #modle .modle-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            border-radius: 10px;
        }

        #modle .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        #modle .close:hover,
        #modle .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        #modle form {
            display: flex;
            flex-direction: column;
        }

        #modle form .form-group {
            margin-bottom: 15px;
        }

        #modle form .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        #modle form .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #modle form button[type="submit"] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav>
            <h1>FoodHub</h1>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./cart.php">Cart</a></li>
                <li><a href="./order.php">Order</a></li>
            </ul>
        </nav>

        <h2>Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                if (empty($order_items)) {
                    echo '<tr><td colspan="5">Cart is empty</td></tr>';
                } else {
                    foreach ($order_items as $order_id => $foods) {
                        $order_total = 0;
                        foreach ($foods as $food=>$order_item) {
                            if($food == 'status') {
                                continue;
                            }
                            $order_total += $order_item['price'] * $order_item['quantity'];
                        }
                        ?>
                        <tr>
                            <td>
                                <?php
                                foreach ($foods as $food =>$order_item) {
                                    if($food == 'status') {
                                        continue;
                                    }
                                    echo $order_item['name'] . '<br>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                foreach ($foods as $food=>$order_item) {
                                    if($food == 'status') {
                                        continue;
                                    }
                                    echo $order_item['price'] . '<br>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                foreach ($foods as $food=>$order_item) {
                                    if($food == 'status') {
                                        continue;
                                    }
                                    echo $order_item['quantity'] . '<br>';
                                }
                                ?>
                            </td>
                            <td><?php echo $order_total ?></td>
                            <td>
                                <?php
                                echo $foods['status'];
                                ?>
                            </td>
                            <?php
                    }
                }
                ?>
                    <?php if (!empty($cart)) { ?>
                    <tr>
                        <td colspan="3">Total</td>
                        <td><?php echo $total ?></td>
                        <td style="background-color: #4CAF50; color: white; padding: 10px; border-radius: 5px;">
                            <button onclick="openModle()"
                                style="background-color: #4CAF50; border: none; color: white; padding: 10px; border-radius: 5px; cursor: pointer;">Place
                                Order</button>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="modle" id="modle">
        <div class="modle-content">
            <div class="close" onclick="closeModle()">X</div>
            <h2>Order</h2>
            <form action="./actions/place_order.php" method="post">
                <input type="hidden" name="total" value="<?php echo $total ?>">
                <!-- location -->
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" name="location" required>
                </div>
                <!-- button -->
                <button type="submit">Place Order</button>
            </form>
        </div>
    </div>

</body>
<script>
    function openModle() {
        document.getElementById('modle').style.display = 'block';
    }

    function closeModle() {
        document.getElementById('modle').style.display = 'none';
    }
</script>

</html>