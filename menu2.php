<?php 
  include "includes/connection.php";
  include "includes/functions.php";
  session_start();

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Giki E-Delivery</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="assets/fonts/flat-icon/flaticon.css">
    <link rel="stylesheet" href="assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

  </head>
  <body>


    <!--Navigation Bar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand col-md-10" href="index.php">Giki E-Delivery</a>
    
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto" >
        <li><a class="nav-link" href="index.php">Home</a></li>

      <?php if(isLoggedIn()): ?>
        <li><a class="nav-link" href="profile.php">Profile</a></li>
        <li><a class="nav-link" href="cart.php">Cart</a></li>
        <li><a class="nav-link" href="logout.php">Logout</a></li>

      <?php else: ?>
        <li><a class="nav-link" href="registration.php">Registration</a></li>
        <li><a class="nav-link" href="login.php">Login</a></li>
          
        
      <?php endif; ?>    
        </ul>
      </div>
    </nav>


      <div class="container">

<?php 
echo $_SESSION['restaurant_name'];
  if (isset($_GET['id'])) 
  {
    $r_id = $_GET['id'];

    $query = "SELECT * FROM restaurant where r_id = $r_id";
    $result = mysqli_query($connect,$query);
    while ($row = mysqli_fetch_array($result)) 
    {
      $r_name = $row['r_name'];
      $r_id = $row['r_id'];
      if ($_SESSION['session_counter'] == 0) 
      {
        $_SESSION['restaurant_id1'] = $r_id;
      }
      // $_SESSION['restaurant_name'] = $r_name;
      // $_SESSION['restaurant_id'] = $r_id;
      $_SESSION['session_counter']++;

      echo "<h3 style='font-size: 50px; margin-top: 50px;'><center>$r_name</center></h3>";

    }

    // if ($_SESSION['restaurant_id'] <> $_SESSION['restaurant_id1']) 
    // {
    //   echo "<script type='text/javascript'>
    //             alert('Can not order from different restaurants at same time');
    //         </script>";
    // }
   

    $query1 = "SELECT * FROM categories where restaurant_name = '$r_name'";
    $result1 = mysqli_query($connect,$query1);
    while ($row = mysqli_fetch_array($result1)) 
    {
      $menu_category = $row['cat_name']; 
  
?>
  <div class="row" style="margin-top: 50px">
    <h2 style="font-size: 2vw; margin-bottom: 10px;"><u><?php echo $menu_category ?></u></h2>
  </div>


<?php
      
    $query2 = "SELECT * FROM items ";
    $result2 = mysqli_query($connect,$query2);
    while ($row = mysqli_fetch_array($result2)) 
    {
      $item_id = $row['i_id'];
      $item_name = $row['i_name'];
      $item_price = $row['i_price'];
      $item_category = $row['i_category']; 

      if ($menu_category == $item_category) 
      {
          
?>

  <div class="col-md-3">
    <div class="product-grid rounded-lg border border-info"> 
        <div class="product-content">
            <h2 class="title"><?php echo $item_name ?></h2>
            <div class="price">pkr <?php echo $item_price ?></div>
            <a class="add-to-cart" href="cart.php?add=<?php echo $item_id ?>">+ Add To Cart</a>
        </div>
    </div>
  </div>

<?php 
        }
      }
    }
  }
?>

</div>



<!-- <section class="food-area section-padding">
        <div class="container">
            
            <div class="row">

<div class="col-md-4 col-sm-6" style="padding: 10px">
    <div class="single-food mt-5 mt-sm-0 border border-warning">
        <div class="food-content">
            <div class="d-flex justify-content-between">
                <a href="#"><h5>Dish Name</h5></a>
                <span class="style-change">PKR 200</span>
            </div>
            <p class="pt-3">Dish Detail</p>
        </div>
    </div>
</div>
</div>
        </div>
    </section> -->


  <footer class="bg-light text-center text-lg-start" style="margin-top: 50px">
    <!-- Grid container -->
    <div class="container p-4">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
          <h5 class="text-uppercase">Giki E Delivery</h5>
  
          <p>
           Bringing you the stores at tuc area to your screens. Order anything from the variety of stores at our website and get it dilevered to your room in a matter of minutes.
          </p>
        </div>
        <!--Grid column-->
  
        <!--Grid column-->
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
          <h5 class="text-uppercase">New Updates</h5>
  
          <ul class="list-unstyled mb-0">
            <li>
              <p class="text-dark">Notice 1</p>
            </li>
            <li>
              <p class="text-dark">Notice 1</p>
            </li>
            <li>
              <p class="text-dark">Notice 1</p>
            </li>
          </ul>
        </div>
        <!--Grid column-->
  
        <!--Grid column-->
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    <!-- Grid container -->
  
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2020 Copyright :
      <a class="text-dark" href="index.html">GIKI E DELIVERY </a>
    </div>
    <!-- Copyright -->
  </footer>
      
<!-- Footer -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>