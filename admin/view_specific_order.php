

<?php include "functions.php" ?>
<?php include "includes/header.php" ?>



    <div id="wrapper">

        <!-- Navigation -->
        
        <?php include "includes/nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to ADMIN
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        



        <div class="col-md-12">
            <div class="row">
            <h1 class="page-header">
               All Orders

            </h1>
          </div>

<div class="row">
<table class="table table-hover ">
    <thead>
      <tr>
           <th>ID</th>
           <th>Name</th>
           <th>UserName</th>
           <th>Number</th>
           <th>Hostel</th>
           <th>Total Items</th>
           <th>Total Price (PKR)</th>

      </tr>
    </thead>
    <tbody>

      <?php 
          $order_id = $_GET['id'];
          $query = "SELECT * FROM orders where o_id = '$order_id'";
          $result = mysqli_query($connect,$query);

          while ($row = mysqli_fetch_assoc($result)) 
          {
            $order_id = $row['o_id'];
            $order_username = $row['username'];
            $user_fullname = $row['user_fullname'];
            $contact_number = $row['contact_number'];
            $hostel = $row['hostel'];
            $order_items = $row['o_items'];
            $order_price = $row['o_price'];


            echo "<tr>";
            echo "<td>$order_id</td>";
            echo "<td>$user_fullname</td>";
            echo "<td>$order_username</td>";
            echo "<td>$contact_number</td>";
            echo "<td>$hostel</td>";
            echo "<td>$order_items</td>";
            echo "<td>$order_price</td>";
            echo "<td><a class='btn btn-danger' href='orders.php?delete=$order_id'>
                    <span class='glyphicon glyphicon-remove'></span>
                    </a></td>";
            echo "<tr>";


          }

       ?>


    </tbody>
</table>
</div>



<?php  

  if (isset($_GET['delete'])) 
  {
    if ($_SESSION['u_role']) 
    {
      if ($_SESSION['u_role'] !== 'customer') 
      {
        $del_key = $_GET['delete'];
        $query  = "DELETE FROM orders where o_id = $del_key ";
        $result = mysqli_query($connect,$query);
        header("Location:orders.php");
      }
    }
    
  }



?>

                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    
    <?php include "includes/footer.php" ?>
