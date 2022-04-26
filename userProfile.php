<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false || $_SESSION['role'] == "SELLER")
	{
		?><script>window.location = '<?php echo("$domain/E404.php");?>'</script><?php
		exit;
    }
?>

<?php
if(isset($_POST['update']))
{
	$_SESSION['Update'] = false;

	$UID = $_SESSION['id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$contact = $_POST['contact'];

	if($_FILES['proPic']['tmp_name'] != "")
	{
		$proPic = addslashes(file_get_contents($_FILES['proPic']['tmp_name']));
	}

	$sql_u = "SELECT * FROM user WHERE username = '$UID'";

	$stmt_u = mysqli_query($conn, $sql_u);

	if (mysqli_num_rows($stmt_u) > 0) {	
	
		if($_FILES['proPic']['tmp_name'] != "" || $_POST['password'] != ""){
			$sql = "UPDATE user SET profile_picture='$proPic', name='$name', email='$email', password='$password', contact='$contact' WHERE username='$UID'";
		}
		else{
			$sql = "UPDATE user SET name='$name', email='$email', contact='$contact' WHERE username='$UID'";
		}
		
		if (mysqli_query($conn, $sql)) {
			$_SESSION['Update'] = true;
			?><script>alert('Details Updated');
			window.location = '<?php echo("$domain/userProfile.php");?>'</script><?php
		} else {
			echo "<script>alert('Email Address Already Exists');</script>";
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	else
	{
		echo("<script>alert('Error');</script>");
	}
}

if(isset($_POST['editPassword']))
{
	$UID=$_POST['editPassword'];

	$password = md5($_POST['inpPass']);
	$password1 = md5($_POST['inpPass1']);

	if($password==$password1){
		$sql = "UPDATE user SET password='$password' WHERE username='$UID'";

		if (mysqli_query($conn, $sql)) {
			?><script>alert('Password Updated, Please Re-Login');
			window.location = '<?php echo("$domain/logout.php");?>'</script><?php
		} else {
			echo "Error: " . mysqli_error($conn);
		}
	}
	else
	{
		echo("<script>alert('Password NOT Match');</script>");
	}
}
?>

<div class="row">
<?php require __DIR__ . '/userprofilenav.php' ?>
<div class="bg-gradient col-xl-9" style="margin-top: -1.5rem !important;">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-6 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-left">
                                        <div class="h1 text-gray-900 mb-4">My Profile</div>
                                    </div>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
	<?php
		$UID = $_SESSION["id"];
		$sql = "SELECT * FROM user WHERE username = '$UID'";

		$res_data = mysqli_query($conn,$sql);
		if (mysqli_num_rows($res_data) > 0){
			while($row = mysqli_fetch_array($res_data)){
				echo("
				<div class=\"form-group\">
					<div class=\"image-container\">				
						<div class=\"image-layer\">
						<img class=\"card-img-top img-thumbnail\" src=\"data:image;base64,".base64_encode($row["profile_picture"])."\" alt=\"Image.jpg\">
						</div>

						<div class=\image-tools-delete\">
							<i class=\"fa fa-trash image-tools-delete-icon\" aria-hidden=\"true\"></i>
						</div>
						<div class=\"image-tools-add\">
							<label class=\"custom-file-upload\">
								<input type=\"file\" accept=\".png,.jpg,.jpeg\" name=\"proPic\" id=\"profilePic\" value=\"data:image;base64,".base64_encode($row["profile_picture"])."\" hidden/>
								<i class=\"fa fa-edit\" aria-hidden=\"true\"></i> Change
							</label>
						</div>
					</div>
				</div>
					
					<div class=\"form-group\">
					<label>Username: </label>
					<label>".$row["username"]."</label>
					</div>

					<div class=\"form-group\">
					<label>Name</label>
					<input required type=\"text\" name=\"name\" maxlength=\"50\" value=\"".$row["name"]."\" class=\"form-control\"/>
					</div>
					
					<div class=\"form-group\">
					<label>Email Address</label>
					<input required type=\"email\" name=\"email\" maxlength=\"50\" placeholder=\"Enter Your Email Address\" value=\"".$row["email"]."\" class=\"form-control\"/>
					</div>

					<div class=\"form-group\">
					<label>Password</label>
					<input type=\"password\" name=\"password\" pattern=\"(?=.*\d).{8,}\" maxlength=\"50\" title=\"Use 8 or more characters with a mix of letters and numbers\" class=\"form-control\"/>
					<button type='button' class='edit btn btn-primary' data-toggle='modal' data-target='#editPassModal' value=".$row["username"]."><i class='fa fa-edit' aria-hidden='true'></i></button>
					</div>

					<div class=\"form-group\">
					<label>Contact</label>
					<input required type=\"tel\" name=\"contact\" pattern=\"[0-9]{2,3,4}-[0-9]{7,}\" maxlength=\"13\" placeholder=\"0000-00000000\" value=\"".$row["contact"]."\" class=\"form-control\"/>
					</div>
					
					<button type=\"submit\" class=\"btn btn-primary btn-block\" name=\"update\">Update</button>
					");
			}
		}
	?>
</form>
	                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Edit User Modal -->
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="modal fade" id="editPassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content" id="editPass">
				<div class="modal-header">
					<h5 class="modal-title">Edit Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<?php require __DIR__ . '/footer.php' ?>

<style>
    .img-thumbnail{
		width: 100%;
		height: 100%;
		object-fit: contain;
		border-radius: 10px;
        border: 1px solid darkgrey;
    }
	.image-container{
		text-align: center;
		width: fit-content;
		background-color: white;
	}
</style>

<script>
var img = document.getElementById('profilePic');

img.addEventListener('change', function handleChange(event) {
	const [file] = img.files;
	var maxsize = 2000000;
	var extArr = ["png","jpg","jpeg"];
	var imageValid = true;
	for (var a = 0; a < this.files.length; a++)
	{
		var ext = img.files[a].name.split('.').pop();
		if(img.files[a].size >= maxsize || !extArr.includes(ext))
		{
			imageValid = false;
		}
	}
	if (!imageValid){
		alert('Image File Size Cannot More Than 2 MB');
		img.value=null;
	}
});

const deleteImg = document.querySelectorAll('.image-tools-delete-icon');

deleteImg.forEach(img => {
	img.addEventListener('click', function handleClick(event) {
		img.parentElement.previousElementSibling.previousElementSibling.src="";
		img.parentElement.nextElementSibling.classList.remove("hide");
		img.parentElement.nextElementSibling.firstElementChild.firstElementChild.value=null;
		img.parentElement.nextElementSibling.firstElementChild.firstElementChild.nextElementSibling.value=null;
	});
});




const editButton = document.querySelectorAll('.edit');
editButton.forEach(btn => {
	btn.addEventListener('click', function handleClick(event) {
		editUser(btn.value);
	});
});

function editUser(username) 
{
	$.ajax({
		url:"editPassword.php",
		method:"POST",
		data:{
			username:username,
			editUser:1
		},
		dataType: 'JSON',
		success: function(response){
			var len = response.length;
			for(var i=0; i<len; i++){
				var password = response[i].password;
				var password1 = response[i].password1;

				var priceHTML = `
						<div class="modal-header">
                            <h5 class="modal-title" >Change Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inpPass">Password</label>
                                <input required type="password" name="inpPass" class="form-control" id="inpPass" value="`+password+`" pattern=\"(?=.*\d).{8,}\" placeholder=\"Use 8 or more characters with a mix of letters and numbers\" title=\"Use 8 or more characters with a mix of letters and numbers\">
                            </div>

                            <div class="form-group">
                                <label for="inpPass1">Confirm Password</label>
                                <input required type="password" name="inpPass1" class="form-control" id="inpPass1" placeholder="" value="`+password1+`">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="editPassword" value="`+username+`" class="btn btn-primary">Save Changes</button>
                        </div>
				`;
				$("#editPass").empty();
				$("#editPass").append(priceHTML);
			}
			if(!!document.getElementById("VariationErrorMsg"))
			{
				document.getElementById("VariationErrorMsg").remove();
			}
		},
		error: function(err) {
			alert(err.responseText);
		}
	});
}
</script>