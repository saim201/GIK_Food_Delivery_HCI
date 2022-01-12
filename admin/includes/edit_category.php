

<?php  

  if (isset($_GET['cat_id'])) 
  {
    $update_key =  $_GET['cat_id'];

    $query = "SELECT * FROM categories where cat_id = $update_key";
    $result = mysqli_query($connect,$query);

    while ($row = mysqli_fetch_assoc($result)) 
    {
      $cat_name = $row['cat_name'];
    }

    if (isset($_POST['update_category'])) 
    {
      $update_name = $_POST['update_name'];

      $update_query = "UPDATE categories SET cat_name='$update_name' WHERE cat_id = $update_key";

      mysqli_query($connect,$update_query);

      header("Location:category.php");
    }

  }

?>


<form action="" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label>Category Name</label>
    <input type="text" name="update_name" class="form-control" value="<?php echo $cat_name ?>">
  </div>

  <div class="form-group">
    <input type="Submit" name="update_category" class="btn btn-primary" value="Update Category">
  </div> 
  
</form>





