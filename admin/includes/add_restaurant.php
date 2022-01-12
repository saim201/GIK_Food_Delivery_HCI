

<?php 

	if (isset($_POST['add_restaurant'])) 
	{
		$r_name = escape($_POST['r_name']);
		$r_number = escape($_POST['r_number']);		

		$res_image        = $_FILES['image']['name'];
        $res_image_temp   = $_FILES['image']['tmp_name'];

        move_uploaded_file($res_image_temp, "../uploads/$res_image " );


		$query = "INSERT INTO restaurant(r_name, r_number, r_pic)  VALUES ('$r_name','$r_number','$res_image')";
		mysqli_query($connect,$query);

		echo "<span class='bg-success'>Restaurant Created. 
			 <a href='restaurant.php'>View All Restaurants</a>
			 </span>";
	}
?>



<form action="" method="POST" enctype="multipart/form-data">

	<div class="form-group">
		<label>Restaurant Name</label>
		<input type="text" name="r_name" class="form-control" required>
	</div>

	<div class="form-group">
         <label for="post_image">Restaurant Image</label>
          <input type="file"  name="image">
      </div>

	<div class="form-group">
		<label>Restaurant Contact Number</label>
		<input type="text" name="r_number" class="form-control" required>
	</div>

	<div class="form-group">
		<input type="Submit" name="add_restaurant" class="btn btn-primary" value="Add Restaurant">
	</div> 
	
</form>


