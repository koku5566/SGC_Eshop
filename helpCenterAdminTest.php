<?php
    require __DIR__ . '/header.php'
?>

<?php

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



<!-- Begin Page Content --------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">		

<!-- Slideshow -->
                    <div class="w3-display-middle" style="width:100%">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
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
									<div class="carousel-item">
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
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem; background-color: pink; padding-top: .625rem;">
                                            
                                                <div style="background-color: red; height: 100%">
                                                    <h6 style = "font-size: 1rem; margin-bottom: 0.1rem;">Amanda Teh Sue Shun</h6>
													<div style="margin-bottom: 0.1em;">													
														<i class="bi bi-star-fill"></i>
														<i class="bi bi-star-fill"></i>
														<i class="bi bi-star-fill"></i>
														<i class="bi bi-star"></i>
														<i class="bi bi-star"></i>
													</div>	
										
										
										<h6 style = "font-size: 0.85rem">The first time i met u was back in 2016, that was the first time. Yup from the weekly meeting. Of course from then on i'm usually present on time of the meeting DEFENITELY not because of u.And OBVIOUSLY i'm listening to the meeting content rather than looking at you. THEN 2016 flag day i i i i i ... am defenitely NOT LOOKING at u whole day :). Ok thinking about it kinda cringe lmao.
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
                                            <a data-sqe="link" href="penangfacility.php?id=a">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body-text">
                                                        <div class="Name">
                                                            <p class="card-text campus-name">PENANG</p>
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



</script>