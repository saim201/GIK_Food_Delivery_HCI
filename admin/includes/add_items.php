

<?php 

	if (isset($_POST['add_item'])) 
	{
		if ($_SESSION['u_role'] == 'admin') 
		{
			$res_name = escape($_POST['restaurant']);
		}
		else
		{
			$res_name = $_SESSION['user_restaurant'];
		}
		$item_name = escape($_POST['item_name']);
		$item_category = escape($_POST['category']);
		$item_price = escape($_POST['item_price']);


		$query = "INSERT INTO items(i_name, i_category, i_price, restaurant_name)  
				VALUES ('$item_name','$item_category','$item_price','$res_name')";
		mysqli_query($connect,$query);

		// $post_id = mysqli_insert_id($connect);

		echo "<span class='bg-success'>Item Created. 
			 <a href='items.php'>View All Items</a>
			 </span>";
	}
?>


<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Item Name</label>
		<input type="text" name="item_name" class="form-control" required>
	</div>

	<div class="form-group">
		<label>Category</label><br>
		<select name="category" required>
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
		<label>Item Price (PKR)</label>
		<input type="text" name="item_price" class="form-control" required>
	</div>

	<div class="form-group">
		<input type="Submit" name="add_item" class="btn btn-primary" value="Add Item">
	</div> 
	
</form>


