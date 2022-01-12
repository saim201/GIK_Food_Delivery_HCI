

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
                        
<?php

if(isset($_GET['source']))
{

$sourc = $_GET['source'];

}
else 
{

$sourc = '';

}

switch($sourc) 
{
    
    case 'add_user':
    	include "includes/add_user.php";
    	break; 
    
    
    case 'edit_user':
	    include "includes/edit_user.php";
	    break;
    
    case 'edit_user_password':
        include "includes/edit_user_password.php";
        break;
    
    default:
	    include "includes/view_all_users.php";
	    break;
	    
   
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
