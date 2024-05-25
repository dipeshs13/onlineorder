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
    <style>
        /* CSS */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button[type="submit"] {
    background-color: #4CAF50; /* Green */
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
  <div class="sidebar">
    <div class="logo"></div>
    <ul class="menu">
      <li >
        <a href="./dashboard.php">
          <!-- <i class="fas fa-tachometer-alt"></i> -->
          <span>Dashboard</span>
        </a>
      </li>
      <li class="active">
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
        <h2>Add new item</h2>
      </div>
    </div>
    <form action="../actions/add_menu_item_action.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
      </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <button type="submit">Add</button>
    </form>
  </div>
</body>

</html>