<?php
    require __DIR__ . '/header.php'
?>

<?php
$product = "P000001";
//$_SESSION['product_ID']
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['pid']) && !empty($_POST['pid'])  ){
	
	
	$selectedPID = SanitizeString($_POST['pid']);
		$sql = "SELECT rr.rr_id, rr.product_id, rr.user_id, u.name, u.email, u.profile_picture, u.role, rr.message, rr.rating, rr.pic1, rr.pic2, rr.pic3, rr.pic4, rr.pic5, rr.status, rr.seller_id, rr.r_message 
			    FROM user u INNER JOIN  reviewRating rr 
			    ON  u.userID = rr.user_id 
			    WHERE rr.disable_date IS NULL && rr.product_id = '$product' && rr.rr_id = ? 
			    ORDER BY rr.rr_id";
		
		if($stmt = mysqli_prepare ($conn, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $selectedPID);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			
			if(mysqli_stmt_num_rows($stmt) == 1){
				mysqli_stmt_bind_result($stmt, $c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12,$c13,$c14,$c15,$c16,$c17);
				mysqli_stmt_fetch($stmt);
			}
			
			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
		
		}	
			
}	


?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<!-- Begin Page Content --------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">	

    <i class="fa fa-star-fill"></i>
	<i class="bi bi-star-fill tqy"></i>
	<i class="bi bi-star-fill tqy"></i>
    
  
 
   


	
<!-- Button trigger modal 
<button type="button" class="hyperlink" data-toggle="modal" data-target="#exampleModalLong" value= "RR001">
  Modal 1
</button>

<button type="button" class="hyperlink" data-toggle="modal" data-target="#exampleModalLong" value= "RR002">
  Modal 2
</button>-->

<!-- Modal -->
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
  
  
<!--------------------------Rating PICK PICK---------------------------->	
<div id = "pickpickrating">
	<div class="row pickbox">
	  <div class="col-5" style = "background-color:;">
		<div>
			<p style = "font-size: 2rem; text-align: center; margin-bottom: 0;"><strong style = "font-size: 3.5rem; font-weight: 600;">
			
			<?php			
			$sql ="SELECT avg(rr.rating)
			    FROM user u INNER JOIN  reviewRating rr 
			    ON  u.userID = rr.user_id 
			    WHERE rr.disable_date IS NULL && rr.product_id = '$product'
			    ORDER BY rr.rr_id";
			if($stmt = mysqli_prepare ($conn, $sql)){
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $x1);
				
				while(mysqli_stmt_fetch($stmt)){
					$avgrat = round($x1, 1);
					echo"$avgrat";
				}
				mysqli_stmt_close($stmt);
			}
			
			?>
			
			
			</strong> out of 5.0</p>
			<div style="margin-bottom: 0.1em; text-align: center;">	

			<?php
				$calavgrat = $avgrat;
				$check = true;
				  for($i = 0; $i<5; $i++){
					if(round($calavgrat) && $check == true){
					  echo '<i class="bi bi-star-fill tqy"></i>';
					  $calavgrat -= 1;
					}else{
					   if ($calavgrat >= 0 && $calavgrat < 0.5 ){
						echo '<i class="bi bi-star-half tqy"></i>';
					  }
					  else{
						echo '<i class="bi bi-star tqy"></i>';
					  }
					  $check = false;
					  $calavgrat -= 1;
					}

				  }
			?>			
			</div>	
		</div>	  
	  </div>
	  <div class="col-7" style = "background-color:;">  
		  <div class="container" style = "margin-top: 2.2rem;">
				<div class="row">
					<div class="col">
						  <select class="form-control" id = "selectStar">
							  <option value = "All">All* (107)</option>
							  <option value = "5">5 Star</option>
							  <option value = "4">4 Star</option>
							  <option value = "3">3 Star</option>	
							  <option value = "2">2 Star</option>
							  <option value = "1">1 Star</option>			  
						  </select>
					</div>
					<div class="col">						
						 <select class="form-control" id = "selectCM">
							  <option value = "All">With Comment & Media*</option>
							  <option value = "1">With Comment Only</option>							  
						</select>		
					</div>
				</div>
			</div>
	  </div>
	</div>



