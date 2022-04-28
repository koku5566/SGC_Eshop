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
  $sql = "SELECT * FROM user";
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

<?php
//if(isset($_POST['edit']))
//{
//   $sellerId = $_SESSION['user_id'];
//   $sellerName = $_POST['name'];
//   $sellerEmail = $_POST['email'];
//   $sellerContact = $_POST['contact'];
//   $update = "UPDATE user SET name='$sellerName', email='$sellerEmail', contact='$sellerContact' WHERE user_id = '$sellerId'";
//     if (mysqli_query($conn, $update))
//     { 
//         /*Successful*/
//         //header("Refresh:0");
//         //echo 'Success, please refesh again if not show the updated profile details.';
//         //header("Location:/shopProfile.php");
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

<!-- Delete Data-->
<?php
//if(isset($_POST['delete']))
//{
//  $shopId = $_SESSION['userid'];
//  $_SESSION['DeleteUser'] = false;
//  $id = $_POST['delete'];
//  $sql = "DELETE FROM user WHERE username = '$id'";
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
                <th scope="row">1</th>
                <td><?php //echo $sellerProfilePic ?></td>
                <td><?php echo $sellerID ?></td>
                <td><?php echo $sellerName ?></td>
                <td><?php echo $sellerEmail ?></td>
                <td><?php echo $sellerContact ?></td>
                <td><button name="edit" class="delete">EDIT<button><br><button name="delete" class="delete">DELETE</button></td>
              </tr>
            </tbody>
            <?php
              }
            ?>
          </table>
        </form>
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