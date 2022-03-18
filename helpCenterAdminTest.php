<?php
    require __DIR__ . '/header.php'
?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['CUname'],$_POST['CUemail'],$_POST['CUmessage'],$_POST['CUsubject'],$_POST['CUcampuslist'],$_POST['CUsubmit']) && !empty($_POST["CUname"]) && !empty($_POST["CUemail"]) && !empty($_POST["CUmessage"]) && !empty($_POST["CUsubject"]) && !empty($_POST["CUcampuslist"])){

  
    //$email = $_POST['email'];
 // $content="From: $name \n Email: $email \n Message: $message";
  //$recipient = "kitmincheong@gmail.com"; 
 //$subject = "PHP Mail Sending Checking";
// $message = "PHP mail works fine";
 //$header = "FROM:" . $from;
 //mail($recipient, $subject, $content, $mailheader)
 
  /* THIS HOR UK IS THE EMAIL ^ jiu kaki see d
 $name = $_POST['name'];
  $message = $_POST['message'];
  $subject = $_POST['subject'];
  $to = $_POST['email'];

 $header = "From: $email \r\n";
 $from = "Contact_Us_Mail@sgprototype2.com";
 
 if(mail($to, $subject, $message, $header)){
	  echo "<script>alert('Email sent!')</script>";
 }else{
	 echo "<script>alert('Fail to sent!')</script>";
 }
 */
 
 
 $CUname = $_POST['CUname'];
 $CUemail = $_POST['CUemail'];
 $CUmessage = $_POST['CUmessage'];
 $CUsubject = $_POST['CUsubject'];
 $CUcampuslist = $_POST['CUcampuslist'];
 $check = true;
	if (ltrim($CUname) === '') {
	 $check = false;
	 echo "<div class='alert alert-danger'>Name is required</div>";
	}
	if (ltrim($CUemail) === '') {
	 $check = false;
	 echo "<div class='alert alert-danger'>Email is required</div>";
  
	} else{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				
				echo "<div class='alert alert-danger'>Email format is invalid</div>";
			}	
	}
	if (ltrim($CUsubject) === '') {
	 $check = false;
	 echo "<div class='alert alert-danger'>Subject is required</div>";
	}
	if (ltrim($CUmessage) === '') {
	 $check = false;
     echo "<div class='alert alert-danger'>Message is required</div>";
	}
  
 
 $sql = "INSERT INTO `contactUs`(`name`, `email`, `campus`, `subject`, `message`) VALUES (?,?,?,?,?)";
 
		if($check == true){
			if($stmt = mysqli_prepare($conn, $sql)){
				mysqli_stmt_bind_param($stmt, 'sssss', $CUname,$CUemail,$CUcampuslist,$CUsubject,$CUmessage); 	
		
				mysqli_stmt_execute($stmt);
			
				if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
				{
					 echo "<div class='alert alert-success'>Thank you, we will get back to you soon</div>";
				}else{
					echo "<div class='alert alert-danger'>Fail to Insert</div>";
				}
		
				mysqli_stmt_close($stmt);
			}
			
		}else{
			echo "<div class='alert alert-danger'>Fail to sent Email</div>";
		}
			
  
  
 
  
 
}
?>


<!-- Begin Page Content --------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">		
	
	<!--START OF CONTACT US FORM-->	
	<div  class = "faker"style ="width: 80%; margin: auto">
      
		<section class="mb-4">

			<!--Section heading-->
			<h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
			<!--Section description-->
			<p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
				a matter of hours to help you.</p>

			<div class="row justify-content-md-center">

				<!--Grid column-->
				<div class="col-md-9 mb-md-0 mb-5">
					<form id="contact-form" name="contact-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

						<!--Grid row of NAME/EMAIL-->
						<div class="row">
							<div class="col-md-6">
								<div class="md-form mb-0">
									<label for="name" class="">Your name</label>
									<input type="text" id="name" name="CUname" class="form-control"  placeholder="Full Name*" required>
									
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="md-form mb-0">
									<label for="email" class="">Your email</label>
									<input type="email" id="email" name="CUemail" class="form-control"  placeholder="Email*" required>
									
								</div>
							</div>
						</div>
						<!--END of Grid row-->	
						
						<!--Grid row of College-->
						<div class="row">
							<div class="col-md-12">
								<div class="md-form mb-0">
									<label for="subject" class="">Campus</label>
									<select class="form-control" id="CUcampus" name = "CUcampuslist" required>
									  <option value = "" selected = 'selected'disabled>Campus*</option>
									  <option value = "C-SJ">SEGI College Subang Jaya</option>
									  <option value = "C-KL">SEGI College Kuala Lumpur</option>
									  <option value = "C-P">SEGI College Penang</option>
									  <option value = "C-S">SEGI College Sarawak</option>
									  <option value = "C-KD">SEGI College Kota Damansara</option>
									  <option value = "U-KD">SEGI University Kota Damansara</option>  
									</select>		 
								</div>
							</div>
						</div>
						<!--END of Grid row-->									

						<!--Grid row of SUBJECT-->
						<div class="row">
							<div class="col-md-12">
								<div class="md-form mb-0">
									<label for="subject" class="">Subject</label>
									<input type="text" id="subject" name="CUsubject" class="form-control" placeholder="Subject*" required>
								</div>
							</div>
						</div>
						<!--END of Grid row-->		
							
						<!--Grid row for MESSAGE-->
						<div class="row">
							<div class="col-md-12">
								<div class="md-form">
									<label for="message">Your message</label>
									<textarea type="text" id="message" name="CUmessage" rows="2" class="form-control md-textarea" placeholder="Message*" required></textarea>
								</div>
							</div>	
						</div>		
						<!--END of Grid row-->		

						<input type = "submit" name = "CUsubmit" class="btn btn-primary"  value = "Submit" >
					</form>

					
				</div>
			</div>
		</section>				
								
	</div>
<!--END OF CONTACT US FORM-->	
						
							
						

						
						
				

				

			

		
		
</div>
<!-- /.container-fluid ----------------------------------------------------------------------------------------------->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
.faker{
	border: 1px solid black;
}
</style>
<script>
$(".alert.alert-success").delay(2000).slideUp(200, function() {
    $(this).alert('close');
});
$(".alert.alert-danger").delay(3000).slideUp(200, function() {
    $(this).alert('close');
});


</script>