</div>				
<!-------------------------------------------------------------------> 
				<!-- List All Product -->
				<div class="card-body">
					<div>
						<h2 style ="text-align:center">Review</h2>
					</div>
						<div class="row">
							<!-- Card Body -->
							<div class="card-body">
								<div class="row" style = "background-color: lightblue;" id = "displaySearch">
									
								</div>
							</div>  
						</div>
					</div>
				<br>                                
                <br>
	
	

	

		
		
</div>
<!-- /.container-fluid ----------------------------------------------------------------------------------------------->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

#sellresponse{
	background-color: #DCDCDC; 
	padding: 0.2rem; 
	border-radius: 4px; 
}
.pickbox{
	width: 100%;
	margin: 0 auto;
	height: 100%;
	background-color: rgba(86,61,124,.15);
    border: 1px solid rgba(86,61,124,.2);
	align-content: center;
}
#pickpickrating{
    background-color: white;
	height: 100%;
	width: 100%;
}
.modal-footer{
	border-top: none;
}
.hyperlink:hover{
	cursor: pointer;
	color: #A31F37;
}
.hyperlink{
	float: right;
	color: #858796;
	border: none;
	background-color: transparent;
	
}
.divcontent{
	font-size: 0.85rem; 
	max-height: 5rem; 
	min-height: 5rem; 
	overflow: hidden; 
	margin-top: 0.5 rem;
}
.divpink{
	padding-bottom: .625rem; 
	
	padding-top: .625rem;
}
.namestar{
	min-height: 6rem;
	padding: auto;
	position: relative;
	
}
.reviewprofilepic{
	display: block; 
	float: left;
	margin: 0.75em 0.75em 0 0.75em; 
	border-radius: 50%; 
	width: 5rem; 
	height: 5rem;
}
.tqy{
	font-size: 1.2rem;
}
.atss{
	max-width: 25rem;
	max-height: 25rem;
    margin: 0 auto;
}
.bi-star-half{
	-webkit-text-fill-color: orange;
}
.bi.bi-star-fill{
	-webkit-text-fill-color: orange;
}
.imgReply{
	width: 2.3rem;
	height: 2.3rem;
	object-fit: cover;
}
.pp{
	width: 100%;
	border: 1px solid purple;
}
.ppparent{
	
	display: flex;
	flex-wrap: wrap;
}
.ppparent > div {
	flex:50%;
	box-shadow: 0 0 0 1px black;
	margin-bottom: 10px
}
</style>
<script>
/**/
<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['pid']) && !empty($_POST['pid'])  ){
			$showmedawae = "#exampleModalLong";
								 						
		}else{
			$showmedawae = "";
		}
		
?>
        $('<?php echo $showmedawae; ?>').modal('show');
   


$(document).ready(function(){

	
	load_data_display();
	load_data();
 
 function load_data_display(restriction,restriction2)
 {
  $.ajax({
   url:"reviewRatingSearch.php",
   method:"POST",
   data:{restriction:restriction,
		 restriction2:restriction2},
   success:function(data)
   {
	   //alert('success noob')
		$('#displaySearch').html(data);
		
   }
   
  });
 }
 
 function load_data(query) 
	{
		$.ajax({
		   url:"reviewRatingModal.php",
		   method:"POST",
		   data:{query:query},
		   success:function(data)
		   {
			   //alert('success noob')
			$('#modalResult').html(data);
			
		   }
		  });
		  
	}
 
 $('#selectStar').change(function(){
  var restriction = $(this).val();
  var restriction2 = $('#selectCM').val();
  
   load_data_display(restriction, restriction2);
 
 });
 
 $('#selectCM').change(function(){
  var restriction = $('#selectStar').val();
  var restriction2 = $(this).val();
  
   load_data_display(restriction,restriction2);
	
 
 });
 
  $('.hyperlink').click(function(){
  var click = $(this).val();
  //console.log(click)
  load_data(click);
  
  
 });
 
 

});

</script>


