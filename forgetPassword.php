<?php require __DIR__ . '/header.php' ?>

<?php
	if(isset($_POST['Send']))
	{
		$email=$_POST['email'];
		
		$to = $email;
		$subject = "SGC E-Shop Reset Password";
		$from = "noreply@mail.com";
		$from2 = "SGCEShop@mail.com";
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

		$HTMLcontent = "<p><b>Dear User</b>,</p><p>$message</p>";
		
		$boundary = md5(time());
		$headers .= " boundary=\"{$boundary}\"";
		$message = "--{$boundary}\r\n";
		$message .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
		$message .= "Content-Transfer-Encoding: 7bit\r\n";
		$message .= $HTMLcontent . "\r\n";
		$message .= "--{$boundary}\r\n";
		$returnPath = "-f" . $from2;
		
		if(@mail($to, $subject, $message, $headers, $returnPath)){
			echo "<script>alert('Link to reset password has been sent to the email address')</script>";
		}
	}
?>

<div id="title"><h2>Forget Password</h2></div>
<div id="Login">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<p id="label">Email Address</p>
	<input required type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" placeholder="xxxxx@xxx.xxx"/>
	
	<button type="submit" name="Send">Send</button>
</form>
</div>

<?php require __DIR__ . '/footer.php' ?>