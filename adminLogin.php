<?php require __DIR__ . '/header.php' ?>

<?php
    if (isset($_SESSION['login']) && $_SESSION['login']){
        ?><script>window.location = '<?php echo("$domain/index.php");?>'</script><?php
		exit;
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$Login = false;
		if(isset($_POST['username'],$_POST['password'])&& !empty($_POST['username'])  && !empty($_POST['password']))
		{
			$username = $_POST['username'];
			$password = md5($_POST['password']); 
			
			//Sanitize
			$username = filter_var(SanitizeString($_POST['username']), FILTER_SANITIZE_STRING);
			
			//Access Database
			$sql = "SELECT * FROM user WHERE username = '$username' OR email = '$username' AND password = '$password'";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					//echo "<script>alert('Login Successfull')</script>";
					$Login = true;
					$_SESSION['login'] = true;
					$_SESSION['id'] = $row["username"];
                    $_SESSION['uid'] = $row["user_id"];
					$_SESSION['name'] = $row["name"];
					$_SESSION['role'] = $row["role"];
					?><script>window.location = '<?php echo("$domain/index.php");?>'</script><?php
				}
			} else {
				$Login = false;
			}

			if($Login == false)
			{
				echo "<script>alert('Invalid Username/Email or Password')</script>";
			}

			mysqli_close($conn);
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
                                        <div class="h1 text-gray-900 mb-4">Login</div>
                                    </div>
                                    
                                    <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data" background-image="/img/resource/login.png">
                                        <div class="form-group">
                                            <label>Username/Email</label>
                                            <input required type="text" name="username" class="form-control"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Please Enter Your Email Address or Username">
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input required type="password" name="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Please Enter Password">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block" name="login">LOGIN</button>

                                        <div class="text-left">
                                            <a class="small" href="../forgetPassword.php">Forgot Password?</a>
                                        </div>
                                    </form>

                                    <hr>
                                    
                                    <div class="text-left">
                                        New to SGC E-Shop?<a href="../seller/sellerRegister.php"> Sign Up </a>
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