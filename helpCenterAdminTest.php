<?php
    require __DIR__ . '/header.php'
?>

<?php

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<!-- Begin Page Content --------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">	

	
<!-- Button trigger modal 
<button type="button" class="hyperlink" data-toggle="modal" data-target="#exampleModalLong" value= "RR001">
  Modal 1
</button>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" value= "RR002">
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
        <div style="height: 100%">
					<?php
					
					
					?>
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
			
			<div id = "sellresponse">
				<h6 style=" font-size: 0.9rem;margin-bottom: 0px; color: #0000ff;">Seller Response:</h6>	
				<h6 style = "font-size: 0.8rem">Seller talk u diam diam listen enuf. if not mak kau hijau.
				</h6>		
			</div>			
					
		
		
				
			
						<!---->
						<div class="w3-display-middle" style="width:100%; margin-top: 0.5rem;">
                            <div id="carouselExampleIndicators" class="carousel slide atss" data-ride="carousel" >
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                </ol>
                                <div class="carousel-inner tqy">
								
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
			<p style = "font-size: 2rem; text-align: center; margin-bottom: 0;"><strong style = "font-size: 3.5rem; font-weight: 600;">4.9</strong> out of 5.0</p>
			<div style="margin-bottom: 0.1em; text-align: center;">													
				<i class="bi bi-star-fill tqy"></i>
				<i class="bi bi-star-fill tqy"></i>
				<i class="bi bi-star-fill tqy"></i>
				<i class="bi bi-star tqy"></i>
				<i class="bi bi-star tqy"></i>
			</div>	
		</div>	  
	  </div>
	  <div class="col-7" style = "background-color:;">
		  
		  
		  <div class="container" style = "margin-top: 2.2rem;">
				<div class="row">
					<div class="col">
						  <select class="form-control" id = "selectRating">
							  <option value = "All">All* (107)</option>
							  <option value = "P000005">5 Star</option>
							  <option value = "P000004">4 Star</option>
							  <option value = "P000003">3 Star</option>	
							  <option value = "P000002">2 Star</option>
							  <option value = "P000001">1 Star</option>			  
						  </select>
					</div>
					<div class="col">						
						 <select class="form-control" id = "selectStar">
							  <option value = "All">With Comment & Media*</option>
							  <option value = "1">With Comment Only</option>
							  <option value = "2">With Media Only</option>							  
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
								<div class="row" style = "background-color: lightblue;">
									<!--REVIEW START BOX 1 --------------->
									<div class="col-xl-3 col-lg-4 col-sm-6 divpink">
										<!--Content Start-->
										<div style="height: 100%">
												<?php
												
												
												?>
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
										
										<!--
											<input type = 'hidden' name = 'CUid' value = 'RR001'>
											<input type = "submit" class="hyperlink" data-toggle="modal" data-target="#exampleModalCenter" value= "see more...">
										-->
										<button class="hyperlink" data-toggle="modal" data-target="#exampleModalLong" value= "RR001">see more...</button>
										</div>   
										<!--Content End-->
									</div>
									<!--REVIEW END BOX --------------->
									<!--REVIEW START BOX 2 --------------->
									<div class="col-xl-3 col-lg-4 col-sm-6 divpink">
										<!--Content Start-->
										<div style="height: 100%">
												<?php
												
												
												?>
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
										
										<!--
											<input type = 'hidden' name = 'CUid' value = 'RR001'>
											<input type = "submit" class="hyperlink" data-toggle="modal" data-target="#exampleModalCenter" value= "see more...">
										-->
										<button class="hyperlink" data-toggle="modal" data-target="#exampleModalLong" value= "RR002">see more...</button>
										</div>   
										<!--Content End-->
									</div>
									<!--REVIEW 2 END--------------->
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
.bi.bi-star-fill{
	-webkit-text-fill-color: orange
}
.imgReply{
	width: 75%;
	height: 75%;
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


$('.hyperlink').click(function(){
  var click = $(this).val();
  
  console.log(click);
 });

/*
$(document).ready(function(){

	load_data();

 function load_data(query, restriction, restriction2)
 {
  $.ajax({
   url:"reviewSearchSeller.php",
   method:"POST",
   data:{query:query,
		restriction:restriction,
		restriction2:restriction2},
   success:function(data)
   {
	   //alert('success noob')
    $('#result').html(data);
	
   }
  });
 }

$('#search_text').keyup(function(){
  var search = $(this).val();
  var restriction = $('#selectStar').val();
   var restriction2 = $('#selectSeller').val();
  if(search != '')
  {
	load_data(search,restriction,restriction2);	  
  }
  else
  {
   load_data();
  }
 });

 //Rating Star
 $('#selectStar').change(function(){
  var restriction = $(this).val();
  var restriction2 = $('#selectSeller').val();
  if(restriction != 'All')
  {
   load_data("", restriction, restriction2);
 
  }
  else
  {
   load_data("","", restriction2);
  }
 });
 //Seller
 $('#selectSeller').change(function(){
  var restriction = $('#selectStar').val();
  var restriction2 = $(this).val();
  
  if(restriction2 != 'All')
  {
   load_data("", restriction,restriction2);
	//alert(restriction2);
  }
  else
  {
   load_data("",restriction, "");
  }
 });
 

});

//FOR ADD REPLY
var modalReply = document.getElementById("myModalReply");
//var btnAddReply = document.getElementById("CUbtnreply");
var spanReply = document.getElementsByClassName("closeM")[0];


spanReply.onclick = function() {
  modalReply.style.display = "none";
  
}
window.onclick = function(event) {
  if (event.target == modalReply) {
     modalReply.style.display = "none";
  }
	  
}






$(".alert.alert-success").delay(2000).slideUp(200, function() {
    $(this).alert('close');
});
$(".alert.alert-danger").delay(3000).slideUp(200, function() {
    $(this).alert('close');
});


*/
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



































