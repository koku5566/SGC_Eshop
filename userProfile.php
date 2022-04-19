<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false)
	{
		?><script>window.location = '<?php echo("$domain/login.php");?>'</script><?php
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
				echo "<script>alert('Details Updated');</script>";
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
					<img src=\"data:image;base64,".base64_encode($row["profile_picture"])."\" alt=\"Image.jpg\" id=\"aPic\" style=\"width:150px\">
					<input type=\"file\" name=\"proPic\" value=\"data:image;base64,".base64_encode($row["profile_picture"])."\"/>
					
					<div class=\"form-group\">
					<label>Username</label>
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
					</div>

					<div class=\"form-group\">
					<label>Contact</label>
					<input required type=\"tel\" name=\"contact\" pattern=\"[0-9]{4}-[0-9]{7,}\" maxlength=\"13\" placeholder=\"0000-00000000\" value=\"".$row["contact"]."\" class=\"form-control\"/>
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

<?php require __DIR__ . '/footer.php' ?>