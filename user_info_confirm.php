

<?php 

include "includes/connection.php";
include "includes/functions.php";
include_once 'includes/config.php';
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
    <title>Giki E-Delivery</title>
  </head>
  <body>

    <!--Navigation Bar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand col-md-10" href="index.php">Giki E-Delivery</a>
    
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto" >
        <li><a class="nav-link" href="index.php">Home</a></li>

      <?php if(isLoggedIn()): ?>
        <li><a class="nav-link" href="logout.php">Logout</a></li>
        <li><a class="nav-link" href="cart.php">Cart</a></li>

      <?php else: ?>
        <li><a class="nav-link" href="registration.php">Registration</a></li>
        <li><a class="nav-link" href="login.php">Login</a></li>
          
        
      <?php endif; ?>    
        </ul>
      </div>
    </nav>



  

<?php  

    $update_key =  $_SESSION['user_id'];

    $query = "SELECT * FROM users where u_id = $update_key";
    $result = mysqli_query($connect,$query);

    while ($row = mysqli_fetch_assoc($result)) 
    {
        $u_name = $row['name'];
        $user_name = $row['username'];
    }

    if (isset($_POST['order_placed'])) 
    {
        $full_name = $_POST['full_name'];
        $mobile_number = $_POST['mobile_number'];
        $hostel = $_POST['hostel'];

        $total_items = $_SESSION['total_items'];
        $total_price = $_SESSION['final_price'];
        $res_name = $_SESSION['restaurant_name'];

        $query = "INSERT INTO orders (o_items,restaurant_name,o_price,username,user_fullname,contact_number,hostel) VALUES ('$total_items','$res_name','$total_price','$user_name','$full_name','$mobile_number','$hostel')";
        mysqli_query($connect,$query);

        header('Location:payment_method.php');
    }
?>



<div class="container col-md-6" style="margin-top: 103px">
    <h3 class="text-center" style="color: black">Confirm your Details</h3>
    <br>
            
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label>Name</label>
        <input required type="text" name="full_name" class="form-control" value="<?php echo $u_name ?>">
    </div>

    <div class="form-group">
        <label>Mobile Number</label>
        <input required type="text" name="mobile_number" class="form-control" >
    </div>

    <div class="form-group">
        <label>Hostel</label>
        <input required type="text" name="hostel" class="form-control">
    </div>

<br>
    <div class="form-group">
        <input type="Submit" name="order_placed" class="btn btn-outline-primary float-right" value="Proceed">
    </div> 
    
</form>

        
    
</div>


<br><br><br><br><br><br>

      


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