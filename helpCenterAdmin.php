<?php
	require __DIR__ . '/header.php'	
?>



<?php
	
   
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- Begin Page Content --------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">		

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="margin: 0 auto;">User Review</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        
      </div>
	  <!--CONTENT START-->
      <div class="modal-body">
		<!--DISPLAY HERE
		<div id = "modalResult" style = "height: 100%"></div>
		-->
        <div style="height: 100%">
					
					<img src = "https://pbs.twimg.com/profile_images/1452244355062829065/jUmYXUCM_400x400.jpg" class = "productpic">
					<div class = "namestar">
						<h5 style = "font-size: 1rem; padding-top: 1rem; margin-bottom: 0px;"><?php echo (isset($c4) && !empty ($c4))? $c4 : 'WI-SP510 Wireless Headphone blablabla'; ?></h5>
						<h6>Model: WISP510</h6>
						<h2>RM 349.00</h2>									
					</div>
					
					<h5>Please Rate our Product</h5>
					<div style="margin-bottom: 0.1em;">
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star"></i>
					</div>
			<textarea placeholder = "Enter Message..."></textarea>		
			
			
					
						

      </div>
	  <!--CONTENT END-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button>Submit</button>
      </div>
    </div>
  </div>
</div>
</div>

       <h2>JUST SOME SPACE</h2>
       <h2>JUST SOME SPACE</h2> 
       <h2>JUST SOME SPACE</h2>                              
       <h2>JUST SOME SPACE</h2> 
       <h2>JUST SOME SPACE</h2> 
       <h2>JUST SOME SPACE</h2> 
</div>
<!-- /.container-fluid ----------------------------------------------------------------------------------------------->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
.productpic{
	display: block; 
	float: left;
	margin: 0.75em 0.75em 0 0.75em; 
	border-radius: 50%; 
	width: 5rem; 
	height: 5rem;
}

.divcontent{
	font-size: 0.85rem; 
	max-height: 5rem; 
	min-height: 5rem; 
	overflow: hidden; 
	margin-top: 0.5 rem;
}
.namestar{
	min-height: 6rem;
	padding: auto;
	position: relative;
	
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