<!-- Slideshow 
                    <div class="w3-display-middle" style="width:100%">
                            <div id="carouselExampleIndicators" class="carousel slide atss" data-ride="carousel" >
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                </ol>
                                <div class="carousel-inner">
								
                                    <?php
									/*
                                    $sql = "SELECT * FROM facilityPic";
                                    $result = mysqli_query($conn, $sql);
                                    $i = false;
                        
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            if ($i){

                                            echo ("
                                                <div class=\"carousel-item\">
                                                <img class=\"d-block w-100\" src=\"".$row["pic_Facility"]."\" alt=\"".$row["title"]."\">
                                                </div>         
                                            ");
                                            }
                                            else{
                                                echo ("
                                                <div class=\"carousel-item active\">
                                                <img class=\"d-block w-100\" src=\"".$row["pic_Facility"]."\" alt=\"".$row["title"]."\">
                                                </div>
                                                            
                                                ");
                                                $i = true;
                                            }
                                        }
                                    }
									*/
                                    ?>
									<div class="carousel-item active">
                                            <img class="d-block w-100" src="https://media.juiceonline.com/2021/09/good-meme.jpg" >
                                    </div> 
									<div class="carousel-item">
                                            <img class="d-block w-100" src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" >
                                    </div> 
									<div class="carousel-item>
                                            <img class="d-block w-100" src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" >
                                    </div> 
									<div class="carousel-item">
                                            <img class="d-block w-100" src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" >
                                    </div>
									<div class="carousel-item">
                                            <img class="d-block w-100" src="https://images.newindianexpress.com/uploads/user/imagelibrary/2021/9/11/w1200X800/Memes_to.jpg" >
                                    </div>									
                    
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
                        </div>-->




<!----------------------------------------------------------------------------------------------------------------->
<!--REVIEW START BOX 1 
									<div class="col-xl-3 col-lg-4 col-sm-6 divpink">
										
										<div style="height: 100%">
												
												<img src = "https://pbs.twimg.com/profile_images/1452244355062829065/jUmYXUCM_400x400.jpg" class = "reviewprofilepic">
												<div class = "namestar">
													<h6 style = "font-size: 1rem; padding-top: 1rem; margin-bottom: 0px;">Rakan & Xayah</h6>
													<div style="margin-bottom: 0.1em;">													
														<i class="bi bi-star-fill"></i>
														<i class="bi bi-star-fill"></i>
														<i class="bi bi-star-fill"></i>
														<i class="bi bi-star"></i>
														<i class="bi bi-star"></i>
													</div>	
												</div>
									
									
										<h6 class = "divcontent">Rakan and Xayah are Vastaya bird-people with different roles. Xayah the Rebel carries the blade in the relationship. She is an AD carry assassin that enables her to shoot sharp feather-like blades with deadly grace and precision. Rakan the Charmer goes to battle to support his lover.
										</h6>
																				
										<table style = "margin-bottom: 0.3rem;">
											<tr>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
											<tr>
										</table>
										
										
										<button class="hyperlink" data-toggle="modal" data-target="#exampleModalLong" value= "RR001">see more...</button>
										</div>   
										
									</div>
									
									<div class="col-xl-3 col-lg-4 col-sm-6 divpink">
										
										<div style="height: 100%">
												
												<img src = "https://cdn1.dotesports.com/wp-content/uploads/2019/10/08064645/image-7.png" class = "reviewprofilepic">

												<div class = "namestar">
													<h6 style = "font-size: 1rem; padding-top: 1rem; margin-bottom: 0px;">Peanut Butter Jelly Jam</h6>
													<div style="margin-bottom: 0.1em;">													
														<i class="bi bi-star-fill"></i>
														<i class="bi bi-star-fill"></i>
														<i class="bi bi-star-fill"></i>
														<i class="bi bi-star"></i>
														<i class="bi bi-star"></i>
													</div>	
												</div>
									
									
										<h6 class = "divcontent">The land now known as the Shadow Isles was once a beautiful realm, but it was shattered by a magical cataclysm. Black Mist permanently shrouds the isles and the land itself is tainted, corrupted by malevolent sorcery. Living beings that stand upon the Shadow Isles slowly have their life-force leeched from them, which, in turn, draws the insatiable, predatory spirits of the dead. Those who perish within the Black Mist are condemned to haunt this melancholy land for eternity. Worse, the power of the Shadow Isles is waxing stronger with every passing year, allowing the shades of undeath to extend their range and reap souls all across Runeterra.
										</h6>
																				
										<table style = "margin-bottom: 0.3rem;">
											<tr>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
											<tr>
										</table>
										
										
										<button class="hyperlink" data-toggle="modal" data-target="#exampleModalLong" value= "RR002">see more...</button>
										</div>   
										
									</div>
								--------------->





























