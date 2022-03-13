<?php
	require __DIR__ . '/header.php'
	

?>
<?php
if(isset($_POST['signup']))
	{
		$_SESSION['AddUser'] = false;
		if(!empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['username'],$_POST['password']))
		{
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$password1 = md5($_POST['password1']);
			$date = curdate();

			if($password==$password1){
				$sql_u = "SELECT * FROM user WHERE username OR email= '$username' OR '$email'";

				$stmt_u = mysqli_query($conn, $sql_u);

				if (mysqli_num_rows($stmt_u) > 0) {	
					echo("<script>alert('This User Already Exists');</script>");
				}
				else
				{
					$sql = "INSERT INTO user (username, email, password, name, registration_date, role,)
					VALUES ('$username','$email','$password','$username','$date','USER')";
				
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

<div class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-left">
                                <h1 class="h4 text-gray-900 mb-4">Sign Up</h1>
								Create Your SEGi Group of Colleges E-Shop Account
                            </div>

                            <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
										<label>Email Address</label>
										<input required type="email" name="email" class="form-control form-control-user" id="inputEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" placeholder="xxxxx@xxx.xxx"/>
                                    </div>
									
                                    <div class="col-sm-6">
										<label>Username</label>
										<input required type="text" name="username" class="form-control form-control-user" id="inputUsername" maxlength="50" placeholder="Enter Your Username">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
										<label>Password</label>
										<input required type="password" name="password" class="form-control form-control-user" id="inputPassword" maxlength="50" pattern=".{8,}" placeholder="At least 8 characters long" title="Must be at least 8 characters long">
                                    </div>
                                    <div class="col-sm-6">
										<label>Confirm Password</label>
										<input required type="password" name="password1" class="form-control form-control-user" id="exampleRepeatPassword" maxlength="50">
                                    </div>
                                </div>

								<button type="submit" class="btn btn-primary btn-user btn-block" name="signup">Sign Up</button>

                                <hr>
								<a href="index.html" class="btn btn-microsoft btn-user btn-block">
									<i class="fab fa-microsoft fa-fw"></i> Microsoft 365
								</a>
								<a href="index.html" class="btn btn-google btn-user btn-block">
									<i class="fab fa-google fa-fw"></i> Google
								</a>
								<a href="index.html" class="btn btn-facebook btn-user btn-block">
									<i class="fab fa-facebook-f fa-fw"></i> Facebook
								</a>
                            </form>

                            <hr>
                            <div class="text-center">
								Already Have an Account?<a class="small" href="login.php"> Login </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php' ?>