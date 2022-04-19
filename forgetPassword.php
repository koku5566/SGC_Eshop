<?php require __DIR__ . '/header.php' ?>

<?php
	if(isset($_POST['Send']))
	{
		$email=$_POST['email'];
		
		$sql = "SELECT * FROM user WHERE email = '$email'";
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($res);
		if (mysqli_num_rows($res) > 0)
		{
			$to = $email;
			$subject = "SGC E-Shop Reset Password";
			$from = "reset-password@eshop.sgcprototype2.com";
			$from2 = "contact_us_mail@sgcprototype2.com";
			$fromName = "SGC E-Shop";

			$headers =  "From: $fromName <$from> \r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: multipart/mixed;\r\n";
			
			$hash = md5( rand(0,1000) );
			$_SESSION['VerifyCode'] = $hash;
			$message = "
			<p>We received a request to reset your SGC E-Shop account password.
			<br>Click the link below to reset.
			<br><b>https://eshop.sgcprototype2.com/resetPassword.php?email=$email&hash=$hash</b>
			<br>
			<br>
			<br>
			<br><b>Ignore this email if you did not make this request.</b>
			</p>
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
			
			if(@mail($to, $subject, $message, $headers, $returnPath)){
				echo "<script>alert('Link for reset password has been sent to $email')</script>";
			}
			else
			{
				echo "<script>alert('Error')</script>";
			}
		}
		else
		{
			echo "<script>alert('Account Does Not Exist')</script>";
		}
	}
?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<div class="bg-gradient-primary" style="margin-top: -1.5rem !important;">
    <div class="container">
	<div id="title"><h2>Forget Password</h2></div>
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-9">
			<p id="label">Email Address</p>
			<input required type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" placeholder="xxxxx@xxx.xxx"/>
			
			<button type="submit" name="Send">Send</button>
			</div>
		</div>
	</div>
</div>
</form>

<?php require __DIR__ . '/footer.php' ?>