

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


<?php 
  if (isset($_POST['order_more'])) 
  {
    echo $_SESSION['final_price'] . " ";
    $_SESSION['final_price'] = '0';
    $_SESSION['total_items'] = '0';
    //unset($_SESSION['final_price']);
    //unset($_SESSION['total_items']);
    header("Location:index.php");
    echo $_SESSION['final_price'];
  }

  $query2 = "SELECT * FROM orders";
  $result2 = mysqli_query($connect,$query2);
  while ($row = mysqli_fetch_assoc($result2)) 
  {
    $total_items = $row['o_items'];
    $user_name = $row['username'];
    $res_name = $row['restaurant_name'];
    $order_id = $row['o_id'];
    $order_price = $row['o_price'];
  }


  $sql = "INSERT INTO payments(order_id,restaurant_name,username,total_price,quantity,status,payment_method,transaction_id) 
    VALUES('$order_id','$res_name','$user_name','$order_price','$total_items','1','COD','NULL')";
    mysqli_query($connect,$sql) 
    


?>




      
<br><br><br><br><br><br><br>
<h2 style="text-align: center">Your order is placed <span style="color: #007BFF">Successfully</span></h2>
     

<div class="container text-center" style="margin-top: 100px">
    <!-- <h3>Thank You for <span>Ordering ...</span> </h3> -->
    <br>
    <form action="" method="post">
      <input type="submit" class="btn btn-outline-warning" style="color:black" name="order_more" value="Order More">
    </form>

</div>

      
<br><br><br><br><br><br><br><br><br><br>





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