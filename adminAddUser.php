<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false || $_SESSION['role'] != "ADMIN")
	{
		?><script>window.location = '<?php echo("$domain/E404.php");?>'</script><?php
		exit;
    }
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
			$contact = ("6010-0000000");
			$date = date("d/m/Y");
			$role = $_POST['role'];

			if($password==$password1){
				$sql_u = "SELECT * FROM user WHERE username OR email = '$username' OR '$email'";

				$stmt_u = mysqli_query($conn, $sql_u);

				if (mysqli_num_rows($stmt_u) > 0) {	
					echo("<script>alert('Username or Email Already Exists');</script>");
				}
				else
				{
					$sql = "INSERT INTO user (userID, username, email, password, name, contact, registration_date, role)
					VALUES ((SELECT CONCAT('U',(SELECT LPAD((SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'sgcprot1_SGC_ESHOP' AND TABLE_NAME = 'user'), 6, 0))) AS newUserId),'$username','$email','$password','$username','$contact','$date','$role')";
				
					if (mysqli_query($conn, $sql)) {
						$passwordE=$_POST['password'];

						$to = $email;
						$subject = "SGC E-Shop New User Account";
						$from = "reset-password@eshop.sgcprototype2.com";
						$from2 = "contact_us_mail@sgcprototype2.com";
						$fromName = "SGC E-Shop";
			
						$headers =  "From: $fromName <$from> \r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: multipart/mixed;\r\n";
						
						$message = "
						Informations below are the login credentials for you to login into SCG E-Shop: https://eshop.sgcprototype2.com
						
						Change your password after first login. Thank You.

						Username: $username
						Password: $passwordE
						";
			
						$HTMLcontent = "<p><b>Dear ".$row["name"]."</b>,</p><p>$message</p>";
						
						$boundary = md5(time());
						$headers .= " boundary=\"{$boundary}\"";
						$message = "--{$boundary}\r\n";
						$message .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
						$message .= "Content-Transfer-Encoding: 7bit\r\n";
						$message .= $HTMLcontent . "\r\n";
						$message .= "--{$boundary}\r\n";
						$returnPath = "-f" . $from2;

						if (@mail($to, $subject, $message, $headers, $returnPath)){
							$_SESSION['AddUser'] = true;
							echo "<script>alert('User Added');</script>";
						}
						else
						{
							echo "<script>alert('Error');</script>";
						}
					}
					else
					{
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

<div class="bg-gradient-primary" style="margin-top: -1.5rem !important; padding: 4rem 0;">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-left">
                                <div class="h1 text-gray-900 mb-4">Add User</div>
                            </div>

                            <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
										<label>Email Address</label>
										<input required type="email" name="email" class="form-control" id="inputEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" placeholder="Enter Email Address"/>
                                    </div>
									
                                    <div class="col-sm-6">
										<label>Username</label>
										<input required type="text" name="username" class="form-control" id="inputUsername" maxlength="50" placeholder="Enter Username">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
										<label>Password</label>
										<input required type="password" name="password" class="form-control" id="inputPassword" maxlength="50" pattern="(?=.*\d).{8,}" placeholder="Use 8 or more characters with a mix of letters and numbers" title="Use 8 or more characters with a mix of letters and numbers">
                                    </div>
                                    <div class="col-sm-6">
										<label>Confirm Password</label>
										<input required type="password" name="password1" class="form-control" id="inputRepeatPassword" maxlength="50">
                                    </div>
                                </div>

								<div class="form-group">
									<div class="custom-control custom-checkbox small">
										<input required type="checkbox" class="custom-control-input" id="customCheck">
										<label class="custom-control-label" for="customCheck">I Agree to SEGi Group Colleges E-Shop's <a href="x.php">Terms of Use</a> and <a href="x.php">Privacy Policy</a></label>
									</div>
									<hr>
									<label>User Role</label>
									<select id="userRole" name="role">
										<option value="USER" selected="selected">USER</option>
										<option value="SELLER">SELLER</option>
										<option value="ADMIN">ADMIN</option>
									</select>
                                </div>

								<button type="submit" class="btn btn-primary btn-block" name="signup">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php' ?>