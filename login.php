<?php require __DIR__ . '/header.php' ?>

<?php
	function SanitizeString(string $str):string{
		if(get_magic_quotes_gpc()){
			$str = stripslashes($str);
		}
		$str = strip_tags($str);
		$str = htmlentities($str, ENT_QUOTES);
		
		return $str;
	}

	if(!isset($_SESSION)){
		session_start();
	}

	if (isset($_SESSION['isLogin']) && $_SESSION['isLogin']){
		header('location: Main.php');
		exit;
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$Login = false;
		if(isset($_POST['username'],$_POST['upassword'])&& !empty($_POST['username'])  && !empty($_POST['upassword']))
		{
			$uname = $_POST['username'];
			$upass = md5($_POST['upassword']); 
			
			//Sanitize
			$uname = filter_var(SanitizeString($_POST['username']), FILTER_SANITIZE_STRING);
			
			//Access Database
			$sql = "SELECT * FROM user WHERE email='$uname' AND password='$upass'";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					echo "<script>alert('Login Successfully')</script>";
					$Login = true;
					$_SESSION['isLogin'] = true;
					$_SESSION['id'] = $row["userID"];
					$_SESSION['name'] = $row["name"];
					$_SESSION['admin'] = $row["ADMIN"];
					header("location: Main.php");
				}
			} else {
				$Login = false;
			}

			if($Login == false)
			{
				echo "<script>alert('Invalid Username or Password')</script>";
			}

			mysqli_close($conn);
		}
	}
?>

<div id="title"><h2>Login</h2></div>
<div id="Login">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<p id="label">Email Address</p>
	<input required type="text" name="username" maxlength="50"/>
	<p id="label">Password</p>
	<input required type="password" name="upassword" maxlength="50"/><br><br>
	
	<button type="reset" name="reset">Reset</button>
	<button type="submit" name="login">Login</button>
	<p id="label"><a href="ForgetPass.php">Forget Password?</a></p>
	<p id="label">New User? <a href="Register.php">Sign Up</a></p>
</form>
</div>

<?php require __DIR__ . '/footer.php' ?>