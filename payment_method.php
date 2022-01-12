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

      <?php else: ?>
        <li><a class="nav-link" href="registration.php">Registration</a></li>
        <li><a class="nav-link" href="login.php">Login</a></li>
          
        
      <?php endif; ?>    
        </ul>
      </div>
    </nav>




<!----------------------  php code for online payment (start) --------------------------->
<?php 
date_default_timezone_set('Asia/Karachi');
//60 seconds = 1 minutes
ini_set('max_execution_time', 60);

$product_price = $_SESSION['final_price'];

//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
//1.
//get formatted price. remove period(.) from the price
$temp_amount  = $product_price*100;
$amount_array   = explode('.', $temp_amount);
$pp_Amount = $amount_array[0];

//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN


//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
//2.
//get the current date and time
$DateTime       = new DateTime();
$pp_TxnDateTime = $DateTime->format('YmdHis');
//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN


//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
//3.
//to make expiry date and time add one hour to current date and time
$ExpiryDateTime = $DateTime;
$ExpiryDateTime->modify('+' . 1 . ' hours');
$pp_TxnExpiryDateTime = $ExpiryDateTime->format('YmdHis');
//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN


//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
//4.
//make unique transaction id using current date
$pp_TxnRefNo = 'T'.$pp_TxnDateTime;
//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN


//--------------------------------------------------------------------------------
//$post_data
$post_data =  array(
    "pp_Version"            => JAZZCASH_API_VERSION_1,
    "pp_TxnType"            => "",
    "pp_Language"           => JAZZCASH_LANGUAGE,
    "pp_MerchantID"         => JAZZCASH_MERCHANT_ID,
    "pp_SubMerchantID"      => "",
    "pp_Password"           => JAZZCASH_PASSWORD,
    "pp_BankID"             => "TBANK",
    "pp_ProductID"          => "RETL",
    "pp_TxnRefNo"           => $pp_TxnRefNo,
    "pp_Amount"             => $pp_Amount,
    "pp_TxnCurrency"        => JAZZCASH_CURRENCY_CODE,
    "pp_TxnDateTime"        => $pp_TxnDateTime,
    "pp_BillReference"      => "billRef",
    "pp_Description"        => "Description of transaction",
    "pp_TxnExpiryDateTime"  => $pp_TxnExpiryDateTime,
    "pp_ReturnURL"          => JAZZCASH_RETURN_URL,
    "pp_SecureHash"         => "",
    "ppmpf_1"               => "1",
    "ppmpf_2"               => "2",
    "ppmpf_3"               => "3",
    "ppmpf_4"               => "4",
    "ppmpf_5"               => "5",
);
//--------------------------------------------------------------------------------


//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
//5.
//$sorted_string
//make an alphabetically ordered string using $post_data array above
//and skip the blank fields in $post_data array
$sorted_string  = JAZZCASH_INTEGERITY_SALT . '&';
$sorted_string .= $post_data['pp_Amount'] . '&';
$sorted_string .= $post_data['pp_BankID'] . '&';
$sorted_string .= $post_data['pp_BillReference'] . '&';
$sorted_string .= $post_data['pp_Description'] . '&';
$sorted_string .= $post_data['pp_Language'] . '&';
$sorted_string .= $post_data['pp_MerchantID'] . '&';
$sorted_string .= $post_data['pp_Password'] . '&';
$sorted_string .= $post_data['pp_ProductID'] . '&';
$sorted_string .= $post_data['pp_ReturnURL'] . '&';
$sorted_string .= $post_data['pp_TxnCurrency'] . '&';
$sorted_string .= $post_data['pp_TxnDateTime'] . '&';
$sorted_string .= $post_data['pp_TxnExpiryDateTime'] . '&';
$sorted_string .= $post_data['pp_TxnRefNo'] . '&';
//$sorted_string .= $post_data['pp_TxnType'] . '&';
$sorted_string .= $post_data['pp_Version'] . '&';
$sorted_string .= $post_data['ppmpf_1'] . '&';
$sorted_string .= $post_data['ppmpf_2'] . '&';
$sorted_string .= $post_data['ppmpf_3'] . '&';
$sorted_string .= $post_data['ppmpf_4'] . '&';
$sorted_string .= $post_data['ppmpf_5'];

//sha256 hash encoding
$pp_SecureHash = hash_hmac('sha256', $sorted_string, JAZZCASH_INTEGERITY_SALT);
//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

