
<table class="table  table-hover">
	<thead>
		<tr>	                        		
			<th>ID</th>
			<th>Name</th>
			<th>Username</th>
			<th>Role</th>
			<th>Update Password</th>
		</tr>
	</thead>
	<tbody>


<?php 

	$query = "SELECT * FROM users order by u_id desc";
	$result = mysqli_query($connect,$query);
	$count = 0;
	while ($row = mysqli_fetch_assoc($result)) 
	{
		$user_id = $row['u_id'];
		$username = $row['username'];
		$user_password = $row['password'];
		$user_name = $row['name'];
		$role = $row['u_role'];
		$count++;

		echo "<tr>";
		echo "<td>$count</td>";
		echo "<td>$username</td>";
		echo "<td>$user_name</td>";
		echo "<td>$role</td>";

		// echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
		// echo "<td><a href='users.php?change_to_customer=$user_id'>Customer</a></td>";
		
		echo "<td><a href='users.php?source=edit_user_password&p_id=$user_id' style='color:black;'>Update</a></td>";
		echo "<td>
				<a class='btn btn-primary'href='users.php?source=edit_user&p_id=$user_id'>
            	<span class='glyphicon glyphicon-edit'></span>
            	</a>

            	<a class='btn btn-danger' href='users.php?delete=$user_id'>
            	<span class='glyphicon glyphicon-remove'></span>
            	</a>

            </td>";
		echo "</tr>";        			
	}

	

?>

	</tbody>
</table>


<?php
	// if (isset($_GET['change_to_admin'])) 
	// {
	// 	$change_to_admin_key = $_GET['change_to_admin'];
	// 	$query = "UPDATE users SET u_role = 'admin' where u_id = $change_to_admin_key";
	// 	mysqli_query($connect,$query);
	// 	header("Location:users.php");
	// }

	// if (isset($_GET['change_to_customer'])) 
	// {
	// 	$change_to_customer_key = $_GET['change_to_customer'];
	// 	$query = "UPDATE users SET u_role = 'customer' where u_id = $change_to_customer_key";
	// 	mysqli_query($connect,$query);
	// 	header("Location:users.php");
	// }


	if (isset($_GET['delete'])) 
	{
		if ($_SESSION['u_role']) 
		{
			if ($_SESSION['u_role'] == 'admin') 
			{
				$del_key = $_GET['delete'];
				$query  = "DELETE FROM users where u_id = $del_key ";
				$result = mysqli_query($connect,$query);
				header("Location:users.php");
			}
		}
		
	}

?>

