<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false || $_SESSION['role'] != "ADMIN")
	{
		?><script>alert('Login as Admin account to access');
		window.location = '<?php echo("$domain/adminLogin.php");?>'</script><?php
		exit;
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

<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">User Management</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row">
			<div class="d-sm-flex mr-auto p-2">
				<h6 class="m-0 font-weight-bold text-primary">User Table</h6>
			</div>
			<div class="pt-2">
				<a href="../adminAddUser.php" class="btn btn-primary">Add User</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
				<tr>
					<th class="text-center">User ID</th>
					<th class="text-center">Username</th>
					<th class="text-center">E-Mail</th>
					<th class="text-center">Name</th>
					<th class="text-center">Contact</th>
					<th class="text-center">Registration Date</th>
					<th class="text-center">Role</th>
					<th class="text-center">Action</th>
				</tr>
				</thead>
				<tbody>
				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
					<?php
						$sql = "SELECT * FROM user";
						$res_data = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($res_data)){
							echo("
								<tr>
									<td class='text-center text-lg text-medium'>".$row["userID"]."</td>
									<td class='text-center text-lg text-medium'>".$row["username"]."</td>
									<td class='text-center text-lg text-medium'>".$row["email"]."</td>
									<td class='text-center text-lg text-medium'>".$row["name"]."</td>
									<td class='text-center text-lg text-medium'>".$row["contact"]."</td>
									<td class='text-center text-lg text-medium'>".$row["registration_date"]."</td>
									<td class='text-center text-lg text-medium'>".$row["role"]."</td>
									<td class='text-center text-lg text-medium' style='display:flex;'><button name=\"edit\" value=".$row["username"]." class=\"btn btn-primary\" style=\"margin-right: 0.5rem;\">Edit</button>
									<button name=\"remove\" value=".$row["username"]." class=\"btn btn-primary\">Remove</button></td>
								</tr>
							");
						}
					?>
				</form>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>

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

<?php require __DIR__ . '/footer.php' ?>

<script>
    $(document).ready(function() {
        $('#dataTable').dataTable({
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
        });
    });
</script>