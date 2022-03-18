<?php
    require __DIR__ . '/header.php'
?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'],$_POST['email'],$_POST['message'],$_POST['subject'],$_POST['CUSubmit']) && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["message"]) && !empty($_POST["subject"])){

  
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
 
 
 
  
  if ($name === '') {
   // print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
    
  }
  if ($email === '') {
    //print json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
  
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     // print json_encode(array('message' => 'Email format invalid.', 'code' => 0));
    
    }
  }
  if ($subject === '') {
   // print json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
   
  }
  if ($message === '') {
   // print json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
    
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
									<input type="text" id="name" name="name" class="form-control"  placeholder="Full Name*" required>
									
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="md-form mb-0">
									<label for="email" class="">Your email</label>
									<input type="email" id="email" name="email" class="form-control"  placeholder="Email*" required>
									
								</div>
							</div>
						</div>
						<!--END of Grid row-->	
						
						<!--Grid row of College-->
						<div class="row">
							<div class="col-md-12">
								<div class="md-form mb-0">
									<label for="subject" class="">Campus</label>
									<select class="form-control" id="CUCollege" name = "CUCollegeList" required>
									  <option value = "" disabled>Campus*</option>
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
									<input type="text" id="subject" name="subject" class="form-control" placeholder="Subject*" required>
								</div>
							</div>
						</div>
						<!--END of Grid row-->		
							
						<!--Grid row for MESSAGE-->
						<div class="row">
							<div class="col-md-12">
								<div class="md-form">
									<label for="message">Your message</label>
									<textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" placeholder="Message*" required></textarea>
								</div>
							</div>	
						</div>		
						<!--END of Grid row-->		

						<input type = "submit" name = "CUSubmit" class="btn btn-primary"  value = "Submit" >
					</form>

					
				</div>
			</div>
		</section>				
								
	</div>
<!--END OF CONTACT US FORM-->	
						
							
						<!-- Example split danger button -->
<div class="btn-group">
  <input type="text" id="sohai" name="sohai" class="form-control" placeholder="sohai*" required>
  <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <select class="form-control dropdown-menu" id="CUCollege" name = "CUCollegeList" required>
	  <option value = "" class="dropdown-item" disabled>Jokes aside*</option>
	  <option value = "C-SJ" class="dropdown-item">General Enquiry</option>
	  <option value = "C-KL" class="dropdown-item">Bug Related</option>
	  <option value = "C-P" class="dropdown-item">Payment Related</option>
	  <option value = "C-S" class="dropdown-item">Account Related</option>
  </select>		
</div>
						
						
				

				

			

		
		
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
/*
function validateForm() {
  var name =  document.getElementById('name').value;
  var email =  document.getElementById('email').value;
  var subject =  document.getElementById('subject').value;
  var message =  document.getElementById('message').value;
  
  var n = false 
  var e = false
  var s = false
  var m = false 
  var c = false
  
  
  if (name.replace(/(^\s+|\s+$)/g, '') == "") {
	  document.querySelector('.status').innerHTML = "Name cannot be empty";
      n = false;
  }else{n = true}
  
  if (email.replace(/(^\s+|\s+$)/g, '') == "") {
	  document.querySelector('.status').innerHTML = "Email cannot be empty";
      e = false;
  } else {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(!re.test(email)){
          document.querySelector('.status').innerHTML = "Email format invalid";
           e = false;
      }else{e = true;}
  }
  
  if (subject.replace(/(^\s+|\s+$)/g, '') == "") {
      document.querySelector('.status').innerHTML = "Subject cannot be empty";
      s = false;
  }else{s = true;}
  
  if (message.replace(/(^\s+|\s+$)/g, '') == "") {
      document.querySelector('.status').innerHTML = "Message cannot be empty";
      m = false
  }else{m = true;}
  
  
  if(n == true && e == true && s == true && m == true && c == true){
	  document.getElementById('CUSubmit').disabled = false;
  }else{
	  document.getElementById('CUSubmit').disabled = true;
  }
  
  
  
}
	
*/


</script>