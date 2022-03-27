<?php
    require __DIR__ . '/header.php'
?>

<?php

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



<!-- Begin Page Content --------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">	

	
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary nami" data-toggle="modal" data-target="#exampleModalCenter" value= "RR001">
  Modal 1
</button>

<button type="button" class="btn btn-primary nami" data-toggle="modal" data-target="#exampleModalCenter" value= "RR002">
  Modal 2
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


  
  


<!-- Slideshow -->
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
                        </div>
<!------------------------------------------------------------------->	

 
                    <!-- List All Product -->
                    <div class="card-body">
                                <div>
                                    <h5 style ="text-align:center">CHOOSE A CAMPUS</h5>
                                </div>
                    <div class="row">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row" style = "background-color: lightblue;">
										<!--REVIEW START BOX 1-->
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem; background-color: pink; padding-top: .625rem;">
                                            
                                                <div style="background-color: red; height: 100%">
													<img src = "https://pbs.twimg.com/profile_images/1452244355062829065/jUmYXUCM_400x400.jpg" class = "reviewprofilepic">
													<div class = "namestar">
														<h6 style = "font-size: 1rem; padding-top: 0.75rem;">Amanda Teh Sue Shun</h6>
														<div style="margin-bottom: 0.1em;">													
															<i class="bi bi-star-fill"></i>
															<i class="bi bi-star-fill"></i>
															<i class="bi bi-star-fill"></i>
															<i class="bi bi-star"></i>
															<i class="bi bi-star"></i>
														</div>	
													</div>
										
										
										<h6 style = "font-size: 0.85rem; max-height: 5rem; overflow: hidden">The first time i met u was back in 2016, that was the first time. Yup from the weekly meeting. Of course from then on i'm usually present on time of the meeting DEFENITELY not because of u.And OBVIOUSLY i'm listening to the meeting content rather than looking at you. THEN 2016 flag day i i i i i ... am defenitely NOT LOOKING at u whole day :). Ok thinking about it kinda cringe lmao.
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
                                                </div>   
                                            
                                        </div>
										<!--REVIEW START BOX 2-->
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem; background-color: pink; padding-top: .625rem;">
                                            
                                                <div style="background-color: red; height: 100%">
													<img src = "https://pbs.twimg.com/profile_images/1452244355062829065/jUmYXUCM_400x400.jpg" class = "reviewprofilepic">
													<div class = "namestar">
														<h6 style = "font-size: 1rem; padding-top: 0.75rem;">Cheong Kit Min</h6>
														<div style="margin-bottom: 0.1em;">													
															<i class="bi bi-star-fill"></i>
															<i class="bi bi-star-fill"></i>
															<i class="bi bi-star-fill"></i>
															<i class="bi bi-star"></i>
															<i class="bi bi-star"></i>
														</div>	
													</div>
										
										
										<h6 style = "font-size: 0.85rem; max-height: 5rem; overflow: hidden">Im pro jkjk
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
                                                </div>   
                                            
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body-text">
                                                        <div class="Name">
                                                            <p class="card-text campus-name">SARAWAK</p>
                                                        </div>                                                                                                              
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body-text">
                                                        <div class="Name">
                                                            <p class="card-text campus-name">KUALA LUMPUR</p>
                                                        </div>                                                                                                          
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
										<div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body-text">
                                                        <div class="Name">
                                                            <p class="card-text campus-name">SUBANG JAYA</p>
                                                        </div>            
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    <br>
                   
                  
                   
                <br>
	
	
	<!--
	<div class="d-flex flex-row ppparent">
	  <div class="p-2 pp">Flex item 1</div>
	  <div class="p-2 pp">Flex item 2</div>
	  <div class="p-2 pp">Flex item 3</div>
	  <div class="p-2 pp">Flex item 4</div>
	  <div class="p-2 pp">Flex item 5</div>
	</div>
	-->
	

		
		
</div>
<!-- /.container-fluid ----------------------------------------------------------------------------------------------->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
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
var nami1 = document.getElementsByClassName("nami")[0];
var nami2 = document.getElementsByClassName("nami")[1];
nami1.onclick = function() {
  console.log(nami1.value);
}
nami2.onclick = function() {
  console.log(nami2.value);
}



</script>





































