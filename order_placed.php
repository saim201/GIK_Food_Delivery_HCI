

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
      
<!----------------------  php code for online payment (start) --------------------------->
<?php
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


// If transaction data is available in the URL 
if(!empty($_POST['pp_Amount']) && !empty($_POST['pp_AuthCode']) && !empty($_POST['pp_ResponseCode']) && !empty($_POST['pp_MerchantID']) && 
  !empty($_POST['pp_SecureHash']) && !empty($_POST['pp_TxnRefNo']) && !empty($_POST['pp_RetreivalReferenceNo']))
{
  //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
    //Get transaction information from URL 
  $Transaction_id   = $_POST['pp_TxnRefNo'];
  $Amount       = $_POST['pp_Amount']; 
  $AuthCode       = $_POST['pp_AuthCode']; 
  $ResponseCode     = $_POST['pp_ResponseCode'];
  $ResponseMessage  = $_POST['pp_ResponseMessage'];
  $MerchantID     = $_POST['pp_MerchantID'];
  $SecureHash     = $_POST['pp_SecureHash'];
  $RetreivalReferenceNo = $_POST['pp_RetreivalReferenceNo'];

  //add period(.) before the last two digits of $Amount
  $Amount = substr($Amount, 0, -2) . '.00';
  //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
  
  //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
  //Insert tansaction data into the database
  if($ResponseCode == '000')
    {$payment_status = 1;}
  else
    {$payment_status = 0;}
  
  $sql = "INSERT INTO payments(order_id,restaurant_name,username,transaction_id,total_price,quantity,status,payment_method) 
    VALUES('$order_id','$res_name','$user_name','$Transaction_id','$Amount','$total_items','$payment_status','Online')";
    mysqli_query($connect,$sql);
    
  //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
}
else
{
  $ResponseCode = 'error';
  $ResponseMessage = 'Some Serious error occurs please check transaction logs for more detail';
}
?>

<div class="container">
    <div class="status">
        <?php 
          if($ResponseCode == '000')
          { 
        ?>
    <!-- Payment successful -->
    <br><br><br>
            <h1 class="success">Your Payment has been Successful</h1>
            <h4>Payment Information</h4>
            <p><b>Transaction ID:</b> <?php echo $Transaction_id; ?></p>
            <p><b>Paid Amount:</b> <?php echo $Amount; ?></p>
            <p><b>Payment Status:</b><span style="color: #007BFF "> Success</span> </p>
    <!-- --------------------------------------------------------------------------- -->
      
      
    <!-- --------------------------------------------------------------------------- -->
        <!-- Payment not successful -->
        <?php 
          }
          else
          { 
        ?>
            <br><br><br><br><br>
            <h1 class="error">Your Payment has Failed</h1>
            <p><b>Message: </b><?php echo $ResponseMessage;?></p>
        <?php
          } 
        ?>
    <!-- --------------------------------------------------------------------------- -->
    
    
    </div>
</div>
<!----------------------  php code for online payment (end) --------------------------->
     

<div class="container text-center" style="margin-top: 130px">
    <!-- <h3>Thank You for <span>Ordering ...</span> </h3> -->
    <br>
    <a href="logout.php" class="btn btn-outline-warning" style="color:black">Order More</a>

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