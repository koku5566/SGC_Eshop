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
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    
                                    <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data" background-image="/img/resource/login.png">
                                        <div class="form-group">
                                            <label>Username/Email</label>
                                            <input required type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Please Enter Your Email Address or Username">
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input required type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Please Enter Password">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="login">LOGIN</button>

                                        <div class="text-left">
                                            <a class="small" href="forgetPassword.php">Forgot Password?</a>
                                        </div>
                                        
                                        <hr>
                                        <div class="or-container">
                                            <div class="or-line"></div>
                                            <span style="padding: 0 1rem">OR</span>
                                            <div class="or-line"></div>
                                        </div>

                                        <a href="index.html" class="btn btn-microsoft btn-user btn-block">
                                            <i class="fab fa-microsoft fa-fw"></i> Microsoft 365
                                        </a>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Google
                                        </a>
                                        <div class="g-signin2" data-onsuccess="onSignIn"></div>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Facebook
                                        </a>
                                        <div class="fb-login-button" data-width="" data-size="medium" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>
                                    </form>

                                    <hr>
                                    
                                    <div class="text-left">
                                        New to SGC E-Shop?<a href="register.php"> Sign Up </a>
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

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=913746515960441&autoLogAppEvents=1" nonce="eUmuyEF6"></script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '913746515960441',
      cookie     : true,
      xfbml      : true,
      version    : '{api-version}'
    });
    FB.AppEvents.logPageView();   
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<?php require __DIR__ . '/footer.php' ?>

<style>
.or-container{
    display: flex;
    align-items: center;
}
.or-line{
    height: 1px;
    width: 100%;
    background-color: rgba(0,0,0,.1);
    flex: 1;
}
</style>