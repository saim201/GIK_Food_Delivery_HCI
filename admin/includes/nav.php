

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Admin Panel</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">

    	<li><a href="../index.php">Home</a></li>
        
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                <?php echo $_SESSION['username'] ?>
              
                <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="users.php?source=edit_user_password&p_id=<?php echo $_SESSION['user_id'] ?>"><i class="fa fa-pencil-square-o"></i> Change Pass</a>
                </li>
                <li>
                    <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>

            <li>
                <a href="payments.php"><i class="fa fa-credit-card"></i> Payments</a>
            </li>

            <li>
                <a href="orders.php"><i class="fa fa-shopping-cart"></i> Orders</a>
            </li>

            <li>
                <a href="items.php"><i class="fa fa-bars"></i> Items</a>
            </li>

            <li>
                <a href="category.php"><i class="fa fa-bars"></i> Categories</a>
            </li>


<?php  
    if ($_SESSION['u_role'] == 'admin') 
    {
?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-cutlery"></i> Restaurants <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="restaurant.php">View All Restaurants</a>
                    </li>
                    <li>
                        <a href="restaurant.php?source=add_restaurant">Add Restaurant</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="users.php">View All Users</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Add User</a>
                    </li>
                </ul>
            </li>

<?php       
    }
    elseif ($_SESSION['u_role'] == 'owner') 
    {
        echo "<li>
                <a href='restaurant_profile.php'><i class='fa fa-cutlery'></i> Profile</a>
              </li>";
    }

?>


                    
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>