  <?php session_start();
  if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header('Location: ../login.php');
  }

  include_once '../utils/db.php';

$query = "
  SELECT
    orders.id,
    users.fullname as name,
    GROUP_CONCAT(foods.name) as food_names,
    GROUP_CONCAT(order_items.quantity) as quantities,
    GROUP_CONCAT(foods.price) as prices,
    SUM(foods.price * order_items.quantity) as total_price,
    SUM(order_items.quantity) as total_quantity,
    orders.location,
    users.phone,
    orders.status
  FROM
    orders
  JOIN users ON orders.user_id = users.id
  JOIN order_items ON orders.id = order_items.order_id
  JOIN foods ON order_items.food_id = foods.id
  GROUP BY
    orders.id
  ORDER BY
  orders.created_at DESC
  ";


  $result = $conn->query($query);
  // $orders = $result->fetch_all(MYSQLI_ASSOC);



?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online food ordering</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>
    <div class="sidebar">
      <div class="logo"></div>
      <ul class="menu">
        <li>
          <a href="./dashboard.php">
            <!-- <i class="fas fa-tachometer-alt"></i> -->
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./menu.php">
            <!-- <i class="fas fa-user"></i> -->
            <span>Menu</span>
          </a>
        </li>
        <li class="active">
          <a href="./orders.php">
            <!-- <i class="fa-solid fa-calendar-check"></i> -->
            <span>Orders</span>
          </a>
        </li>
        <li>
         

        <li class="logout">
          <a href="">
            <!-- <i class="fas fa-sign-out-alt"></i> -->
            <span><a href="../actions/logout_action.php">Logout</a></span>
          </a>
        </li>
      </ul>
    </div>

    <div class="main_content">
      <div class="header">
        <div class="header_title">
          <span>Online food ordering</span>
          <h2>Orders</h2>
        </div>
      </div>

      <div class="tabular">
        <h3 class="main_title">Orders</h3>
        <?php if (isset($_GET['error'])) {
          $error = $_GET['error'];
          echo "<p style='color:red;'>$error</p>";
        } else if (isset($_GET["success"])) {
          $success = $_GET["success"];
          echo "<p style='color:green;'>$success</p>";
        }
          ?>
        <div class="table_container">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Food Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Location</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              // if empty show no orders
              if ($result->num_rows == 0) {
                  echo "<tr><td colspan='8'>No orders</td></tr>";
              }
              while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo $row['id'] ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['food_names'] ?></td>
                  <td><?php echo $row['prices'] ?></td>
                  <td><?php echo $row['quantities'] ?></td>
                  <td><?php echo $row['total_price'] ?></td>
                  <td><?php echo $row['location'] ?></td>
                  <td><?php echo $row['phone'] ?></td>
                  <td><?php echo $row['status'] ?></td>
                  <td>
                    <?php if ($row['status'] == 'pending') { ?>
                      <a href="../actions/update_order_status.php?id=<?php echo $row['id'] ?>&status=confirmed">Complete</a>
                      <a href="../actions/update_order_status.php?id=<?php echo $row['id'] ?>&status=cancelled">Cancel</a>
                    <?php } else { ?>
                      <a href="../actions/update_order_status.php?id=<?php echo $row['id'] ?>&status=pending">Pending</a>
                    <?php } ?>

                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>

  </html>