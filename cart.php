<?php 
  include "includes/connection.php";
  include "includes/functions.php";
  session_start();
  ob_start();
  error_reporting(0);
  ini_set('display_errors', 0);

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
        <li class="active"><a class="nav-link" href="cart.php">Cart</a></li>

      <?php else: ?>
        <li><a class="nav-link" href="registration.php">Registration</a></li>
        <li><a class="nav-link" href="login.php">Login</a></li>
          
        
      <?php endif; ?>    
        </ul>
      </div>
    </nav>


<br><br><br><br>

<div class="container">
<?php 
  



  if (isset($_POST['payment'])) 
  {
    $_SESSION['payment_method'] = $_POST['payment_method'];
    header("Location:user_info_confirm.php");
  }

?>

    <form>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Item</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Sub-total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

<?php

if ($_SESSION['username']) 
{
  // if ($_SESSION['restaurant_id'] <> $_SESSION['restaurant_id1']) 
  // {
  //   header("Location:index.php");
  // }
  // else
  // {

  // }
  if (isset($_GET['add'])) 
  {
    global $connect;
     $get_add_id = $_GET['add'];

    $query = "SELECT * from items where i_id = $get_add_id";
    $result = mysqli_query($connect,$query);

    while ($row = mysqli_fetch_array($result)) 
    {
      $dish_name = $row['i_name'];

      $_SESSION['product_' . $get_add_id ] += 1 ;

    } 

  }



if(isset($_GET['remove'])) 
{
    $_SESSION['product_' . $_GET['remove']]-- ;

    if($_SESSION['product_' . $_GET['remove']] < 1) 
    {
      unset($_SESSION['final_price']);
      unset($_SESSION['total_items']);
    } 
}



if (isset($_GET['delete'])) 
{
    $_SESSION['product_' . $_GET['delete']] = '0' ;

    unset($_SESSION['final_price']);
    unset($_SESSION['total_items']);
      
}


  $total_price = 0;
  $total_items = 0;

  global $connect;

  foreach ($_SESSION as $name => $value) 
  {
    if ($value > 0) 
    {
 
      if (substr($name, 0, 8) == "product_") 
      {
        $length = strlen($name) - 8;

        $id = substr($name, 8, $length);

        $query = "SELECT * FROM items where i_id = '$id'";
        $result = mysqli_query($connect,$query);
        while ($row = mysqli_fetch_array($result)) 
        {
            $dish_id = $row['i_id'];
            $dish_name = $row['i_name'];
            $dish_price = $row['i_price'];

            $sub_total = $dish_price * $value;

            $_SESSION['total_items'] = $total_items += $value;
            $_SESSION['final_price'] = $total_price += $sub_total;

$product = <<<DELIMETER

    <tr>
        <td> $dish_name </td>
        <td> PKR $dish_price </td>
        <td> $value </td>
        <td> PKR $sub_total </td>

        <td>
          <a class="btn btn-warning" href="cart.php?remove=$dish_id">
            <span class="glyphicon glyphicon-minus" style="color:white"><b>-</b></span>
          </a>
          <a class="btn btn-success" href="cart.php?add=$dish_id">
            <span class="glyphicon glyphicon-plus" style="color:white;"><b>+</b></span>
          </a>
          <a class="btn btn-danger" href="cart.php?delete=$dish_id">
            <span class="glyphicon glyphicon-remove" style="color:white"><b>x</b></span>
          </a>
        </td>
      
    </tr>

DELIMETER;
echo $product;

        }
      }
    }
   }
}
else
{
    echo "<script type='text/javascript'>
                alert('Please first logged in yourself ');
            </script>";
     header('Location:login.php');       
}


?>

          </tbody>
        </table>
    </form>
</div>

<br><br>


<?php 
    if ($total_price != 0) 
    {

?>
<div class="row container">
  <div class="col-md-6">
    <a href="menu.php?id=<?php echo $_SESSION['restaurant_id'] ?>" class="btn btn-outline-warning float-right" style="color: black">Back to Menu</a>
  </div>
  <div class="col-md-6">
    <a href="user_info_confirm.php" class="btn btn-outline-warning float-right" style="color: black">Checkout</a>
  </div>
</div>


<?php 
    }
    else
    {
      $_SESSION['session_counter'] = 0;
    }
?>



<br><br><br><br>

<div class="container">

    <div class="row">

        <div class="col-md-4 ">
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
    </div>
</div>

<br>



    <footer class="bg-light text-center text-lg-start" style="margin-top: 50px">
      

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2021 Copyright :
        <a class="text-dark" href="index.html">GIKI E DELIVERY </a>
      </div>
      <!-- Copyright -->
    </footer>
      
  </body>

