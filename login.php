<?php require __DIR__ . '/header.php' ?>

<?php
    if (isset($_SESSION['login']) && $_SESSION['login']){
        ?><script>window.location = '<?php echo("$domain/index.php");?>'</script><?php
		exit;
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$Login = false;
		if(isset($_POST['username'],$_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']))
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
            <div class="col-xl-8 col-lg-6 col-md-9">
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
                                                id="inputEmail" placeholder="Please Enter Your Email Address or Username">
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input required type="password" name="password" class="form-control"
                                                id="inputPassword" placeholder="Please Enter Password">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block" name="login">LOGIN</button>

                                        <div class="text-left">
                                            <a class="small" href="forgetPassword.php">Forgot Password?</a>
                                        </div>
                                        
                                        <div class="or-container">
                                            <div class="or-line"></div>
                                            <span style="padding: 0 1rem">OR</span>
                                            <div class="or-line"></div>
                                        </div>

                                        <div class="alt-login" style="display: flex;">
                                        <div class="btn btn-microsoft btn-block">
                                            <i class="fab fa-microsoft fa-fw"></i> Microsoft 365
                                        </div>

                                        <div class="btn btn-google btn-block" id="google-login-button">
                                            <i class="fab fa-google fa-fw"></i> Google
                                        </div>

                                        <div class="btn btn-facebook btn-block fb-login-button" data-width="" data-size="medium" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false">
                                             Facebook
                                        </div><!--<i class="fab fa-facebook-f fa-fw"></i>-->
                                        </div>
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

<!--Google Login-->
<div id="g-root"></div>
<script async defer src="https://apis.google.com/js/platform.js"></script>
<script src="https://apis.google.com/js/api:client.js"></script>

<!--Custom Google Login Button-->
<script>
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '232698708614-77t70ejn63rnaabr2mk1u9kp4q2o68on.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('google-login-button'));
    });
  };

  function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
          document.getElementById('g-root').innerText = "Signed in: " +
              googleUser.getBasicProfile().getName();
        }, function(error) {
          //alert(JSON.stringify(error, undefined, 2));
        });
  }
  startApp();
</script>

<script>
    function onSignIn(googleUser) {
        var id_token = googleUser.getAuthResponse().id_token;
        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'https://eshop.sgcprototype2.com/googleLogin.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
        console.log('Signed in as: ' + xhr.responseText);
        };
        xhr.send('idtoken=' + id_token);

        $.ajax({
			url:"https://oauth2.googleapis.com/tokeninfo",
			method:"GET",
			data:{
				id_token:id_token,
			},
			dataType: 'JSON',
			success: function(response){
                var len = response.length;
				for(var i=0; i<len; i++){
					var email = response[i].email;
					var email_verified = response[i].email_verified;
                    var name = response[i].name;

                    if(email_verified == "true")
                    {

                    }
				}
			},
			error: function(err) {
				//$('#login_message').html(err.responseText);
				alert(err.responseText);
			}
		});

        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    }
</script>

<!--Facebook Login-->
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

.btn-microsoft {
    color: #fff;
    background-color: #0078d4;
    border-color: #fff;
    margin-top: 0.5rem;
}
.btn-microsoft:hover {
    color: #fff;
    background-color: #0078d4;
    border-color: #e6e6e6;
}
</style>