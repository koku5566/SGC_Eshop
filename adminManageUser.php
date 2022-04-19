<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false || $_SESSION['role'] != "ADMIN")
	{
		?><script>window.location = '<?php echo("$domain/index.php");?>'</script><?php
		exit;
    }
?>

<?php
	if(isset($_POST['deleteStaff']))
	{
		$_SESSION['DeleteUser'] = false;
		$UID = $_POST['deleteStaff'];

		$sql = "DELETE FROM user WHERE username = '$UID'";

		if (mysqli_query($conn, $sql)) {
			$_SESSION['DeleteUser'] = true;
            echo "<script>alert('User Removed');</script>";
		} else {
			echo "Error: " . mysqli_error($db);
		}
	}

	if(isset($_POST['editStaff']))
	{
        $UID=$_POST['editStaff'];

        $name = $_POST['inpEditName'];
		$email = $_POST['inpEditEmail'];
        $contact = $_POST['inpEditContact'];
        $role = $_POST['inpEditRole'];

		$sql = "UPDATE user SET name='$name', email='$email', contact='$contact', role='$role' WHERE username='$UID'";

		if (mysqli_query($conn, $sql)) {
			$_SESSION['DeleteUser'] = true;
            echo "<script>alert('User Edited');</script>";
		} else {
			echo "Error: " . mysqli_error($db);
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
					<th class="text-center">Edit</th>
					<th class="text-center">Remove</th>
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
									<td class='text-center text-lg text-medium'><button type='button' class='edit btn btn-primary' data-toggle='modal' data-target='#editUserModal' value=".$row["username"]."><i class='fa fa-edit' aria-hidden='true'></i></button></td>
									<td class='text-center text-lg text-medium'><button type='button' class='remove btn btn-primary' data-toggle='modal' data-target='#deleteUserModal' value=".$row["username"]."><i class='fa fa-trash' aria-hidden='true'></i></button></td>
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

<!-- Edit User Modal -->
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content" id="editProfile">
				<div class="modal-header">
					<h5 class="modal-title" >Edit Staff Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!--
					<div class="imageDiv">
						<div class="image-container">
							<img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
							<div class="image-layer">
							</div>
							<div class="image-tools-delete hide">
								<i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
							</div>
							<div class="image-tools-add">
								<label class="custom-file-upload">
									<input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp">
									<i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
								</label>
							</div>
						</div>
					</div>
					--->

					<div class="form-group">
						<label for="inpEditName">Name</label>
						<input type="text" name="inpEditName" class="form-control" id="inpEditName" placeholder="" required>
					</div>
					<div class="form-group">
						<label for="inpEditEmail">Email</label>
						<input type="email" name="inpEditEmail" class="form-control" id="inpEditEmail" placeholder="" required>
					</div>
					<div class="form-group">
						<label for="inpEditContact">Contact No.</label>
						<input type="text" name="inpEditContact" class="form-control" id="inpEditContact" placeholder="" required>
					</div>
					<div class="form-group">
						<label for="inpEditRole">Role</label>
						<input type="text" name="inpEditRole" class="form-control" id="inpEditRole" placeholder="" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="editStaff" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- Delete User Modal -->
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" >Warning</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Confirm Delete User?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" id="deleteStaff" name="deleteStaff" class="btn btn-primary" value="<?php echo $row["username"]?>">Yes</button>
			</div>
			</div>
		</div>
	</div>    
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

<?php require __DIR__ . '/footer.php' ?>

<script>
$(document).ready(function() {
	$('#dataTable').dataTable({
	"lengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
	});
});


const removeButton = document.querySelectorAll('.remove');
removeButton.forEach(btn => {
	btn.addEventListener('click', function handleClick(event) {
		removeButton.forEach(btn => {
			document.getElementById('deleteStaff').value=btn.value
		});
	});
});

const editButton = document.querySelectorAll('.edit');
editButton.forEach(btn => {
	btn.addEventListener('click', function handleClick(event) {
		editUser(btn.value);
	});
});

function editUser(user_id) 
{
	$.ajax({
		url:"editUserProfile.php",
		method:"POST",
		data:{
			user_id:user_id,
			editUser:1
		},
		dataType: 'JSON',
		success: function(response){
			var len = response.length;
			for(var i=0; i<len; i++){
				var name = response[i].name;
				var contact = response[i].contact;
				var email = response[i].email;
				var role = response[i].role;

				var priceHTML = `

				`;
				
				$("#editProfile").empty();
				$("#editProfile").append(priceHTML);
			}
			if(!!document.getElementById("VariationErrorMsg"))
			{
				document.getElementById("VariationErrorMsg").remove();
			}
		},
		error: function(err) {
			//$('#login_message').html(err.responseText);
			alert(err.responseText);
		}
	});
}
</script>