$post_data['pp_SecureHash'] =  $pp_SecureHash;


//insert $post_data array into database for validating secure hash
?>


<!----------------------  php code for online payment (end) --------------------------->

<br><br><br>
<h2 style="text-align: center"> Please Select Your Payment method</h2>


<center>
<div class="row container " style="margin-top: 130px">
  <div class="col-md-6 " style="">
    <h4 style="color: black">Cart Totals</h4>
   
      <table class="table  table-bordered">
          <tr class="cart-subtotal">
          <th><b>Items</b></th>
          <td>
            <span>
              <?php echo isset($_SESSION['total_items']) ? $_SESSION['total_items'] : $_SESSION['total_items'] = "0"; ?>
            </span>
          </td>
          </tr>

          <tr>
          <th><b>Order Total</b></th>
          <td>
            <strong>PKR 
            <?php 
            
              echo isset($_SESSION['final_price']) ? $_SESSION['final_price'] : $_SESSION['final_price'] = "0"; 
            ?>
            </strong> 
          </td>
          </tr>
      </table>
  </div>
  <div class="col-md-6">
    <form action="<?php echo JAZZCASH_HTTP_POST_URL;?>" method="POST" enctype="multipart/form-data">
          
<!-- -------------------- hidden data for jazzcash (start) ----------------------------- -->
      <input type="hidden" name="amount" value="<?php echo $product_price;?>"> 
      <input type="hidden" name="pp_Version" value="<?php echo $post_data['pp_Version'];?>">
      <input type="hidden" name="pp_TxnType" value="<?php echo $post_data['pp_TxnType'];?>">
      <input type="hidden" name="pp_Language" value="<?php echo $post_data['pp_Language'];?>">
      <input type="hidden" name="pp_MerchantID" value="<?php echo $post_data['pp_MerchantID'];?>">
      <input type="hidden" name="pp_SubMerchantID" value="<?php echo $post_data['pp_SubMerchantID'];?>">
      <input type="hidden" name="pp_Password" value="<?php echo $post_data['pp_Password'];?>">
      <input type="hidden" name="pp_BankID" value="<?php echo $post_data['pp_BankID'];?>">
      <input type="hidden" name="pp_ProductID" value="<?php echo $post_data['pp_ProductID'];?>">
      <input type="hidden" name="pp_TxnRefNo" value="<?php echo $post_data['pp_TxnRefNo'];?>">
      <input type="hidden" name="pp_Amount" value="<?php echo $post_data['pp_Amount'];?>">
      <input type="hidden" name="pp_TxnCurrency" value="<?php echo $post_data['pp_TxnCurrency'];?>">
      <input type="hidden" name="pp_TxnDateTime" value="<?php echo $post_data['pp_TxnDateTime'];?>">
      <input type="hidden" name="pp_BillReference" value="<?php echo $post_data['pp_BillReference'];?>">
      <input type="hidden" name="pp_Description" value="<?php echo $post_data['pp_Description'];?>">
      <input type="hidden" name="pp_TxnExpiryDateTime" value="<?php echo $post_data['pp_TxnExpiryDateTime'];?>">
      <input type="hidden" name="pp_ReturnURL" value="<?php echo $post_data['pp_ReturnURL'];?>">
      <input type="hidden" name="pp_SecureHash" value="<?php echo $post_data['pp_SecureHash'];?>">
      <input type="hidden" name="ppmpf_1" value="<?php echo $post_data['ppmpf_1'];?>">
      <input type="hidden" name="ppmpf_2" value="<?php echo $post_data['ppmpf_2'];?>">
      <input type="hidden" name="ppmpf_3" value="<?php echo $post_data['ppmpf_3'];?>">
      <input type="hidden" name="ppmpf_4" value="<?php echo $post_data['ppmpf_4'];?>">
      <input type="hidden" name="ppmpf_5" value="<?php echo $post_data['ppmpf_5'];?>">
    <!-- -------------------- hidden data for jazzcash (end) ----------------------------- -->


      <div class="form-group">
        <input type="Submit" name="payment" class="btn btn-outline-warning" style="color: black" value="Online"> 
      </div> 
    </form>

    <a href="order_placed(cod).php" class="btn btn-outline-warning" style="color: black">Cash On Delivery</a>
  </div>
</div>
</center>



<br><br><br><br><br><br><br><br><br>





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