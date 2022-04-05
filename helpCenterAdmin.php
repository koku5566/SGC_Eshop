<?php
	require __DIR__ . '/header.php'	
?>



<?php
	
   
?>


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
        
      </div>
	  <!--CONTENT START-->
      <div class="modal-body">
		<!--DISPLAY HERE
		<div id = "modalResult" style = "height: 100%"></div>
		-->
        <div style="height: 100%">
					
					<img src = "https://pbs.twimg.com/profile_images/1452244355062829065/jUmYXUCM_400x400.jpg" class = "reviewprofilepic">
					<div class = "namestar">
						<h6 style = "font-size: 1rem; padding-top: 1rem; margin-bottom: 0px;"><?php echo (isset($c4) && !empty ($c4))? $c4 : ''; ?></h6>
						<div style="margin-bottom: 0.1em;">	
							<?php
								for($i=0; $i<5; $i++){
									if(isset($c9) && !empty ($c9)){
										if($i < $c9){
											 echo '<i class="bi bi-star-fill"></i> ';
										 }else{
											 echo '<i class="bi bi-star"></i> ';
										 }
									}else{
										echo '';
									}								 
							 }							
							?>							
						</div>	
					</div>
			<h6 class = "divcontent" style = "max-height: none;"><?php echo (isset($c8) && !empty ($c8))? $c8 : ''; ?>
			</h6>		
			
			<?php
				if(isset($c17) && !empty ($c17)){
					echo '<div id = "sellresponse">
							<h6 style=" font-size: 0.9rem;margin-bottom: 0px; color: #0000ff;">Seller Response:</h6>	
							<h6 style = "font-size: 0.8rem"> "'.$c17.'"</h6>
						  </div>';		
				}else{echo "";}		  
			?>
					
						<!---->
						<div class="w3-display-middle" style="width:100%; margin-top: 0.5rem;">
                            <div id="carouselExampleIndicators" class="carousel slide atss" data-ride="carousel" >
                                <ol class="carousel-indicators">
									<?php
										if(isset($c1) && !empty ($c1)){		
											
											if($c10 === null){echo '';}
												else{echo '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';} 													 
												
											if($c11 === null){echo '';}
												else{echo '<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>';}	
												
											if($c12 === null){echo '';}
												else{echo '<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>';}	
												
											if($c13 === null){echo '';}
												else{echo '<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>';}	
												
											if($c14 === null){echo '';}
												else{echo '<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>';}											 
										}else{
											echo '';
										}

									?>									
                                </ol>
                                <div class="carousel-inner tqy">
									<?php
									
										if(isset($c1) && !empty ($c1)){			
											
											if( $c10 === null){echo '';}
												else{echo '<div class="carousel-item active">
																<img class="d-block w-100" src="https://media.juiceonline.com/2021/09/good-meme.jpg" >
														  </div> ';} 													 
												
											if( $c11 === null){echo '';}
												else{echo '<div class="carousel-item">
																 <img class="d-block w-100" src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" >
														  </div>';}
											if( $c12 === null){echo '';}
												else{echo '<div class="carousel-item">
																 <img class="d-block w-100" src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" >
														  </div>';}	
											if( $c13 === null){echo '';}
												else{echo '<div class="carousel-item">
																 <img class="d-block w-100" src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" >
														  </div>';}		
											if( $c14 === null){echo '';}
												else{echo '<div class="carousel-item">
																 <img class="d-block w-100" src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" >
														  </div>';}										
																		
		 								}else{
											echo '';
										}			 
	
									?>
									
                                </div>
                                <a class="carousel-control-prev" style="z-index:0;" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" style="z-index:0;" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
						<!---->

      </div>
	  <!--CONTENT END-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


</style>
<script>

	

$(".alert.alert-success").delay(2000).slideUp(200, function() {
    $(this).alert('close');
});
$(".alert.alert-danger").delay(3000).slideUp(200, function() {
    $(this).alert('close');
});

</script>