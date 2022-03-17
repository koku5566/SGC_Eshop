<?php
    require __DIR__ . '/header.php'
?>

<?php
	
    
?>


<!-- Begin Page Content --------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">		
		
	<div  class = "faker"style ="width: 80%">
      <!--Section: Contact v.2-->
		<section class="mb-4">

			<!--Section heading-->
			<h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
			<!--Section description-->
			<p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
				a matter of hours to help you.</p>

			<div class="row justify-content-md-center">

				<!--Grid column-->
				<div class="col-md-9 mb-md-0 mb-5">
					<form id="contact-form" name="contact-form" action="mail.php" method="POST">

						<!--Grid row-->
						<div class="row">

							<!--Grid column-->
							<div class="col-md-6">
								<div class="md-form mb-0">
									<label for="name" class="">Your name</label>
									<input type="text" id="name" name="name" class="form-control">
									
								</div>
							</div>
							<!--Grid column-->

							<!--Grid column-->
							<div class="col-md-6">
								<div class="md-form mb-0">
									<label for="email" class="">Your email</label>
									<input type="text" id="email" name="email" class="form-control">
									
								</div>
							</div>
							<!--Grid column-->

						</div>
						<!--Grid row-->

						<!--Grid row-->
						<div class="row">
							<div class="col-md-12">
								<div class="md-form mb-0">
									<label for="subject" class="">Subject</label>
									<input type="text" id="subject" name="subject" class="form-control">
									
								</div>
							</div>
						</div>
						<!--Grid row-->

						<!--Grid row-->
						<div class="row">

							<!--Grid column-->
							<div class="col-md-12">

								<div class="md-form">
									<label for="message">Your message</label>
									<textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
									
								</div>

							</div>
						</div>
						<!--Grid row-->

					</form>

					<div class="text-center text-md-left">
						<a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Send</a>
					</div>
					<div class="status"></div>
				</div>
				

				

			</div>

		</section>
		</div>
<!--Section: Contact v.2-->
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

	

</script>