<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/loginregister.css">
    <style>

        *{
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
   
}
#main-nav{
width:100%;
background-color:#000000;
padding:5px;
margin:0;

z-index: 2;
}
.main-nav{
width: 1180px;
height:65px;
display:block;
margin: 0 auto;
}
.main-nav .logo-section{
padding:15px 0 0 0;
font-size: 30px;
font-weight: bold;
text-transform: uppercase;
color:#fff;
float: left;
}
.main-nav .nav-manu{
padding:25px 0 0 0;
}
.main-nav .nav-manu ul{
list-style: none;
margin: 0;
padding: 0;
}
nav .logo p{
    font-size: 30px;
    font-weight: bold;
    float: left;
    color: white;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    cursor: pointer;

}
nav ul{
    float: right;
}
nav li{
    display: inline-block;
    line-height: none;
}
nav li a{
    font-size: 18px;
    text-transform: uppercase;
    font-weight: bold;
    padding: 0px 25px;
    color: white;
    text-decoration: none;
}
nav li a:hover{
    color: #928585;
}

</style>
        

</head>

<body>
<nav id="main-nav">
  <div class="main-nav">
    <div class="logo-section">FoodHub</div>
    <div class="nav-manu">
      <ul>
        <li><a href="index.php">Home</a></li>
        <?php if (isset($_SESSION['email'])): ?>
          <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1): ?>
            <li><a href="./admin/dashboard.php">Dashboard</a></li>
          <?php else: ?>
            <li><a href="./order.php">Order</a></li>
          <?php endif; ?>
          <li><a href="./actions/logout_action.php">Logout</a></li>
        <?php else: ?>
          <li><a href="./login.php">Login</a></li>
          <li><a href="./register.php">Register</a></li>
        <?php endif; ?>
        
        </a></li>
      </ul>
    </div>
  </div>
</nav>
   

      
    <div class="container">
        <h2>Register</h2>

        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo "<p style='color:red;'>$error</p>";
        }
        ?>
        <form id="registerForm" action="./actions/register_action.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="fullname">Full name:</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script>
        function validateForm() {
            var phoneInput = document.getElementById("phone").value;
            if (phoneInput.length !== 10 || isNaN(phoneInput)) {
                alert("Phone number must be a 10-digit number.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</body>

</html>