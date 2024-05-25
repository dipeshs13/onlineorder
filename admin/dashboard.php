<?php session_start();
if (!isset($_SESSION['ad_id'])) {
  header('Location: ../login.php');
}
include '../utils/db.php';
$sql = "SELECT COUNT(*) AS total_confirmed FROM orders WHERE status = 'confirmed'";
$result = $conn->query($sql);
$confirmed_orders = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $confirmed_orders = $row['total_confirmed'];
}

$sql_pending = "SELECT COUNT(*) AS total_pending FROM orders WHERE status = 'pending'";
$result_pending = $conn->query($sql_pending);
$pending_orders = 0;

if ($result_pending->num_rows > 0) {
    $row_pending = $result_pending->fetch_assoc();
    $pending_orders = $row_pending['total_pending'];
}

$sql_cancelled = "SELECT COUNT(*) AS total_cancelled FROM orders WHERE status = 'cancelled'";
$result_cancelled = $conn->query($sql_cancelled);
$cancelled_orders = 0;

if ($result_cancelled->num_rows > 0) {
    $row_cancelled = $result_cancelled->fetch_assoc();
    $cancelled_orders = $row_cancelled['total_cancelled'];
}

$conn->close();
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
      <li class="active">
        <a href="./index.php">
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
      <li>
        <a href="./orders.php">
          <!-- <i class="fa-solid fa-calendar-check"></i> -->
          <span>Orders</span>
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
        <h2>Dashboard</h2>
      </div>
    </div>
    
    <div class="card_container">
      <div class="appointment_card">
        <div class="card_header">
          <div class="appointment">
            <span class="title">Confirmed Orders</span>
            <span class="appointment_value"><?php echo $confirmed_orders; ?> orders</span>
          </div>
        </div>
      </div>

      <div class="appointment_card">
        <div class="card_header">
          <div class="appointment">
            <span class="title">Cancelled Orders</span>
            <span class="appointment_value"><?php echo $cancelled_orders; ?> orders</span>
          </div>
        </div>
      </div>

      <div class="appointment_card">
        <div class="card_header">
          <div class="appointment">
            <span class="title">Pending Orders</span>
            <span class="appointment_value"><?php echo $pending_orders; ?> orders</span>
          </div>
        </div>
      </div>

      <!-- <div class="appointment_card">
        <div class="card_header">
          <div class="appointment">
            <span class="title">Total no of items</span>
            <span class="appointment_value">5 orders</span>
          </div>
        </div>
      </div> -->

      <!-- <div class="appointment_card">
        <div class="card_header">
          <div class="appointment">
            <span class="title">Cancel Orde</span>
            <span class="appointment_value">5 orders</span>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</body>

</html>