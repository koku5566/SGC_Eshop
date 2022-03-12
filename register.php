<?php
	require __DIR__ . '/header.php'
	
	// if($_SESSION['isLogin'] == true)
	// {
	// 	echo "<script>alert('Logout to continue');
	// 		window.location.href='Main.php';</script>";
    // }
?>
<?php
if(isset($_POST['signup']))
	{
		$_SESSION['AddUser'] = false;
		if(!empty($_POST['name']) && !empty($_POST['password']) && isset($_POST['name'],$_POST['password']))
		{
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$password1 = md5($_POST['password1']);
			$contact = $_POST['contact'];
			$address = $_POST['address'];
			
			if($password==$password1){
				$sql_u = "SELECT * FROM user WHERE username OR email='$email'";

				$stmt_u = mysqli_query($conn, $sql_u);

				if (mysqli_num_rows($stmt_u) > 0) {	
					echo("<script>alert('This Email Already Exists');</script>");
				}
				else
				{
					$sql = "INSERT INTO user (name, email, password, contact, address)
					VALUES ('$name','$email','$password','$contact','$address')";
				
					if (mysqli_query($conn, $sql)) {
						$_SESSION['AddUser'] = true;
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
					mysqli_close($conn);
				}
			}
			else
			{
				echo("<script>alert('Password NOT Match');</script>");
			}
		}
	}
?>

<div id="title"><h2>Sign Up</h2></div>
<div id="SignUp">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
<div class="form-group">
	<p id="label">Name</p>
	<input required type="text" name="name" maxlength="50"/>
</div>
	<p id="label">Email Address</p>
	<input required type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" placeholder="xxxxx@xxx.xxx"/>
	
	<div class="form-group">
		<label>Password</label>
		<input required type="password" name="password" class="form-control form-control-user"
			id="exampleInputPassword" placeholder="Please Enter Password">
     </div>

	<p id="label">Password</p>
	<input required type="password" name="password" maxlength="50" pattern=".{8,}" placeholder="At least 8 characters long" title="Must be at least 8 characters long"/>
	
	<p id="label">Confirm Password</p>
	<input required type="password" name="password1" maxlength="50"/>
	
	<p id="label">Contact</p>
	<input required type="tel" name="contact" pattern="[0-9]{3}-[0-9]{7-8}" maxlength="12" placeholder="000-0000000"/>
	
	<p id="label">Address</p>
	<textarea required type="text" name="address" maxlength="999"></textarea><br><br>
	
	<button type="reset" name="reset">Reset</button>
	<button type="submit" name="signup">Sign Up</button>
	<p id="label">Already a User? <a href="Login.php">Sign In</a></p>
</form>
<?php
if(isset($_SESSION['AddUser']))
	{
		if($_SESSION['AddUser'] == true)
		{
			echo "<script>alert('Registered Successfully');</script>";
		}
		$_SESSION['AddUser'] = NULL;
	}
?>
</div>

<?php require __DIR__ . '/footer.php' ?>