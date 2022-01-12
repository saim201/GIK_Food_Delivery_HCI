
<?php include "delete_modal.php" ?>



<form method="post" action=""  enctype="multipart/form-data" style="margin-top: 60px">
<table class="table  table-hover" > 

	<thead>
		<tr>	
			<th>ID</th>
			<th>Restaurant Name</th>
			<th>Picture</th>
			<th>Contact Number</th>
		</tr>
	</thead>
	<tbody>


<?php 

	$query = "SELECT * FROM restaurant";
    $result = mysqli_query($connect,$query);  

    while($row = mysqli_fetch_assoc($result)) 
    {
	    $r_id = $row['r_id'];
	    $res_title = $row['r_name'];
	    $res_pic = $row['r_pic'];
	    $res_number = $row['r_number'];

	    echo "<tr>";
	        
	    echo "<td>$r_id</td>";
	    echo "<td>$res_title</td>";
	    echo "<td><img width='100' src='../uploads/$res_pic' alt='image'></td>";
	    echo "<td>$res_number</td>";

		//echo "<td><a href='menu.php?source=edit_menu&p_id=$item_id'>Edit</a></td>";

		echo "<td>
				<a class='btn btn-info' href='restaurant.php?source=edit_restaurant&res_id=$r_id' >
            	<span class='glyphicon glyphicon glyphicon-edit'></span>
            	</a>
            	<a class='btn btn-danger' href='restaurant.php?delete=$r_id' >
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
		$query  = "DELETE FROM restaurant where r_id = $del_key ";
		$result = mysqli_query($connect,$query);
		header("Location:restaurant.php");
	}

?>

<script type="text/javascript">
    
    $(document).ready(function(){


        $(".delete_link").on('click', function(){


            var id = $(this).attr("rel");

            var delete_url = "restaurant.php?delete="+ id +" ";

 
            $(".modal_delete_link").attr("href", delete_url);


            $("#myModal").modal('show');

        });

    });

</script>


