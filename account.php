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
		$password = md5($_POST['password']);
		$contact = $_POST['contact'];

		if($_FILES['proPic']['tmp_name'] != "")
		{
			$proPic = addslashes(file_get_contents($_FILES['proPic']['tmp_name']));
		}

		$sql_u = "SELECT * FROM user WHERE user_id = '$UID'";

		$stmt_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($stmt_u) > 0) {	
		
			if($_POST['password'] != ""){
				$sql = "UPDATE user SET profile_picture='$proPic', name='$name', password='$password', contact='$contact' WHERE user_id='$UID'";
			}
			else{
				$sql = "UPDATE user SET name='$name', contact='$contact' WHERE user_id='$UID'";
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

<div class="row">
<?php require __DIR__ . '/userprofilenav.php' ?>
	<div id="account">
	<h1>My Profile</h1>
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
	<?php
		$UID = $_SESSION["id"];
		$sql = "SELECT * FROM user WHERE user_id = '$UID'";

		$res_data = mysqli_query($conn,$sql);
		if (mysqli_num_rows($res_data) > 0){
			while($row = mysqli_fetch_array($res_data)){
				echo("
					<img src=\"data:image;base64,".base64_encode($row["profile_picture"])."\" alt=\"Image.jpg\" id=\"aPic\">
					<input type=\"file\" name=\"proPic\" value=\"data:image;base64,".base64_encode($row["profile_picture"])."\"/>
					
					<p id=\"label\">Name</p>
					<input required type=\"text\" name=\"name\" maxlength=\"50\" value=\"".$row["name"]."\"/>
					
					<p id=\"label\">Email Address</p>
					<input disabled type=\"email\" name=\"email\" maxlength=\"50\" placeholder=\"xxxxx@xxx.xxx\" value=\"".$row["email"]."\" style=\"border: 1px solid #1d1e1e; background-color: lightgray;\"/>
					
					<p id=\"label\">Password</p>
					<input type=\"password\" name=\"password\" pattern=\".{8,}\" maxlength=\"50\" title=\"Must be at least 8 characters long\"/>
					
					<p id=\"label\">Contact</p>
					<input required type=\"tel\" name=\"contact\" pattern=\"[0-9]{3}-[0-9]{7-8}\" maxlength=\"12\" placeholder=\"000-0000000\" value=\"".$row["contact"]."\"/>
					
					<button type=\"submit\" name=\"update\">Update</button>
					");
			}
		}
		/*<input required type=\"password\" name=\"password\" pattern=\".{8,}\" maxlength=\"50\" value=\"".$row["password"]."\"/>*/
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