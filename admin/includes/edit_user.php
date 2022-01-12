

<?php  

	if (isset($_GET['p_id'])) 
	{
		$update_key =  $_GET['p_id'];
	}

	$query = "SELECT * FROM users where u_id = $update_key";
    $result = mysqli_query($connect,$query);

    while ($row = mysqli_fetch_assoc($result)) 
    {
	    $username = $row['username'];
	    $user_name = $row['name'];
	    $role = $row['u_role'];
	    $res_name = $row['u_restaurant'];
	}

	if (isset($_POST['update_user'])) 
	{
		$update_name = $_POST['update_name'];
		$update_username = $_POST['update_username'];
		$update_role = $_POST['update_role'];
		$update_res_name = $_POST['update_res_name'];

		$update_query = "UPDATE users SET username='$update_username', name='$update_name',   u_role='$update_role', u_restaurant='$update_res_name' WHERE u_id = $update_key";

		mysqli_query($connect,$update_query);


		header('Location:users.php');
		// echo "User Updated : " . " " ;
		// echo "<a href='users.php'>View All Users</a>";


	}

?>


<form action="" method="POST" enctype="multipart/form-data">

	<div class="form-group">
		<label>Name</label>
		<input type="text" name="update_name" class="form-control" value="<?php echo $user_name ?>">
	</div>


	<div class="form-group">
		<select name="update_role">
			<option value="<?php echo $role ?>"><?php echo $role ?></option>

			<?php 
				if ($role == 'admin') 
				{
					echo "<option value='owner'>Owner</option>";
					echo "<option value='customer'>Customer</option>";
				}
				elseif ($role == 'customer')
				{
					echo "<option value='admin'>Admin</option>";
					echo "<option value='owner'>Owner</option>";
				}
				else
				{
					echo "<option value='admin'>Admin</option>";
					echo "<option value='customer'>Customer</option>";
				}
			?>
		</select>
	</div>

	<div class="form-group">
		<label>Restaurant Name</label>
		<input type="text" name="update_res_name" class="form-control" value="<?php echo $res_name ?>">
	</div>

	<div class="form-group">
		<label>Username</label>
		<input type="text" name="update_username" class="form-control" value="<?php echo $username ?>">
	</div>

	<div class="form-group">
		<input type="Submit" name="update_user" class="btn btn-primary" value="Update User">
	</div> 
	
</form>





