<?php session_start();
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
  header('Location: ../login.php');
}
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
      <li>
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
        <h2>Dashboard</h2>
      </div>
    </div>
    <div class="card_container">
      <h3 class="main_title">Today's date</h3>
      <div class="card">
        <div class="appointment_card">
          <div class="card_header">
            <div class="appointment">
              <span class="title">
                Total Orders
              </span>
              <span class="appointment_value">
                30 orders
              </span>
            </div>
            <!-- <i class="fas fa-dollar-sign icon">
            </i> -->
            <!-- <i class="fas fa-users icon dark-green"> -->
            </i>
          </div>
          <!-- <span class="card_detail">
            **** **** **** 3484
          </span> -->
        </div>

        <div class="appointment_card">
          <div class="card_header">
            <div class="appointment">
              <span class="title">
                Confirm Orders
              </span>
              <span class="appointment_value">
                10 orders
              </span>
            </div>
            <!-- <i class="fas fa-list icon dark-purple">
            </i> -->
            <!-- <i class="fas fa-check icon dark-blue"> -->
            </i>
          </div>
          <!-- <span class="card_detail">
            **** **** **** 5544
          </span> -->
        </div>

        <div class="appointment_card">
          <div class="card_header">
            <div class="appointment">
              <span class="title">
                Cancel Orders
              </span>
              <span class="appointment_value">
                5 orders
              </span>
            </div>
            <!-- <i class="fas fa-users icon dark-green">
            </i> -->
            <!-- <i class="fas fa-list icon dark-purple"> -->
            </i>
          </div>
          <!-- <span class="card_detail">
            **** **** **** 8896
          </span> -->
        </div>


      </div>
    </div>

    <!-- <div class="tabular">
      <h3 class="main_title">Appointment data</h3>
      <div class="table_container">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Appointment Date</th>
              <th>Appointment Time</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                2024-02-20
              </td>
              <td>Dipesh Kumar Shrestha</td>
              <td>9852829419</td>
              <td>2024-02-26</td>
              <td>5:00pm - 6:00pm</td>
              <td>Pending</td>
              <td><button>Edit</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> -->
  </div>
</body>

</html>