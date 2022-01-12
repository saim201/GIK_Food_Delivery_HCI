

<?php  

	if (isset($_GET['item_id'])) 
	{
		$update_key =  $_GET['item_id'];

		$query = "SELECT * FROM items where i_id = $update_key";
	    $result = mysqli_query($connect,$query);

	    while ($row = mysqli_fetch_assoc($result)) 
	    {
		    $item_name = $row['i_name'];
		    $item_category = $row['i_category'];
		    $item_price = $row['i_price'];
		}

		if (isset($_POST['update_item'])) 
		{
			$update_name = $_POST['update_i_name'];
			$update_category = $_POST['update_i_category'];
			$update_price = $_POST['update_i_price'];

			if ($_SESSION['u_role'] == 'admin') 
			{
				$updated_restaurant = $_POST['updated_restaurant'];
				$update_query = "UPDATE items SET i_name='$update_name', i_category='$update_category', i_price='$update_price', restaurant_name='$updated_restaurant' WHERE i_id = $update_key";
			}
			else
			{
				$update_query = "UPDATE items SET i_name='$update_name', i_category='$update_category', i_price='$update_price' WHERE i_id = $update_key";
			}
			

			mysqli_query($connect,$update_query);

			//echo "<p class='bg-success'>Item Updated.</p>";
			header("Location:items.php");
		}

	}

?>


<form action="" method="POST" enctype="multipart/form-data">

	<div class="form-group">
		<label>Item Name</label>
		<input type="text" name="update_i_name" class="form-control" value="<?php echo $item_name ?>">
	</div>


	<div class="form-group">
		<label>Category</label><br>
		<select name="update_i_category" required>
			<option value="">Select a Category</option>
			<?php 
				if ($_SESSION['u_role'] == 'admin') 
				{
				 	$query = "SELECT * FROM categories ";
				}
				else
				{
					$res_name = $_SESSION['user_restaurant'];
					$query = "SELECT * FROM categories where restaurant_name = '$res_name'";
				} 
				$result = mysqli_query($connect,$query);
				while ($row = mysqli_fetch_assoc($result)) 
				{
					$cat_id = $row['cat_id'];
					$category_name = $row['cat_name'];
					echo "<option value='$category_name'>$category_name</option>";
				}
			?>
		</select>
	</div>

<?php  
	if ($_SESSION['u_role'] == 'admin') 
	{
?>
	<div class="form-group">
		<label>Restaurant</label><br>
		<select name="updated_restaurant" required>
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
		<label>Item Price</label>
		<input type="text" name="update_i_price" class="form-control" value="<?php echo $item_price ?>">
	</div>


	<div class="form-group">
		<input type="Submit" name="update_item" class="btn btn-primary" value="Update Item">
	</div> 
	
</form>





