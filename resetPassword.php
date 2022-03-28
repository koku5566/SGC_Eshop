<?php require __DIR__ . '/header.php' ?>

<?php
	if(isset($_SESSION['VerifyCorrect']) && $_SESSION['VerifyCorrect'] == true)
	{
		;
	}
	else
	{
		if(!isset($_SESSION['VerifyCode']) || $_GET['hash'] != $_SESSION['VerifyCode'] || !isset($_GET['email']))
		{
			echo "<script>window.location.href='login.php';</script>";
		}
		else
		{
			$_SESSION['VerifyCorrect'] = true;
			$_SESSION['uemail'] = $_GET['email'];
		}
	}

	if(isset($_POST['confirm']))
	{
		$password = md5($_POST['password']);
		$password2 = md5($_POST['password2']);
		if($password==$password2){
			$email = $_SESSION['uemail'];
			
			$sql_u = "SELECT * FROM user WHERE email = '$email'";

			$stmt_u = mysqli_query($conn, $sql_u);

			if (mysqli_num_rows($stmt_u) > 0) {	
				$sql = "UPDATE user SET password='$password' WHERE email='$email'";
			
				if (mysqli_query($conn, $sql)) {
					$_SESSION['VerifyCorrect'] = false;
					$_SESSION['VerifyCode'] = false;
					echo "<script>alert('Password Reset Successful');
					window.location.href='login.php';</script>";
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
		else
		{
			echo("<script>alert('Password NOT Match');</script>");
		}
	}
?>

<div id="title"><h2>Reset Password</h2></div>
<div id="Login">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<p id="label">Password</p>
	<input required type="password" name="password" class="form-control" id="inputPassword" maxlength="50" pattern="(?=.*\d).{8,}" placeholder="Use 8 or more characters with a mix of letters and numbers" title="Use 8 or more characters with a mix of letters and numbers">
	
	<p id="label">Confirm Password</p>
	<input required type="password" name="password2" class="form-control" id="inputRepeatPassword" maxlength="50">
	
	<button type="submit" name="confirm">Confirm</button>
</form>
</div>

<?php require __DIR__ . '/footer.php' ?>