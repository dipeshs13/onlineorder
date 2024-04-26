<?php session_start();

include_once './utils/db.php';
$query = "SELECT * FROM foods ORDER BY id DESC LIMIT 6";
$result = $conn->query($query);
$foods = $result->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Online Food Order</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <style>
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
<nav id="main-nav">
  <div class="main-nav">
    <div class="logo-section">FoodHub</div>
    <div class="nav-manu">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="#menu">Menu</a></li>
        <?php if (isset($_SESSION['email'])): ?>
          <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1): ?>
            <li><a href="./admin/dashboard.php">Dashboard</a></li>
          <?php else: ?>
            <li><a href="#">Order</a></li>
          <?php endif; ?>
          <li><a href="./actions/logout_action.php">Logout</a></li>
        <?php else: ?>
          <li><a href="./login.php">Login</a></li>
          <li><a href="./register.php">Register</a></li>
        <?php endif; ?>
        <li><a href="./card.php">
          <svg fill="white" height="20" width="20" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
              d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
          </svg>
        </a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Menu-->
<div id="menu">
  <div class="menu-container">
    <h2>Our Menu</h2>
    <ul>
      <li>
        <div class="menu-items">
          <img src="img/MOMO.jpg">
          <h3>MOMO</h3>
          <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></p>
          <ul>
            <li>Rs. 150 <span><a href="#" class="order-btn">Order Now</a><a href="#"></a></span></li>
          </ul>
        </div>
      </li>
      <li>
        <div class="menu-items">
          <img src="img/Pizza.jpg">
          <h3>Pizza</h3>
          <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></p>
          <ul>
            <li>Rs. 150 <span><a href="#" class="order-btn">Order Now</a><a href="#"></a></span></li>
          </ul>
        </div>
      </li>
      <li>
        <div class="menu-items">
          <img src="img/Burger.jpg">
          <h3>Burger</h3>
          <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></p>
          <ul>
            <li>Rs. 150 <span><a href="#" class="order-btn">Order Now</a><a href="#"></a></span></li>
          </ul>
        </div>
      </li>
      <li>
        <div class="menu-items">
          <img src="img/Roast Chicken.jpg">
          <h3>Chicken Roast</h3>
          <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></p>
          <ul>
            <li>Rs. 150 <span><a href="#" class="order-btn">Order Now</a><a href="#"></a></span></li>
          </ul>
        </div>
      </li>
      <li>
        <div class="menu-items">
          <img src="img/Pasta.jpg">
          <h3>Pasta</h3>
          <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></p>
          <ul>
            <li>Rs. 150 <span><a href="#" class="order-btn">Order Now</a><a href="#"></a></span></li>
          </ul>
        </div>
      </li>
      <li>
        <div class="menu-items">
          <img src="img/wings.jpg">
          <h3>Chicken wings</h3>
          <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></p>
          <ul>
            <li>Rs. 150 <span><a href="#" class="order-btn">Order Now</a><a href="#"></a></span></li>
          </ul>
        </div>
       
      
      </li>
    </ul>
  </div>
</div>


<div class="modle" id="modle">
    <div class="modle-content">
      <div class="close" onclick="closeModle()">X</div>
      <h2>Order</h2>
      <form action="./actions/order_action.php" method="POST">
        <input type="hidden" id="food_id" name="food_id">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="food_name" name="name" disabled>
        </div>
        <div class="form-group">
          <label for="price">Price:</label>
          <input type="number" id="food_price" name="price" disabled>
        </div>
        <div class="form-group">
          <label for="location">Location:</label>
          <input type="text" id="order_location" name="location" required>
        </div>
        <div class="form-group">
          <label for="Phone no">Phone no:</label>
          <input type="text" id="phone_no" name="Phone no" required>
        </div>
        
        <button type="submit">Order</button>
      </form>
    </div>
  </div>
<div class="footer-buttom">
  <p>Designed By Bijay Gurung and Rohan Thapa Magar</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/jquery.min.js"></script>
<script>
  function order(id, name, price) {
    $('#food_id').val(id);
    $('#food_name').val(name);
    $('#food_price').val(price);
    $('#modle').show();
  }
  function closeModle() {
    $('#modle').hide();
  }
</script>
</body>
</html>
