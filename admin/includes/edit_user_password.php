

<?php  

	if (isset($_GET['p_id'])) 
	{
		$update_key =  $_GET['p_id'];
	}

	$query = "SELECT * FROM users where u_id = $update_key";
    $result = mysqli_query($connect,$query);

    while ($row = mysqli_fetch_assoc($result)) 
    {
	    $user_password = $row['password'];
	}

	if (isset($_POST['update_pass'])) 
	{
		$update_password = $_POST['update_password'];
		$update_password_again = $_POST['update_password_again'];

		if ($update_password == $update_password_again) 
		{
	//$update_password = password_hash($update_password, PASSWORD_BCRYPT, array('cost' => 10));

			$update_query = "UPDATE users SET  password='$update_password' WHERE u_id = $update_key";

			mysqli_query($connect,$update_query);

			echo "<span class='bg-success'>Password Updated. 
			 		</span>";
		}
		else 
		{
			echo "<center><span class='text-danger'><b>Yor password is not same.Please try again </b>
			 </span></center>";
		}	
	}
?>


<form action="" method="POST" enctype="multipart/form-data">

	<div class="form-group">
		<label>New Password</label>
		<input type="password"  name="update_password" class="form-control" required>
	</div>

	<div class="form-group">
		<label>Retype New Password</label>
		<input type="password"  name="update_password_again" class="form-control" required>
	</div>

	<div class="form-group">
		<input type="Submit" name="update_pass" class="btn btn-primary" value="Update Password">
	</div> 
	
</form>





