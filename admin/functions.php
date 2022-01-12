
<?php 



// function ifItIsMethod($method=null)
// {
//     if($_SERVER['REQUEST_METHOD'] == strtoupper($method))
//     {
//         return true;
//     }
// 	else
//     {
//     	return false;
//     }
// }



function isLoggedIn()
{
    if(isset($_SESSION['u_role']))
    {
        return true;
    }
    else
    {
    	return false;
    }
}



function checkIfUserIsLoggedInAndRedirect($redirectLocation=null)
{
    if(isLoggedIn())
    {
    	//redirect($redirectLocation);
    	header("Location:$redirectLocation");
    }
}



function check_user_exist($username)
{
	global $connect;
	$query = "SELECT * FROM users where u_username = '$username'" ;
	$result = mysqli_query($connect,$query);
	if (mysqli_num_rows($result) > 0) 
	{
		return true;
	}
	else
	{
		return false;
	}
}


function check_email_exist($email)
{
	global $connect;
	$query = "SELECT * FROM users where u_email = '$email'" ;
	$result = mysqli_query($connect,$query);
	if (mysqli_num_rows($result) > 0) 
	{
		return true;
	}
	else
	{
		return false;
	}
}




function count_specific($table_name,$column,$condition)
{
	global $connect;
	$query = "SELECT * FROM $table_name where $column = '$condition'";
	$result = mysqli_query($connect,$query);
	return mysqli_num_rows($result);
}


function countall($table_name)
{
	global $connect;
	$post_query = "SELECT * FROM $table_name";
	$result = mysqli_query($connect,$post_query);
	return mysqli_num_rows($result);
}


function escape($string) 
{

	global $connect;
	return mysqli_real_escape_string($connect, trim($string));
}



function findAllCategories() {
global $connect;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connect,$query);  

    while($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat'];
    $category_name = $row['cat_name'];

    echo "<tr>";
        
    echo "<td>$cat_id</td>";
    echo "<td>$category_name</td>";
   	echo "<td><a href='category.php?delete=$cat_id'>Delete</a></td>";
   	echo "<td><a href='category.php?edit=$cat_id'>Edit</a></td>";
    echo "</tr>";

    }


}


function deleteCategories()
{
global $connect;

    if(isset($_GET['delete'])){
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($connect,$query);
    header("Location: category.php");


    }
            


}




?>