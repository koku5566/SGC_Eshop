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
					echo "<script>alert('Password Has Been Reset');
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

<div class="bg-gradient-primary" style="margin-top: -1.5rem !important;">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-left">
                                        <div class="h1 text-gray-900 mb-4">Reset Password</div>
                                    </div>
                                    
                                    <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
											<label>Password</label>
											<input required type="password" name="password" class="form-control" id="inputPassword" maxlength="50" pattern="(?=.*\d).{8,}" placeholder="Use 8 or more characters with a mix of letters and numbers" title="Use 8 or more characters with a mix of letters and numbers">
											
											<label>Confirm Password</label>
											<input required type="password" name="password2" class="form-control" id="inputRepeatPassword" maxlength="50">
											
											<hr>

											<button type="submit" class="btn btn-primary btn-block" name="confirm">Confirm</button>
										</div>
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

<?php require __DIR__ . '/footer.php' ?>