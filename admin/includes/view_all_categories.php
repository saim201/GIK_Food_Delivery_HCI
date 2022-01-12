
<?php include "delete_modal.php" ?>

<br>

<?php 

	if (isset($_POST['add_category'])) 
	{	
		if ($_SESSION['u_role'] == 'admin') 
		{
			$res_name = escape($_POST['restaurant']);
		}
		else
		{
			$res_name = $_SESSION['user_restaurant'];
		}

		$cat_name = escape($_POST['cat_name']);

		$query1 = "SELECT * FROM categories where cat_name = '$cat_name'";
		$result = mysqli_query($connect,$query1);
		
		if (mysqli_num_rows($result) == 0) 
		{
			$query = "INSERT INTO categories(cat_name,restaurant_name)  
					VALUES ('$cat_name','$res_name')";
			mysqli_query($connect,$query);

			// $post_id = mysqli_insert_id($connect);

			echo "<center><span class='bg-success'>Category Created. 
			 </span></center>";
		}
		else
		{
			echo "<center><span class='text-danger'><b>You Entered a dulicate category.Please try again </b>
			 </span></center>";
		}
	}

?>


	<!-- Add new category form -->
<form action="" method="POST" enctype="multipart/form-data" class="col-md-3">
	<div class="form-group">
		<label>Category Name</label>
		<input type="text" name="cat_name" class="form-control" required>
	</div>

<?php  
	if ($_SESSION['u_role'] == 'admin') 
	{
?>
	<div class="form-group">
		<label>Restaurant</label><br>
		<select name="restaurant" required>
			<option value="">Select a restaurant</option>
			<?php 
				$query = "SELECT * FROM restaurant";
				$result = mysqli_query($connect,$query);

				while ($row = mysqli_fetch_assoc($result)) 
				{
					$restaurant_name = $row['r_name'];
					echo "<option value='$restaurant_name'>$restaurant_name</option>";
				}
			?>
		</select>
	</div>
<?php 		
	}
?>
	<div class="form-group">
		<input type="Submit" name="add_category" class="btn btn-primary" value="Add New Category">
	</div> 
	
</form>

<br><br><br>

	<!-- View all categories form -->
<form method="post" action="" style="margin-top: 140px">
	<table class="table  table-hover" > 
		<thead>
			<tr>	
				<th>ID</th>

				<?php 
				if ($_SESSION['u_role'] == 'admin') 
				{
					echo "<th>Restaurant</th>";
				}
				?>

				<th>Category</th>
			</tr>
		</thead>
		<tbody>

<?php 
	if ($_SESSION['u_role'] == 'admin') 
	{
		$query = "SELECT * FROM categories order by restaurant_name";
	}
	else
	{
		$res_name = $_SESSION['user_restaurant'];
		$query = "SELECT * FROM categories where restaurant_name = '$res_name' order by restaurant_name";
	}
	
    $select_categories = mysqli_query($connect,$query);
    $count = 0;  
    while($row = mysqli_fetch_assoc($select_categories)) 
    {
	    $cat_id = $row['cat_id'];
	    $restaurant_name = $row['restaurant_name'];
	    $cat_title = $row['cat_name'];
	    $count++;

	    echo "<tr>"; 
		echo "<td>$count</td>";

	    if ($_SESSION['u_role'] == 'admin') 
	    {
	    	echo "<td>$restaurant_name</td>";
	    }

	    echo "<td><a href='view_specific_items.php?id=$cat_id' style='color:black'>$cat_title</a></td>";
		echo "<td>
				<a class='btn btn-info' href='category.php?source=edit_category&cat_id=$cat_id' >
            	<span class='glyphicon glyphicon glyphicon-edit'></span>
            	</a>
            	<a class='btn btn-danger' href='category.php?delete=$cat_id' >
            	<span class='glyphicon glyphicon-remove'></span>
            	</a>
              </td>";

		// echo "<td><a rel='$item_id' href='javascript:void(0)' class='delete_link'>Delete</a>
		//       </td>";

		// echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to Delete') \" href='posts.php?delete=$post_id'>Delete</a></td>";
		echo "</tr>";        			
	}


?>

	</tbody>
</table><a href="" style='color: black'></a>
</form>


<?php 
	if (isset($_GET['delete'])) 
	{
		$del_key = $_GET['delete'];
		$query  = "DELETE FROM categories where cat_id = $del_key ";
		$result = mysqli_query($connect,$query);
		header("Location:category.php");
	}

?>

<script type="text/javascript">
    
    $(document).ready(function(){


        $(".delete_link").on('click', function(){


            var id = $(this).attr("rel");

            var delete_url = "categories.php?delete="+ id +" ";

 
            $(".modal_delete_link").attr("href", delete_url);


            $("#myModal").modal('show');

        });

    });

</script>


