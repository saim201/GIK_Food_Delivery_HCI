

<?php  

	if (isset($_GET['res_id'])) 
	{
		$update_key =  $_GET['res_id'];

		$query = "SELECT * FROM restaurant where r_id = $update_key";
	    $result = mysqli_query($connect,$query);

	    while ($row = mysqli_fetch_assoc($result)) 
	    {
		    $r_id = $row['r_id'];
			$r_name = $row['r_name'];
			$r_number = $row['r_number'];
			$r_image = $row['r_pic'];


		}

		if (isset($_POST['update_restaurant'])) 
		{
			$update_r_name = escape($_POST['update_r_name']);
			$update_number = escape($_POST['update_number']);

			$update_image = escape($_FILES['update_image']['name']);
			$update_image_temp = escape($_FILES['update_image']['tmp_name']);

			move_uploaded_file($update_image_temp, "uploads/$update_image");

			$update_query = "UPDATE restaurant SET r_name='$update_r_name', r_number='$update_number', r_pic='$update_image' WHERE r_id = $update_key";

			mysqli_query($connect,$update_query);

			if ($_SESSION['u_role'] == 'owner') 
			{
				header("Location:restaurant_profile.php");
			}
			else
			{
				header('Location:restaurant.php');
			 	//echo "<center><p class='bg-success'>Details Updated. </p></center>";
			}
			
		}

	}

?>


<form action="" method="POST" enctype="multipart/form-data">

	<div class="form-group">
		<label>Restaurant Name</label>
		<input type="text" name="update_r_name" class="form-control" value="<?php echo $r_name ?>">
	</div>

	<div class="form-group">
		<label>Restaurant Image</label><br>
		<input type="file" name="update_image">
		<img width='100' src='../images/<?php echo  $r_image?>'>
	</div>

	<div class="form-group">
		<label>Restaurant Contact Number</label>
		<input type="text" name="update_number" class="form-control" value="<?php echo $r_number ?>">
	</div>

	<div class="form-group">
		<input type="Submit" name="update_restaurant" class="btn btn-primary" value="Update Details">
	</div> 
	
</form>





