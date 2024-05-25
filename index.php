<?php session_start();

include_once './utils/db.php';
$query = "SELECT * FROM foods ORDER BY id ASC LIMIT 12";
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
    .review{
    
    padding: 0px 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff;
}
.review_form{
    
    margin: 10px;
    padding: 20px;
}
label{
    display: block;
    margin-bottom: 5px;
    font-size: 30px;
    margin-left: 20px;
}

.review_form button{
    margin-top: 8px;
    border: none;
    padding: 10px 30px;
    background-color: green;
    color: #fff;
    margin-left: 85%;
    
}
#review_section{
    
    width: 50vw;
    margin: 0px auto;
    box-shadow: 0px 4px 15px 3px rgba(0,0,0,0.2);
    
    
    
}
#review_section h2{
    text-align: center;
}
.review_list{
    
    line-height: 25px;
    width: 40vw;
    position: relative;
    
    
}
.name{
    position: relative;
    left: 5%;
    font-size: 15px;
    font-weight: bold; 

}
#Date{
 
    position: relative;
    left: 70%;
    
}
#search{

    width: 40vw;
    resize: none;
    font-size: 20px;
}
button{
    cursor: pointer;
}
#review{
   
    position: relative;
    left: 5%;
    top: 10%;
}
.Review{
  font-family: "Dancing Script", cursive;
    font-optical-sizing: auto;
    font-weight: bold;
    font-style: normal;
    font-size: 80px;
    padding-top: 70px;
    padding-bottom: 20px;
    text-align: center;
    margin-bottom: 10px;
    color:#cb5244;


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
        <li><a href="#review">Review</a></li>
        <?php if (isset($_SESSION['user_email'])): ?>
    <li><a href="./order.php">Order</a></li>
    <li><a href="./actions/logout_action.php">Logout</a></li>
<?php else: ?>
    <li><a href="./login.php">Login</a></li>
    <li><a href="./register.php">Register</a></li>
<?php endif; ?>
        <li><a href="./cart.php">
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
<!--banner start-->
<div class="banner">
  <div class="banner-box">
    <div class="banner-text">
      <h1>Our Delicious Food</h1>
      <p>Our delicious food, where to begin? Let's start with the aroma that wafts through the air, drawing you in like a siren's call. It's the scent of spices mingling in a pot of simmering curry, or the fragrance of garlic and herbs sizzling in a pan of olive oil.</p>
      <div class="banner-order-btn"><a href="#">Order Now</a></div>
    </div>
  </div>
</div>
<!--About-->
<div id="about">
  <div class="about-container">
    <div class="about_main">
      <img src="img/About_us.jpg" alt="about us">
    </div>
    <div class="about-text">
      <h1>About us</h1>
      <h3>Why you choose us?</h3>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
    </div>
  </div>
</div>
<!--Menu-->
<div id="menu">
  <div class="menu-container">
    <h2>Our Menu</h2>
    <ul>
      <?php foreach ($foods as $food) { ?>
      <li>
        <div class="menu-items">
          <img src="./<?php echo $food['image_path']; ?>">
          <h3><?php echo $food['name']; ?></h3>
          <p class="description"><?php echo $food['description']; ?></p>
          <ul>
            <li>Rs.<?php echo $food['price']; ?> <span><a href="#" onclick="order(<?php echo $food['id']; ?>, '<?php echo $food['name']; ?>', <?php echo $food['price']; ?>)" class="order-btn">Add to Cart</a></span></li>
          </ul>
        </div>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>

<div class="modle" id="modle">
    <div class="modle-content">
      <div class="close" onclick="closeModle()">X</div>
      <h2>Order</h2>
      <form action="./actions/add_to_cart_action.php" method="POST">
        <input type="hidden" id="food_id" name="food_id">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="food_name" name="name" readonly>
        </div>
        
        <div class="form-group">
          <label for="quantity">Quantity:</label>
          <input type="number" id="food_quantity" name="quantity" 
          max="10" min="1" default="1"
          required>
        </div>

        
        <button type="submit">Add to Cart</button>
      </form>
    </div>
  </div>

  <div class="Review">
  <p> Customer Review</p>
</div>

<?php
if(isset($_SESSION['user_id'])){
  $userid = $_SESSION['user_id'];
echo'
  <div class="review">
            <form action="actions/review_action.php" class="review_form" id="reviewForm"  method="POST">
             <input type="hidden" name="userid" value="'.$userid.'"> 
                <label for="review">Post a review</label>
                <textarea name="review_text" id="search" cols="80" rows="3"></textarea>
                <button type="submit" name="submit" class="btn">POST</button>
            </form>
        </div>';
}
$sql = "SELECT review.*, users.fullname 
        FROM review 
        INNER JOIN users ON review.u_id = users.id";
$result = mysqli_query($conn, $sql);
  echo'
  <div id="review_section" class="review_box">
              <h2>Reviews</h2>
              <div class="review_list">';
              if (mysqli_num_rows($result) > 0) {
                // Loop through each row of the result set
                while ($row = mysqli_fetch_assoc($result)) {
                  $fullname = $row['fullname'];   
                  $datetime = $row['r_datetime'];
                  $comment = $row['r_comment'];
                    // Output each review as a paragraph
                    // echo '<p>' . $row['r_comment'] . '</p>';

                      
            echo '
            
            <p class="name">'.$fullname.'  <span id="Date">'.$datetime.'</span></p>
            <p id="review">'.$comment.' </p>
            
            ';
                }
            } else {
                // If there are no reviews
                echo '<p>No reviews available.</p>';
            }

            echo '</div>
            </div>';
      ?>

<div class="footer-buttom">
  <p></p>
</div>
  </body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/jquery.min.js"></script>
<script>
  function order(id, name, price) {
    $('#food_id').val(id);
    $('#food_name').val(name);
    $('#food_quantity').val(1);
    $('#modle').show();
  }
  function closeModle() {
    $('#modle').hide();
  }

  const textarea = document.getElementById('search');

let size_increase = function(){
    this.rows = 6;
}

textarea.addEventListener('focus', size_increase);
</script>
</body>
</html>
