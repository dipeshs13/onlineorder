<?php session_start();
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
  header('Location: ../login.php');
}

include_once '../utils/db.php';
$query = "SELECT * FROM foods";
$result = $conn->query($query);
$foods = $result->fetch_all(MYSQLI_ASSOC);
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
      <li>
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
        <h2>Our menus</h2>
      </div>
        <div class="header_search">
            <span>
                <a href="./add_menu_item.php">Add new item</a>
            </span>
        </div>
    </div>

    <div class="tabular">
      <h3 class="main_title">Our Menus</h3>
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
              <th>Name</th>
              <th>Price</th>
              <th>Image</th>
              <th>descriptions</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($foods as $food) { ?>
            <tr>
                <td><?php echo $food['id']; ?></td>
                <td><?php echo $food['name']; ?></td>
                <td><?php echo $food['price']; ?></td>
                <td><img src="../<?php echo $food['image_path']; ?>" alt="<?php echo $food['name']; ?>" width="100"></td>
                 <td><?php echo $food['description']; ?></td>
                <td>
                    <a href="./edit_menu_item.php?id=<?php echo $food['id']; ?>">Edit</a>
                    <a href="../actions/delete_menu_item_action.php?id=<?php echo $food['id']; ?>">Delete</a>
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