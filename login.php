<?php 

include "includes/connection.php";
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
    <!--Jumbotron-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand col-md-10" href="index.php">Giki E-Delivery</a>
        
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto" >

            <li >
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li >
              <a class="nav-link" href="registration.php">Registration</a>
            </li>
            <li class="active">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            

          </ul>
        </div>
      </nav>
      


      <!-- Login Query -->
<?php 

if (isset($_POST['submit'])) 
{
  $name = $_POST['username'];
  $pass = $_POST['password'];

  $query = "SELECT * FROM users where username = '$name' AND password = '$pass'";
  $result = mysqli_query($connect,$query);
  if (mysqli_num_rows($result) == 0) 
  {
    echo "<script type='text/javascript'>
                    alert('INCORRECT Username or Password ');
                </script>";
  }
  
  while ($row = mysqli_fetch_array($result)) 
  {
    $user_id = $row['u_id'];
    $db_username = $row['username'];
    $db_name = $row['name'];
    $db_user_pass = $row['password'];
    $db_user_role = $row['u_role'];
    $db_user_restaurant = $row['u_restaurant'];


    $_SESSION['username'] = $db_username;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['name'] = $db_name;
    $_SESSION['u_role'] = $db_user_role;
    $_SESSION['user_restaurant'] = $db_user_restaurant;
    $_SESSION['session_counter'] = 0;

    if ($_SESSION['u_role'] !== 'customer') 
    {
      header("Location:admin/index.php");
    }
    else
    {
      header("Location:index.php");
    }  
    
  }
    
}


?>




    <!-- Login Form -->
<br><br><br><br><br><br>
    <div class="container col-md-4" >

        <h2 style="color: black" class="text-center">Login</h2><br>

        <form class="" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
             <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
<br>
            <div class="form-group">
              <input type="submit" name="submit" class="btn btn-outline-primary" value="Login">
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