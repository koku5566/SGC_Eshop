<?php require __DIR__ . '/header.php' ?>

<?php
	if($_SESSION['login'] == false || $_SESSION['role'] != "ADMIN")
	{
		echo "<script>alert('Login as Admin account to access');
			window.location.href='login.php';</script>";
    }
?>
<?php
	if(isset($_POST['update']))
	{
		$UID = $_SESSION['ToEdit'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$contact = $_POST['contact'];
		$user = $_POST['user'];

		$sql_u = "SELECT * FROM user WHERE username = '$UID'";

		$stmt_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($stmt_u) > 0) {
			
			if($_POST['password'] != ""){
				$sql = "UPDATE user SET name='$name', email='$email', password='$password', contact='$contact', address='$address', ADMIN='$user' WHERE username='$UID'";
			}
			else{
				$sql = "UPDATE user SET name='$name', email='$email', contact='$contact', address='$address', ADMIN='$user' WHERE username='$UID'";
			}
		
			if (mysqli_query($conn, $sql)) {
				$_SESSION['Update'] = true;
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		}
		else
		{
			echo("<script>alert('Error');</script>");
		}
	}
?>

<div id="DataDiv">
<h1>User Profile</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
<?php
	$UID = $_SESSION['ToEdit'];
	$sql = "SELECT * FROM user WHERE username = '$UID'";
	$res_data = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res_data) > 0){
		while($row = mysqli_fetch_array($res_data)){
			echo("
				<input name=\"product\" value=\"".$row["username"]."\" hidden/>
				
				<p id=\"label\">User Category
				<select id=\"user\" name=\"user\">
				");
				if($row['role'] == "USER")
				{
					echo("<option value=\"USER\" selected=\"selected\">USER</option>
					<option value=\"SELLER\">SELLER</option>
					<option value=\"ADMIN\">ADMIN</option>");
				}
				else if($row['role'] == "SELLER")
				{
					echo("<option value=\"USER\">USER</option>
					<option value=\"SELLER\" selected=\"selected\">SELLER</option>
					<option value=\"ADMIN\">ADMIN</option>");
				}
				else if($row['role'] == "ADMIN")
				{
					echo("<option value=\"USER\">USER</option>
					<option value=\"SELLER\">SELLER</option>
					<option value=\"ADMIN\" selected=\"selected\">ADMIN</option>");
				}
				echo("
				</select></p>

					<img src=\"data:image;base64,".base64_encode($row["profile_picture"])."\" alt=\"Image.jpg\" id=\"aPic\" style=\"width:150px\">
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
<?php
if(isset($_SESSION['Update']))
	{
		if($_SESSION['Update'] == true)
		{
			echo "<script>alert('Details Updated');
			window.location.href='adminManageUser.php';</script>";
		}
		$_SESSION['Update'] = NULL;
	}
?>
</div>

<?php require __DIR__ . '/footer.php' ?>