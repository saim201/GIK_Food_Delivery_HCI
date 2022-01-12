

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
               All Payments

            </h1>
          </div>

<div class="row">
<table class="table table-hover ">
    <thead>
      <tr>
           <th>ID</th>
           <th>Order_ID</th>
           <th>UserName</th>
           <?php 
           if ($_SESSION['u_role'] == 'admin') 
           {
             echo "<th>Restaurant</th>";
           } 
           ?>
           <th>Transaction_ID</th>
           <th>Total Items</th>
           <th>Total Price (PKR)</th>
           <th>Date & Time</th>
           <th>Method</th>

      </tr>
    </thead>
    <tbody>

      <?php 
          $res_name = $_SESSION['user_restaurant'];
          if ($_SESSION['u_role'] == 'admin') 
          {
            $query = "SELECT * FROM payments order by id desc";
          }
          else
          {
            $query = "SELECT * FROM payments where restaurant_name = '$res_name' order by id desc";
          }
          
          $result = mysqli_query($connect,$query);
          $count = 0;
          while ($row = mysqli_fetch_assoc($result)) 
          {
            $payment_id = $row['id'];
            $order_id = $row['order_id'];
            $username = $row['username'];
            $restaurant_name = $row['restaurant_name'];
            $transaction_id = $row['transaction_id'];
            $total_price = $row['total_price'];
            $total_quantity = $row['quantity'];
            $payment_date = $row['date'];
            $payment_method = $row['payment_method'];
            $count++;


            echo "<tr>";
            echo "<td>$count</td>";
            echo "<td><a href='view_specific_order.php?id=$order_id'>$order_id</a></td>";
            echo "<td>$username</td>";
            if ($_SESSION['u_role'] == 'admin') 
            {
              echo "<td>$restaurant_name</td>";
            }
            echo "<td>$transaction_id</td>";
            echo "<td>$total_quantity</td>";
            echo "<td>$total_price</td>";
            echo "<td>$payment_date</td>";
            echo "<td>$payment_method</td>";
            echo "<td><a class='btn btn-danger' href='payments.php?delete=$payment_id'>
                    <span class='glyphicon glyphicon-remove'></span>
                    </a></td>";
            echo "<tr>";


          }

       ?>

<!-- <a href='view_specific_order.php?id=$order_id'><td></td></a>
 -->    </tbody>
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
        $query  = "DELETE FROM payments where id = $del_key ";
        $result = mysqli_query($connect,$query);
        header("Location:payments.php");
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
