  <?php session_start();
  if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header('Location: ../login.php');
  }

  include_once '../utils/db.php';
  //select all orders from the orders table and join users table and foods table
  $query = "SELECT o.id AS orderid, o.status, u.fullname, u.phone, f.name, f.price, f.image_path, o.location 
  FROM orders AS o
  JOIN order_items AS oi ON o.id = oi.order_id
  JOIN users AS u ON o.user_id = u.id 
  JOIN foods AS f ON oi.food_id = f.id";



  $result = $conn->query($query);

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
          <a href="">
            <!-- <i class="fas fa-cog"></i> -->
            <span>Settings</span>
          </a>
        </li>

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
          <div class="header_search">
              <span>
                  <a href="./add_menu_item.php">Add new item</a>
              </span>
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
                <th>Image</th>
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
                      <td><?php echo $row['orderid']; ?></td>
                      <td><?php echo $row['fullname']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['price']; ?></td>
                      <td><img src="../<?php echo $row['image_path']; ?>" alt="food image" style="width: 100px;"></td>
                      <td><?php echo $row['location']; ?></td>
                      <td><?php echo $row['phone']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                      <td>
                          <?php if ($row['status'] == 'pending') { ?>
                              <a href="../actions/update_order_status.php?orderid=<?php echo $row['orderid']; ?>&status=completed">Complete</a>
                          <?php } else { ?>
                              <a href="../actions/update_order_status.php?orderid=<?php echo $row['orderid']; ?>&status=pending">Pending</a>
                          <?php } ?>

                          <a href="../actions/delete_order.php?orderid=<?php echo $row['orderid']; ?>">Delete</a>
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