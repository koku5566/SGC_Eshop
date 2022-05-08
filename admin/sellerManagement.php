<?php
    require __DIR__ . '/header.php'
?>

<?php	
	if($_SESSION['role'] != "ADMIN")
	{
		?><script>window.location = '<?php echo("$domain/index.php");?>'</script><?php
		exit;
    }
?>


<?php
  $sql = "SELECT * FROM user WHERE role = 'SELLER'";
  $seller_result = mysqli_query($conn, $sql);
?>

<!-- Update Data-->
<?php
//if(isset($_POST['edit']))
//{
//  $shopId = $_SESSION['userid'];
//  $_SESSION['DeleteUser'] = false;
//  $id = $_POST['delete'];
//  $sql = "DELETE FROM user WHERE shop_id = '$id'";
//  $delete_result = mysqli_query($conn, $sql);
//  
//  if($delete_result)
//  {
//    echo "$id'has been deleted'";
//  }else{
//    echo 'Data Not Deleted';
//  }
//  mysqli_close($conn);
//}
?>

<!-- Edit and Update Data-->
<?php
//if(isset($_POST['edit']))
//{
//   $sellerName = $_POST['name'];
//   $sellerEmail = $_POST['email'];
//   $sellerContact = $_POST['contact'];
//   $update = "UPDATE user SET name='$sellerName', email='$sellerEmail', contact='$sellerContact' WHERE user_id = '$sellerId'";
//     if (mysqli_query($conn, $update))
//     { 
//         /*Successful*/
//         ?><!--<script>window.location = '<?php //echo("$domain/admin/sellerManagament.php");?>'</script>--><?php
//     }
//     else
//     {
//       echo($update);
//         /*Fail*/
//         echo 'Update Fail';
//     }
//} 
?>

<?php
if(isset($_POST['editSeller']))
{
	$UID=$_POST['editSeller'];

	$name = $_POST['sellerName'];
	$email = $_POST['sellerEmail'];
	$contact = $_POST['sellerContact'];
	$profile = $_POST['sellerProfile'];

	$sql = "UPDATE user SET name='$name', email='$email', contact='$contact' WHERE user_id='$UID'";

	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('User Detail Edited');</script>";
	} else {
		echo "Error: " . mysqli_error($conn);
	}
}
?>

<!-- Delete Data-->
<?php
if(isset($_POST['delete']))
{
  $_SESSION['DeleteUser'] = false;
  $id = $_POST['delete'];
  $sql = "DELETE FROM user WHERE user_id = '$id'";
  $delete_result = mysqli_query($conn, $sql);
  
  if($delete_result)
  {
    echo 'Deleted';
  }else{
    echo 'Fail to delete';
  }
  mysqli_close($conn);
}
?>

<div class="container-fluid" style="width:100%;">
  <div class="container managementContainer">
    <div class="row">
      <h5>Search Seller ID or E-mail</h5>
    </div>

    <div class="row">
      <div class="input-group">
        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-outline-primary">search</button><br>
      </div>
    </div>
  
    <div class="row">
      <h2>Seller</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">User Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <?php
              while ($row = mysqli_fetch_assoc($seller_result))
              {
                $sellerProfilePic = $row['profile_picture'];
                $sellerID = $row['user_id'];
                $sellerName = $row['name'];
                $sellerEmail = $row['email'];
                $sellerContact = $row['contact'];
            ?>
            <tbody>
              <tr>
                <td id="sellerProfile" name="sellerProfile"><?php //echo $sellerProfilePic ?></td>
                <td id="sellerID" name="sellerID"><?php echo $sellerID ?></td>
                <td id="sellerName" name="sellerName"><?php echo $sellerName ?></td>
                <td id="sellerEmail" name="sellerEmail"><?php echo $sellerEmail ?></td>
                <td id="sellerContact" name="sellerContact"><?php echo $sellerContact ?></td>
                <td><button name="edit" class="delete" data-toggle='modal' data-target='#editModal'>EDIT<button><br><button name="delete" class="delete">DELETE</button></td>
              </tr>
            </tbody>
            <?php
              }
            ?>
          </table>
        </form>
    </div>

    <!-- Edit Modal -->
    	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    			<div class="modal-content" id="editProfile">
    				<div class="modal-header">
    					<h5 class="modal-title">Edit Staff Information</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    					</button>
    				</div>

            <div class="modal-body">
              <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="sellerName" class="form-control" id="sellerName" placeholder="" value="`+name+`" required>
              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" name="editSeller" value="`+username+`" class="btn btn-primary">Save Changes</button>
            </div>
    			</div>
    		</div>
    	</div>
  </div>
</div>

<?php
    require __DIR__ . '/footer.php'
?>

<style>
body{
    background-color: #EEEDEE;
}

.managementContainer{
  background-color: white;
  margin: 25px auto;
  padding: 30px;
}

.delete{
  border: none;
  background-color: white;
  color:grey;
}
</style>