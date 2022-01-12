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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Giki E-Delivery</title>
  </head>
  <body>

    <!--Navigation Bar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand col-md-10" href="index.php">Giki E-Delivery</a>
    
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto" >
        <li class="active"><a class="nav-link" href="index.php">Home</a></li>

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


    <!-- Banner Area Starts -->
    <section class="banner-area text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6>The first E-Delivery System in GIK</h6>
                    <h1>Order from any <span class="prime-color">Restaurant</span><br>  
                    <span class="style-change"> with <span class="prime-color"> Us </span></span></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->



<br><br><br><br>



    <!-- Food Area starts -->
  <section class="food-area section-padding">
      <div class="container">
        <div class="row">

<?php 

    $query = "SELECT * from restaurant";
    $result = mysqli_query($connect,$query);

    while ($row = mysqli_fetch_array($result)) 
    {
        $res_name = $row['r_name'];
        $res_id = $row['r_id'];
        $img =$row['r_pic'];
?>    

<div class="col-md-4 col-sm-6" style="margin-top: 70px">
    <div class="single-food">
        <div class="food-img">
            <a href="menu.php?id=<?php echo $res_id ?>">
                <img src='uploads/<?php echo $img ?>' class="img-fluid img-responsive" alt="">
            </a>
        </div>
        <div class="food-content">
            <div class="d-flex justify-content-between">

              <a href="menu.php?id=<?php echo $res_id ?>"><h5><?php echo $res_name ?></h5></a>
            </div>
        </div>
    </div>
</div>


<?php  
    }
?>

        </div>
    </div>
</section>
    <!-- Food Area End -->



      <!-- Footer -->
<footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2021 Copyright :
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