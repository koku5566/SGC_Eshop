<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false || $_SESSION['role'] != "ADMIN")
	{
		echo "<script>alert('Login as Admin account to access');
			window.location.href='login.php';</script>";
    }
?>
<?php
	if(isset($_POST['remove']))
	{
		$_SESSION['DeleteUser'] = false;
		$UID = $_POST['remove'];

		$sql = "DELETE FROM user WHERE username = $UID";

		if (mysqli_query($conn, $sql)) {
			$_SESSION['DeleteUser'] = true;
		} else {
			echo "Error: " . mysqli_error($conn);
		}
	}
	
	if(isset($_POST['edit']))
	{
		$_SESSION['ToEdit'] = $_POST['edit'];
		echo("<script>window.location.href='adminEditUser.php';</script>");
	}
?>

<div id="title"><h2>ADMIN PANEL</h2></div>
<div id="AdminPanel">
<div id = "Panel">
	<a class="nav" href="ADMIN-Product.php">Product</a>
	<a class="nav active" href="ADMIN-User.php">User</a>
	<a class="nav" href="ADMIN-Statistic.php">Statistic</a>
</div>

<div id="DataDiv">
<a href="ADMIN-AddUser.php" style="float:left; padding-bottom:10px;"><button>Add User</button></a>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
	<table>
	<tr>
		<th>User ID</th>
		<th>Name</th>
		<th>E-Mail</th>
		<th>Password</th>
		<th>Contact</th>
		<th>Address</th>
		<th>Registration Date</th>
		<th>ADMIN</th>
		<th>Action</th>
	</tr>
<?php
	$sql = "SELECT * FROM user";
	$res_data = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($res_data)){
		echo("
			<tr>
				<td>".$row["userID"]."</td>
				<td>".$row["name"]."</td>
				<td>".$row["email"]."</td>
				<td>".$row["password"]."</td>
				<td>".$row["contact"]."</td>
				<td><div id=\"addr\">".$row["address"]."</div></td>
				<td>".$row["regDate"]."</td>
				<td>");if($row['ADMIN']==0){echo("No");}else{echo("Yes");}echo("</td>
				<td><button name=\"edit\" value=".$row["userID"].">Edit</button> <button name=\"remove\" value=".$row["userID"].">Remove</button></td>
			</tr>
			");
	}
?>
	</table>
</form>
<?php
if(isset($_SESSION['DeleteUser']))
	{
		if($_SESSION['DeleteUser'] == true)
		{
			echo "<script>alert('User Removed');</script>";
		}
		$_SESSION['DeleteUser'] = NULL;
	}
?>
</div>
</div>

<?php require __DIR__ . '/footer.php' ?>