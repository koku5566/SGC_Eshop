<?php require __DIR__ . '/header.php' ?>

<?php
	if($_SESSION['login'] == false)
	{
		echo "<script>alert('Login to Continue');
			window.location.href='login.php';</script>";
    }
?>
<?php
if(isset($_POST['update']))
	{
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
		
			if($_POST['password'] != ""){
				$sql = "UPDATE user SET profile_picture='$proPic', name='$name', email='$email', password='$password', contact='$contact' WHERE username='$UID'";
			}
			else{
				$sql = "UPDATE user SET name='$name', email='$email', contact='$contact' WHERE username='$UID'";
			}
			
			if (mysqli_query($conn, $sql)) {
				$_SESSION['Update'] = true;
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		else
		{
			echo("<script>alert('Error');</script>");
		}
	}
?>

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["proPic"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["proPic"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["proPic"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>

<div class="row">
<?php require __DIR__ . '/userprofilenav.php' ?>
	<div id="account">
	<h1>My Profile</h1>
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
	<?php
		$UID = $_SESSION["id"];
		$sql = "SELECT * FROM user WHERE username = '$UID'";

		$res_data = mysqli_query($conn,$sql);
		if (mysqli_num_rows($res_data) > 0){
			while($row = mysqli_fetch_array($res_data)){
				echo("
					<img src=\"data:image;base64,".base64_encode($row["profile_picture"])."\" alt=\"Image.jpg\" id=\"aPic\">
					<input type=\"file\" name=\"proPic\" value=\"data:image;base64,".base64_encode($row["profile_picture"])."\"/>
					
					<div class=\"form-group\">
					<label>Name</label>
					<input required type=\"text\" name=\"name\" maxlength=\"50\" value=\"".$row["name"]."\" class=\"form-control form-control-user\"/>
					</div>
					
					<div class=\"form-group\">
					<label>Email Address</label>
					<input type=\"email\" name=\"email\" maxlength=\"50\" placeholder=\"Enter Your Email Address\" value=\"".$row["email"]."\" class=\"form-control form-control-user\"/>
					</div>

					<div class=\"form-group\">
					<label>Password</label>
					<input type=\"password\" name=\"password\" pattern=\"(?=.*\d).{8,}\" maxlength=\"50\" title=\"Use 8 or more characters with a mix of letters and numbers\" class=\"form-control form-control-user\"/>
					</div>

					<div class=\"form-group\">
					<label>Contact</label>
					<input required type=\"tel\" name=\"contact\" pattern=\"[0-9]{4}-[0-9]{7,}\" maxlength=\"13\" placeholder=\"0000-00000000\" value=\"".$row["contact"]."\" class=\"form-control form-control-user\"/>
					</div>
					
					<button type=\"submit\" name=\"update\">Update</button>
					");
			}
		}
	?>
	</form>
	</div>
</div>

<?php
if(isset($_SESSION['Update']))
	{
		if($_SESSION['Update'] == true)
		{
			echo "<script>alert('Details Updated');</script>";
		}
		else if($_SESSION['Update'] == false && $_SESSION['Error'] != "")
		{
			echo "<script>alert('".$_SESSION['Error']."');</script>";
		}
		$_SESSION['Update'] = NULL;
	}
?>

<?php require __DIR__ . '/footer.php' ?>