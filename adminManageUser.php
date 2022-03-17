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
		<th>Username</th>
		<th>E-Mail</th>
		<th>Password</th>
		<th>Contact</th>
		<th>Registration Date</th>
		<th>Role</th>
		<th>Action</th>
	</tr>
<?php
	$sql = "SELECT * FROM user";
	$res_data = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($res_data)){
		echo("
			<tr>
				<td>".$row["user_id"]."</td>
				<td>".$row["username"]."</td>
				<td>".$row["email"]."</td>
				<td>".$row["password"]."</td>
				<td>".$row["name"]."</td>
				<td>".$row["contact"]."</td>
				<td>".$row["registration_date"]."</td>
				<td>".$row["role"].("</td>
				<td><button name=\"edit\" value=".$row["username"].">Edit</button> <button name=\"remove\" value=".$row["username"].">Remove</button></td>
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