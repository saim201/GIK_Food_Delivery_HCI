<?php 
	if (isset($_POST['create_user'])) 
	{
		$name= $_POST['name'];
		$username = $_POST['username'];
		$role = $_POST['role'];
		$password = $_POST['password'];
		$res_name = $_POST['res_name'];

		//$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
		$query = "INSERT INTO users(username,password, name, u_role, u_restaurant)  
					VALUES ('$username','$password','$name','$role','$res_name')";

		mysqli_query($connect,$query);

		header("Location:users.php");
	}
?>


<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control" required>
	</div>

	<div class="form-group">
		<select name="role" required>
			<option value="">Select Options</option>
			<option value="admin">Admin</option>
			<option value="owner">Owner</option>
			<option value="customer">Customer</option>
		</select>
	</div>

	<div class="form-group">
		<label>Restaurant Name</label>
		<input type="text" name="res_name" class="form-control" placeholder="Necessary if you are an owner ...">
	</div>

	<div class="form-group">
		<label>Username</label>
		<input type="text" name="username" class="form-control" required>
	</div>

	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" class="form-control" required>
	</div>

	<div class="form-group">
		<input type="Submit" name="create_user" class="btn btn-primary" value="Add User">
	</div> 
</form>