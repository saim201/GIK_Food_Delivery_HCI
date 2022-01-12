


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
                    

<form method="post" action="" style="margin-top: 60px">
<table class="table  table-hover" > 

    <thead>
        <tr>    
            <th>ID</th>
            <th>Restaurant Name</th>
            <th>Picture</th>
            <th>Contact Number</th>
        </tr>
    </thead>
    <tbody>



<?php 
    $res_name = $_SESSION['user_restaurant'];
    $query = "SELECT * FROM restaurant where r_name = '$res_name'";
    $result = mysqli_query($connect,$query);  

    while($row = mysqli_fetch_assoc($result)) 
    {
        $r_id = $row['r_id'];
        $res_title = $row['r_name'];
        $res_pic = $row['r_pic'];
        $res_number = $row['r_number'];

        echo "<tr>";
            
        echo "<td>$r_id</td>";
        echo "<td>$res_title</td>";
        echo "<td><img width='100' src='uploads/$res_pic' alt='image'></td>";
        echo "<td>$res_number</td>";
        echo "<td>
                <a class='btn btn-info' href='restaurant.php?source=edit_restaurant&res_id=$r_id' >
                <span class='glyphicon glyphicon glyphicon-edit'></span>
                </a>
              </td>";

        // echo "<td><a rel='$item_id' href='javascript:void(0)' class='delete_link'>Delete</a>
        //       </td>";

        // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to Delete') \" href='posts.php?delete=$post_id'>Delete</a></td>";
        echo "</tr>";                   
    }

?>

    </tbody>
</table>
</form>






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
