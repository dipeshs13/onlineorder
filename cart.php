<?php session_start();
include_once './utils/db.php';
$cart = $_SESSION['cart'] ?? [];
// fetch all the food items in the cart
$food_ids = array_column($cart, 'id');

$food_ids = implode(',', $food_ids);
if (empty($food_ids)) {
    $foods = [];
    $cart = [];
    $total = 0;
} else {
    $query = "SELECT * FROM foods WHERE id IN ($food_ids)";
    $result = $conn->query($query);
    $foods = $result->fetch_all(MYSQLI_ASSOC);
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
                <li><a href="index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>

        <h2>Cart</h2>
        <table>
            <thead>
                <tr>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                if (empty($cart)) {
                    echo '<tr><td colspan="5">Cart is empty</td></tr>';
                } else {
                    foreach ($foods as $food) {
                        $cart_item = array_values(array_filter($cart, function ($item) use ($food) {
                            return $item['id'] == $food['id'];
                        }))[0];
                        $total += $food['price'] * $cart_item['quantity'];
                        ?>
                        <tr>
                            <td><?php echo $food['name'] ?></td>
                            <td><?php echo $food['price'] ?></td>
                            <td><?php echo $cart_item['quantity'] ?></td>
                            <td><?php echo $food['price'] * $cart_item['quantity'] ?></td>
                            <td><a href="./actions/remove_from_cart.php?id=<?php echo $food['id'] ?>">Remove</a></td>

                        </tr>
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
                            style="background-color: #4CAF50; border: none; color: white; padding: 10px; border-radius: 5px; cursor: pointer;"
                            >Place Order</button>

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