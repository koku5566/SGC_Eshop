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
  $sellerId = $_SESSION['userid'];
  $sql = "SELECT * FROM user WHERE user_id = '$sellerId'";
  $seller_result = mysqli_query($conn, $sql);
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
      <?php
        while ($row = mysqli_fetch_assoc($seller_result))
        {
          $sellerProfilePic = $row['profile_picture'];
          $sellerID = $row['user_id'];
          $sellerName = $row['name'];
          $sellerEmail = $row['email'];
          $sellerContact = $row['contact'];
      ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td><?php echo $sellerProfilePic ?></td>
                <td><?php echo $sellerID ?></td>
                <td><?php echo $sellerName ?></td>
                <td><?php echo $sellerEmail ?></td>
                <td><?php echo $sellerContact ?></td>
                <td>EDIT<br>DELETE</td>
              </tr>
              <!--<tr>
                <th scope="row">2</th>
                <td>natasha</td>
                <td>natasha@gmail.com</td>
                <td>01123456789</td>
                <td>Tokyo</td>
                <td>EDIT<br>DELETE</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>natasha</td>
                <td>natasha@gmail.com</td>
                <td>01123456789</td>
                <td>Georgetown</td>
                <td>EDIT<br>DELETE</td>
              </tr>-->
            </tbody>
          </table>
        </form>
        <?php
          }
        ?>
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
</style>