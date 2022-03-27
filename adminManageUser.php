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

		$sql = "DELETE FROM user WHERE username = '$UID'";

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

<div id="DataDiv">
<h1>User</h1>
<a href="adminAddUser.php"><button>Add User</button></a>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
	<table class="table">
	<tr>
		<th class="text-center">User ID</th>
		<th class="text-center">Username</th>
		<th class="text-center">E-Mail</th>
		<th class="text-center">Password</th>
		<th class="text-center">Name</th>
		<th class="text-center">Contact</th>
		<th class="text-center">Registration Date</th>
		<th class="text-center">Role</th>
		<th class="text-center"	>Action</th>
	</tr>
<?php
	$sql = "SELECT * FROM user";
	$res_data = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($res_data)){
		echo("
			<tr>
				<td class='text-center text-lg text-medium'>".$row["user_id"]."</td>
				<td class='text-center text-lg text-medium'>".$row["username"]."</td>
				<td class='text-center text-lg text-medium'>".$row["email"]."</td>
				<td class='text-center text-lg text-medium'>".$row["password"]."</td>
				<td class='text-center text-lg text-medium'>".$row["name"]."</td>
				<td class='text-center text-lg text-medium'>".$row["contact"]."</td>
				<td class='text-center text-lg text-medium'>".$row["registration_date"]."</td>
				<td class='text-center text-lg text-medium'>".$row["role"]."</td>
				<td class='text-center text-lg text-medium'><button name=\"edit\" value=".$row["username"]." class=\"btn btn-primary btn-block\">Edit</button>
				<button name=\"remove\" value=".$row["username"]." class=\"btn btn-primary btn-block\">Remove</button></td>
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

<?php require __DIR__ . '/footer.php' ?>