
<?php include "delete_modal.php" ?>


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
			<th>Categories</th>

			<?php  
				if ($_SESSION['u_role'] == 'admin') 
				{
					echo "<th>Restaurants</th>";
				}
			?>
		</tr>
	</thead>
	
	<tbody>
		<?php 
			if ($_SESSION['u_role'] == 'admin') 
			{
				$query = "SELECT * FROM items order by i_category";
			}
			else
			{
				$res_name = $_SESSION['user_restaurant'];
				$query = "SELECT * FROM items where restaurant_name = '$res_name' order by i_category";
			}	
			
			$result = mysqli_query($connect,$query);
			$count = 0;
			while ($row = mysqli_fetch_assoc($result)) 
			{
				$item_id = $row['i_id'];
				$item_name = $row['i_name'];
				$item_price = $row['i_price'];
				$item_category = $row['i_category'];
				$res_name = $row['restaurant_name'];
				$count++;
				
				echo "<tr>";
				echo "<td>$count</td>";
				echo "<td>$item_name</td>";
				echo "<td>$item_price</td>";
				echo "<td>$item_category</td>";
				if ($_SESSION['u_role'] == 'admin') 
				{
					echo "<td>$res_name</td>";
				}

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

<script type="text/javascript">
    
    $(document).ready(function(){


        $(".delete_link").on('click', function(){


            var id = $(this).attr("rel");

            var delete_url = "items.php?delete="+ id +" ";

 
            $(".modal_delete_link").attr("href", delete_url);


            $("#myModal").modal('show');

        });

    });

</script>


