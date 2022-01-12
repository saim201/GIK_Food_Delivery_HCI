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
        <li class="active"><a class="nav-link" href="profile.php">Profile</a></li>
        <li><a class="nav-link" href="cart.php">Cart</a></li>
        <li><a class="nav-link" href="logout.php">Logout</a></li>

      <?php else: ?>
        <li><a class="nav-link" href="registration.php">Registration</a></li>
        <li><a class="nav-link" href="login.php">Login</a></li>
          
        
      <?php endif; ?>    
        </ul>
      </div>
    </nav>


<!-------------------- Update profile QUERY ------------------------->
<?php   
    if (isset($_POST['update_profile'])) 
    {
      $id = $_SESSION['user_id'];
      $update_name = $_POST['update_name'];
      $update_username = $_POST['update_username'];

      if ($update_username == $_SESSION['username']) 
      {
        $update_query = "UPDATE users SET name='$update_name' WHERE u_id = $id";
        mysqli_query($connect,$update_query);
        $query2 = "SELECT * FROM users where u_id = $id";
        $result2 = mysqli_query($connect,$query2);
        while ($row2 = mysqli_fetch_array($result2)) 
        {
          $_SESSION['name'] = $row2['name']; 
        }
        header('Location:profile.php');
      }
      else
      {
        $query1 = "SELECT * FROM users where username = '$update_username'";
        $result1 = mysqli_query($connect,$query1);
        if (mysqli_num_rows($result1) == 0) 
        {
          $update_query = "UPDATE users SET username='$update_username', name='$update_name' WHERE u_id = $id";
          mysqli_query($connect,$update_query);
          $query2 = "SELECT * FROM users where u_id = $id";
          $result2 = mysqli_query($connect,$query2);
          while ($row2 = mysqli_fetch_array($result2)) 
          {
            $_SESSION['name'] = $row2['name'];
            $_SESSION['username'] = $row2['username']; 
          }
          header('Location:profile.php');
        }
        else
        {
          echo "<script> alert('Username already exist. Please choose a unique one') </script>";
        }
      }  
    } 
?>


<!---------------------------- profile Form --------------------------------->
    
    <div class="container col-md-4" style="margin-top: 106px">
      <h4 style="color: black" class="text-center">Profile</h4><br>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="update_name" class="form-control" required value="<?php echo $_SESSION['name'] ?>">
        </div>

        <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="update_username" class="form-control" required value="<?php echo $_SESSION['username'] ?>">
        </div>

        <div class="form-group">
          <input type="submit" name="update_profile" class="btn btn-outline-primary float-right" value="Save" required>
        </div>
      </form>

<br><br><br><br>
<hr>
<br><br><br>

<!-------------------- Update Password QUERY ------------------------->
<?php 
  $update_key =  $_SESSION['user_id'];

  if (isset($_POST['update_password'])) 
  {
    $update_password = $_POST['update_pass'];
    $update_password_again = $_POST['update_pass2'];

    if ($update_password == $update_password_again) 
    {
      $update_query = "UPDATE users SET  password='$update_password' WHERE u_id = $update_key";
      mysqli_query($connect,$update_query);
      echo "<span class='text-success' style='text-align: center;'>Password Updated. 
          </span>";
    }
    else 
    {
      echo "<script> alert('New Password does not match. Please try again') </script>";
    } 
  }
?>


<!----------------------- Password change form ------------------------->
      <h4 style="color: black" class="text-center">Password</h4><br>     
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">New Password</label>
            <input type="text" name="update_pass" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="">Retype New Password</label>
            <input type="text" name="update_pass2" class="form-control" required>
        </div>

        <div class="form-group">
          <input type="submit" name="update_password" class="btn btn-outline-primary float-right" value="Save" required>
        </div>
      </form>

<br><br><br><br>
<hr>
<br><br><br>
  </div>


<!---------------------------- Show All orders --------------------------------->
<center>
  <h4 style="color: black" class="">Order History</h4><br>
  <div class="row container">

    <table class="table table-hover">
        <thead>
          <tr> 
            <th>Restaurant</th> 
            <th>Hostel</th>
            <th>Mobile Number</th>
            <th>Total Items</th>
            <th>Total Price (PKR)</th>
            <th>Transaction Method</th>
            <th>Date & time</th>
          </tr>
        </thead>
        <tbody>

<?php 
    $username = $_SESSION['username'];
    $query = "SELECT * from orders,payments where o_id = order_id AND orders.username = '$username' order by payments.date desc";
    $result = mysqli_query($connect,$query);

    while ($row = mysqli_fetch_assoc($result)) 
    {
      $contact_number = $row['contact_number'];
      $hostel = $row['hostel'];
      $order_items = $row['o_items'];
      $order_price = $row['o_price'];
      $res_name = $row['restaurant_name'];
      $payment_method = $row['payment_method'];
      $date = $row['date'];

      echo "<tr>";
      echo "<td>$res_name</td>";
      echo "<td>$hostel</td>";
      echo "<td>$contact_number</td>";
      echo "<td>$order_items</td>";
      echo "<td>$order_price</td>";
      echo "<td>$payment_method</td>";
      echo "<td>$date</td>";
      echo "<tr>";
    }

 ?>

        </tbody>
    </table>
  </div>
</center>



<br><br><br><br><br><br><br><br><br><br><br><br><br>  


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