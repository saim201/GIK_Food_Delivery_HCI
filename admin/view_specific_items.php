
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



<form method="post" action="" style="margin-top: 50px">
<table class="table  table-hover"> 
        
	<div>
		<a style="margin-left: 0px" class="btn btn-primary" href="items.php?source=add_items">Add New Item</a>
	</div>
<br><br>
	<thead >
		<tr>	
			<th>ID</th>
			<th>Name</th>
			<th>Price PKR</th>
			<th>Category</th>
		</tr>
	</thead>
	
	<tbody>

		<?php 
			if (isset($_GET['id'])) 
			{
				$cat_id = $_GET['id'];
				$query1 = "SELECT * FROM categories where cat_id = '$cat_id'";
				$result1 = mysqli_query($connect,$query1);
				if ($row = mysqli_fetch_assoc($result1)) 
				{
					$cat_name = $row['cat_name'];
				}

				$query = "SELECT * FROM items where i_category = '$cat_name' order by i_category";
				$result = mysqli_query($connect,$query);

				while ($row = mysqli_fetch_assoc($result)) 
				{
					$item_id = $row['i_id'];
					$item_name = $row['i_name'];
					$item_price = $row['i_price'];
					$item_category = $row['i_category'];
					

					echo "<tr>";
					echo "<td>$item_id</td>";
					echo "<td>$item_name</td>";
					echo "<td>$item_price</td>";

					//echo "<td><a href='menu.php?source=edit_menu&p_id=$item_id'>Edit</a></td>";

					echo "<td>
							<a class='btn btn-info' href='items.php?source=edit_items&item_id=$item_id' >
	                    	<span class='glyphicon glyphicon glyphicon-edit'></span>
	                    	</a>
	                    	<a class='btn btn-danger' href='items.php?delete=$item_id' >
	                    	<span class='glyphicon glyphicon-remove'></span>
	                    	</a>
	                      </td>";

					// echo "<td><a rel='$item_id' href='javascript:void(0)' class='delete_link'>Delete</a>
					//       </td>";

					// echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to Delete') \" href='posts.php?delete=$post_id'>Delete</a></td>";
					echo "</tr>";        			
				}
			}
			

		?>

	</tbody>
</table>
</form>


<?php 
	if (isset($_GET['delete'])) 
	{
		$del_key = $_GET['delete'];
		$query  = "DELETE FROM items where i_id = $del_key ";
		$result = mysqli_query($connect,$query);
		header("Location:items.php");
	}

?>


<?php include "includes/footer.php" ?>

