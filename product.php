<?php
    require __DIR__ . '/header.php';
	require __DIR__ .'/PHP_product.php';
?>
<?php
    $_SESSION['productID'] = $_GET['id'];
?>
<?php
	//Fetch each product information
	$id = $_SESSION['productID'];
	$sql_product = "SELECT A.product_id, A.product_name, A.product_description, A.product_brand, A.product_cover_video,
	A.product_cover_picture, A.product_pic_1, A.product_pic_2, A.product_pic_3, A.product_pic_4, 
	A.product_pic_5, A.product_pic_6, A.product_pic_7, A.product_pic_8, A.product_virtual, 
	A.product_variation,A.product_price,A.product_stock,A.product_sold, A.category_id, A.shop_id, 
	C.max_price,D.min_price,F.total_stock, R.rating FROM `product` AS A 
	LEFT JOIN variation AS B ON A.product_id = B.product_id 
	LEFT JOIN (SELECT product_id,product_price AS max_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price DESC LIMIT 1) AS C ON A.product_id = C.product_id 
	LEFT JOIN (SELECT product_id,product_price AS min_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price ASC LIMIT 1) AS D ON A.product_id = D.product_id 
	LEFT JOIN (SELECT product_id, SUM(product_stock) AS total_stock FROM `variation` WHERE product_id = '$id' GROUP BY product_id) AS F ON A.product_id = F.product_id
	LEFT JOIN (SELECT avg(rr.rating) AS rating, rr.product_id FROM user u INNER JOIN  reviewRating rr ON  u.userID = rr.user_id WHERE rr.disable_date IS NULL AND rr.product_id = '$id') AS R ON A.product_id = R.product_id 
	WHERE A.product_id = '$id'
	LIMIT 1";
	$result_product = mysqli_query($conn, $sql_product);

	if (mysqli_num_rows($result_product) > 0) {
		while($row_product = mysqli_fetch_assoc($result_product)) {
			$i_product_id = $row_product['product_id'];
			$i_product_name = $row_product['product_name'];
			$i_product_description = $row_product['product_description'];
			$i_product_brand = $row_product['product_brand'];
			$i_product_cover_video = $row_product['product_cover_video'];
			$i_product_pic = array($row_product['product_cover_picture']);
			array_push($i_product_pic,$row_product['product_pic_1'],$row_product['product_pic_2']);
			array_push($i_product_pic,$row_product['product_pic_3'],$row_product['product_pic_4']);
			array_push($i_product_pic,$row_product['product_pic_5'],$row_product['product_pic_6']);
			array_push($i_product_pic,$row_product['product_pic_7'],$row_product['product_pic_8']);

			$i_product_virtual = $row_product['product_virtual'];
			$i_product_variation = $row_product['product_variation'];
			$i_product_price = $row_product['product_price'];
			$i_product_stock = $row_product['product_stock'];
			$i_product_sold = $row_product['product_sold'];
			$i_category_id = $row_product['category_id'];
			$i_shop_id = $row_product['shop_id'];
			$_SESSION['shopId'] = $i_shop_id;

			$i_max_price = $row_product['max_price'];
			$i_min_price = $row_product['min_price'];
			$i_total_stock = $row_product['total_stock'];
			$i_rating = $row_product['rating'];
		}
	}
?>
<?php
	//Cheong Kit Min - Review & Rating PHP ----------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['pid']) && !empty($_POST['pid'])  ){
		$selectedPID = SanitizeString($_POST['pid']);
			$sql = "SELECT rr.rr_id, rr.product_id, rr.user_id, u.name, u.email, u.profile_picture, u.role, rr.message, rr.rating, rr.pic1, rr.pic2, rr.pic3, rr.pic4, rr.pic5, rr.status, rr.seller_id, rr.r_message 
					FROM user u INNER JOIN  reviewRating rr 
					ON  u.userID = rr.user_id 
					WHERE rr.disable_date IS NULL && rr.product_id = '$i_product_id' && rr.rr_id = ? 
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
	//Cheong Kit Min - End of Review & Rating PHP ----------------------------------------------------------------------------------
?>
<!--Cheong Kit Min - Review & Rating PHP ---------------------------------------------------------------------------------->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!--Cheong Kit Min - End of Review & Rating PHP ---------------------------------------------------------------------------------->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">

					<!-- Breadcumb navigation -->
					<div class="row" style="display: block;">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<?php 
									$productId = $_SESSION['productID'];
									//Display Current Directory
									$sql = "SELECT B.category_id AS mainCategoryId, B.category_name AS mainCategory, A.sub_Yes, C.category_id AS subCategoryId, C.category_name AS subCategory FROM `categoryCombination` AS A 
									LEFT JOIN  category AS B ON A.main_category = B.category_id
									LEFT JOIN  category AS C ON A.sub_category = C.category_id
									WHERE combination_id = '$i_category_id'
									";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
										while($row = mysqli_fetch_assoc($result)) {
											$mainCategoryId = $row["mainCategoryId"];
											$mainCategoryName = $row["mainCategory"];
											$subYes = $row["sub_Yes"];
											$subCategoryId = $row["subCategoryId"];
											$subCategoryName = $row["subCategory"];
											
											//If no sub category, display as normal
											echo("<li class=\"breadcrumb-item\"><a href=\"index.php\">Home</a></li>");
											echo("<li class=\"breadcrumb-item\"><a href=\"category.php?mainCategory={$mainCategoryId}\">$mainCategoryName</a></li>");
											if($subYes == 1)
											{
												echo("<li class=\"breadcrumb-item\"><a href=\"category.php?mainCategory={$mainCategoryId}&subCategory={$subCategoryId}\">$subCategoryName</a></li>");
											}
											
											echo("<li class=\"breadcrumb-item active\"><a disabled>$i_product_name</a></li>");
										}
									}   
								?>
							</ol>
						</nav>
					</div>

                    <!-- Product Row -->
                    <div class="row mb-3" style="background-color:white;">
                        <!-- Picture -->
                        <div class="col-xl-5 col-md-6 mb-6">
							<div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                                <!-- slides -->
                                <div class="carousel-inner">
									<?php
										for($i = 0; $i < count($i_product_pic); $i++)
										{
											if($i_product_pic[$i] != "")
											{
												$picName = "/img/product/".$i_product_pic[$i];
												if($i == 0)
												{
													echo("<div class=\"carousel-item active\"> <img src=\"$picName\" alt=\"$i_product_name\"> </div>");
												}
												else
												{
													echo("<div class=\"carousel-item\"> <img src=\"$picName\" alt=\"$i_product_name\"> </div>");
												}
											}
										}

									?>
                                </div> <!-- Left right --> <a class="carousel-control-prev" href="#custCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#custCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> <!-- Thumbnails -->
                                <ol class="carousel-indicators list-inline" style="height:60px;">
									<?php
										$j = 0;
										for($i = 0; $i < count($i_product_pic); $i++)
										{
											if($i_product_pic[$i] != "")
											{
												$picName = "/img/product/".$i_product_pic[$i];
												if($i == 0)
												{
													echo("<li class=\"list-inline-item active\"> <a id=\"carousel-selector-0\" class=\"selected\" data-slide-to=\"$j\" data-target=\"#custCarousel\"> <img src=\"$picName\" class=\"img-fluid\"> </a> </li>");
												}
												else
												{
													echo("<li class=\"list-inline-item\"> <a id=\"carousel-selector-1\" data-slide-to=\"$j\" data-target=\"#custCarousel\"> <img src=\"$picName\" class=\"img-fluid\"> </a> </li>");
												}
												$j++;
											}
										}

									?>
                                </ol>
                            </div>
                        </div>

                        <!-- Product Content -->
                        <div class="col-xl-7 col-md-6 mb-6">
                            <br>
                            <!-- Name -->
                            <div class="row">
                                <div class="col">
                                    <h1 style="color:#a31f37;"><?php echo($i_product_name) ?></h1>
                                    <hr>
                                </div>
                            </div>
                            <!-- Rating/Rating Number/Sold -->
                            <div class="row">
                                <div class="col">
                                    <b><?php echo($i_rating == "" ? "No Rating Yet" :  $i_rating." Rating"); ?></b>
                                </div>
                                <div class="col">
                                    <b><?php echo($i_rating == "" ? "No Rating Yet" :  $i_rating." Rated"); ?></b>
                                </div>
                                <div class="col">
                                    <b><?php echo($i_product_sold); ?> Sold</b>
                                </div>
                            </div>
                            <br>
                            <!-- Price -->
                            <div class="row mb-4" id="PriceDiv">
                                <div class="col">
                                    <span style="color:#a31f37;font-size:18pt;font-weight: bold;"><?php echo($i_product_variation == 0 ? "RM".$i_product_price :  "RM".$i_min_price." - RM".$i_max_price); ?></span>
                                </div>
                            </div>
                            <!-- Variation -->
							<?php
								if($i_product_variation == 1)
								{
									$sql_var = "SELECT DISTINCT(variation_1_choice), variation_1_name, product_stock FROM variation WHERE product_id = '$i_product_id'";
									$result_var = mysqli_query($conn, $sql_var);

									if (mysqli_num_rows($result_var) > 0) {
										$variation1Choice = array();
										$variation1Stock = array();
										while($row_var = mysqli_fetch_assoc($result_var)) {
											$variation1Name = $row_var['variation_1_name'];
											array_push($variation1Choice,$row_var['variation_1_choice']);
											array_push($variation1Stock,$row_var['product_stock']);
										}
									}

									$sql_var2 = "SELECT DISTINCT(variation_2_choice), variation_2_name, product_stock FROM variation WHERE product_id = '$i_product_id' AND variation_2_name != '' ";
									$result_var2 = mysqli_query($conn, $sql_var2);

									//If got 2 variation
									if (mysqli_num_rows($result_var2) > 0) {
										$variation2Choice = array();
										while($row_var2 = mysqli_fetch_assoc($result_var2)) {
											$variation2Name = $row_var2['variation_2_name'];
											array_push($variation2Choice,$row_var2['variation_2_choice']);
										}
										echo("
											<div class=\"row mb-3\">
												<div class=\"col-lg-3\">
													<b style=\"color:#a31f37;\">$variation1Name</b>
												</div>
												<div class=\"col-lg-9\">
													<div class=\"row\"\>
														<div class=\"col\">
												");
												$v_variation1ChoicesOnly = array_unique($variation1Choice);
												foreach ($v_variation1ChoicesOnly as $value)
												{
													echo("<button class=\"btn btn-outline-primary btnVariation1\" style=\"margin-right:10px;\">$value</button>");
												}
												echo("	
														</div>
													</div>
												</div>
											</div>
										");
										echo("
											<div class=\"row mb-3\">
												<div class=\"col-lg-3\">
													<b style=\"color:#a31f37;\">$variation2Name</b>
												</div>
												<div class=\"col-lg-9\">
													<div class=\"row\"\>
														<div class=\"col\">
												");
												$v_variation2ChoicesOnly = array_unique($variation2Choice);
												foreach ($v_variation2ChoicesOnly as $value)
												{
													echo("<button class=\"btn btn-outline-primary btnVariation2\" style=\"margin-right:10px;\">$value</button>");
												}
												echo("	
														</div>
													</div>
												</div>
											</div>
										");
									}
									//If only have 1 variation
									else
									{
										echo("
											<div class=\"row mb-3\">
												<div class=\"col-lg-3\">
													<b style=\"color:#a31f37;\">$variation1Name</b>
												</div>
												<div class=\"col-lg-9\">
													<div class=\"row\"\>
														<div class=\"col\">
												");
												$v_variation1ChoicesOnly = array_unique(array_combine($variation1Choice, $variation1Stock));
												foreach ($v_variation1ChoicesOnly as $choice => $stock)
												{
													if($stock == 0 || $stock == "0")
													{
														echo("<button class=\"btn btn-outline-primary btnVariation1\" style=\"margin-right:10px;\" disabled>$choice</button>");
													}
													else
													{
														echo("<button class=\"btn btn-outline-primary btnVariation1\" style=\"margin-right:10px;\">$choice</button>");
													}
												}
												echo("	
														</div>
													</div>
												</div>
											</div>
										");
									}
								}
							?>
                            <!-- Quantity -->
                            <div class="row" id="QuantityDiv">
                                <div class="col-xl-6 col-sm-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <button class="quantity-selector-btn" style="border-radius: 10px 0 0 10px;" onclick="this.parentNode.parentNode.querySelector('input[type=number]').stepDown(); RefreshValue(this);" name = "ChangeQuantity" type = "button"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input min="1" name="quantity[]" value="1" type="number" class="form-control quantity-input">
                                        <div class="input-group-append">
                                        <button class="quantity-selector-btn" style="border-radius: 0 10px 10px 0 ;" onclick="this.parentNode.parentNode.querySelector('input[type=number]').stepUp(); RefreshValue(this);" class="plus" name = "ChangeQuantity\" type = "button"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
								<div class="col-xl-6 col-sm-12" id="stockAvailable">
									<?php
										if($i_product_variation == 0)
										{
											echo("<span id=\"stockAmount\" style=\"color:#a31f37;font-size:10pt;\">$i_product_stock</span>");
											echo("<span style=\"color:#a31f37;font-size:10pt;\"> piece available</span>");
										}
									?>
								</div>
                            </div>
							
                            <!-- Button -->
                            <div class="row mb-5" style="margin-top: 100px;">
                                <div class="col">
									<button id="btnAddToCart" class="btn btn-primary" style="width:100%;">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shop Profile -->
					<div class="row mb-3 p-2" style="background-color:white;">
						<div class="col-xl-6 col-md-12">
							<div class="row">
								<?php 
									
									$sql_shop = "SELECT * FROM shopProfile WHERE shop_id = '$i_shop_id'";
									$result_shop = mysqli_query($conn, $sql_shop);

									if (mysqli_num_rows($result_shop) > 0) {
										while($row_shop = mysqli_fetch_assoc($result_shop)) {
											$shop_id = $row_shop['shop_id'];
											$shop_name = $row_shop['shop_name'];
										}

										echo("
										<div class=\"col-xl-3 col-md-4\" style=\"text-align: center;\">
											<img class=\"img-thumbnail\" style=\"min-height:10px; width: inherit;max-width: fit-content;\"src=\"data:image/jpeg;base64,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\">
										</div>
										<div class=\"col-xl-9 col-md-8 sidebar-brand-text\" style=\"font-size: 1.5rem;\">
											<b>$shop_name</b>
											<a href=\"shopDetails.php?id=$shop_id\" class=\"btn btn-primary\" style=\"width: inherit;position: absolute;bottom: 0;left: 0;\">
												<span class=\"text\">View Shop</span>
											</a>
										</div>
										");
									}
								
								?>
							</div>
						</div>
						<div class="col-xl-4 col-md-8">
							<div class="row">
								<div class="col list-parent"> 
									<i class="fa fa-star"></i>
									<span>4.5</span>
								</div>
								<div class="col list-parent"> 
									<i class="fa fa-gift"></i>
									<span>120</span>
								</div>
								<div class="col list-parent"> 
									<i class="fa fa-calendar"></i>
									<span>2021</span>
								</div>
							</div>
						</div>
					</div>

					<!-- Product Description -->
                    <div class="row mb-3" style="background-color:white;">
                        <div class="col">
							
                        </div>
                    </div>

                    <!--CHEONG KIT MIN - Review & Rating Section-------------------------------------------------------------------------------->
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
																	 echo '<i class="fa fa-star tqy"></i> ';
																 }else{
																	 echo '<i class="fa fa-star ratingStar" style = "color: transparent;"></i> ';
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
																	
																	if($c10 === null || $c10 == ''){echo '';}
																		else{echo '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';} 													 
																		
																	if($c11 === null || $c11 == ''){echo '';}
																		else{echo '<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>';}	
																		
																	if($c12 === null || $c12 == ''){echo '';}
																		else{echo '<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>';}	
																		
																	if($c13 === null || $c13 == ''){echo '';}
																		else{echo '<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>';}	
																		
																	if($c14 === null || $c14 == ''){echo '';}
																		else{echo '<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>';}											 
																}else{
																	echo '';
																}

															?>									
														</ol>
														<div class="carousel-inner tqy">
															<?php
															
																if(isset($c1) && !empty ($c1)){			
																	
																if( $c10 === null || $c10 == ''){echo '';}
																		else{echo '<div class="carousel-item active">
																						<img class="d-block w-100" src="'.$c10.'" >
																				  </div> ';} 													 
																		
																	if( $c11 === null || $c11 == ''){echo '';}
																		else{echo '<div class="carousel-item">
																						 <img class="d-block w-100" src="'.$c11.'" >
																				  </div>';}
																	if( $c12 === null || $c12 == ''){echo '';}
																		else{echo '<div class="carousel-item">
																						 <img class="d-block w-100" src="'.$c12.'" >
																				  </div>';}	
																	if( $c13 === null || $c13 == ''){echo '';}
																		else{echo '<div class="carousel-item">
																						 <img class="d-block w-100" src="'.$c13.'" >
																				  </div>';}		
																	if( $c14 === null || $c14 == ''){echo '';}
																		else{echo '<div class="carousel-item">
																						 <img class="d-block w-100" src="'.$c14.'" >
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
											  echo '<i class="fa fa-star tqy" sytle = "font-size: 1.2rem;"></i>';
											  $calavgrat -= 1;
											}else{
											   if ($calavgrat >= 0 && $calavgrat < 0.5 ){
												//echo '<i class="fa fa-star-half-o tqy" sytle = "font-size: 1.2rem;"></i>';
												echo '<i class="fas fa-star-half-alt tqy"></i>';
											  }
											  else{
												echo '<i class="fa fa-star ratingStar tqy" sytle = "font-size: 1.2rem;"></i>';
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
					<!--CHEONG KIT MIN - End of Review & Rating Section------------------------------------------------------------------------->
                    <!-- Product Row -->
                    <div class="row mb-3" style="background-color:white;">
                        <div class="col">

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
	/*Cheong Kit Min - Review & Rating ************************************/
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
		color: #A31F37
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
	/*Cheong Kit Min - End of Review & Rating ****************/
    .image-container{
        width:100%;
        height: 40vh;
        padding: 20px;
    }
    .image-container .image{
        max-height: 100%;
        max-width: 100%;
    }
    .list-parent{
        white-space: nowrap;
        font-size: x-large;
    }
    .list-inline-item{
        background-color:white;
    }

    .carousel-item{
        height:60vh;
        background-color:white;
    }

    .carousel-inner img {
        width: 100%;
        height: 100%;
        object-fit:contain;
    }

    #custCarousel .carousel-indicators {
        position: static;
        margin-top: 20px
    }

    #custCarousel .carousel-indicators>li {
        width: 100px
    }

    #custCarousel .carousel-indicators li img {
        display: block;
        opacity: 0.5
    }

    .variation-item{
        width:100px;
        padding:1rem;
        text-align:center;
        color:black;
    }

    #custCarousel .carousel-indicators li.active img {
        opacity: 1
    }

    #custCarousel .carousel-indicators li:hover img {
        opacity: 0.75
    }

    .numner-input{
        padding: 0 0 1rem 0;
    }

    .quantity-input{
        appearance: textfield;
        min-height: 3rem;
        text-align: center;
    }

    .quantity-selector-btn{
        min-width:3rem;
        min-height:3rem;
        color: #ffffff;
        border-color: #a31f37;
        background-color: #a31f37;
        transition: all ease 200ms;
    }

    .quantity-selector-btn:hover{
        opacity:0.8;
    }


</style>

<style>
	.img-fluid {
		max-width: 50px;
		max-height: 50px;
	}

	.var-active{
		background-color:#a31f37;
		color:white;
	}
</style>

<script>
	/*Cheong Kit Min - Review & Rating ******************************************************************************/
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
	/*Cheong Kit Min - End of Review & Rating ******************************************************************************/
</script>

<script>
	initVariationButton();

	function initVariationButton()
    {
        const Variation1 = document.querySelectorAll('.btnVariation1');

        Variation1.forEach(btn => {
            btn.addEventListener('click', function handleClick(event) {
				Variation1.forEach(btn => {
					if(btn.classList.contains('var-active'))
					{
						btn.classList.remove("var-active");
					}
				});
				btn.classList.add("var-active");
				
				var query = "";
				var productId = "<?php echo($_SESSION['productID']); ?>";

				const selectedVariation = document.querySelectorAll('.var-active');
				if(selectedVariation.length == 1)
				{
					var VariationName = selectedVariation[0].parentElement.parentElement.parentElement.previousElementSibling.children[0].textContent;
					var VariationChoice = selectedVariation[0].textContent;
					getVaration1(productId,VariationName,VariationChoice);
				}
				else if(selectedVariation.length == 2)
				{
					var VariationName = selectedVariation[0].parentElement.parentElement.parentElement.previousElementSibling.children[0].textContent;
					var VariationChoice = selectedVariation[0].textContent;
					var Variation2Name = selectedVariation[1].parentElement.parentElement.parentElement.previousElementSibling.children[0].textContent;
					var Variation2Choice = selectedVariation[1].textContent;
					
					getVaration2(productId,VariationName,VariationChoice,Variation2Name,Variation2Choice);
				}
            });
        });

		const Variation2 = document.querySelectorAll('.btnVariation2');

        Variation2.forEach(btn => {
            btn.addEventListener('click', function handleClick(event) {
				Variation2.forEach(btn => {
					if(btn.classList.contains('var-active'))
					{
						btn.classList.remove("var-active");
					}
				});
				btn.classList.add("var-active");
				
				var query = "";
				var productId = "<?php echo($_SESSION['productID']); ?>";

				const selectedVariation = document.querySelectorAll('.var-active');
				if(selectedVariation.length == 1)
				{
					var VariationName = selectedVariation[0].parentElement.parentElement.parentElement.previousElementSibling.children[0].textContent;
					var VariationChoice = selectedVariation[0].textContent;
					getVaration1(productId,VariationName,VariationChoice);
				}
				else if(selectedVariation.length == 2)
				{
					var VariationName = selectedVariation[0].parentElement.parentElement.parentElement.previousElementSibling.children[0].textContent;
					var VariationChoice = selectedVariation[0].textContent;
					var Variation2Name = selectedVariation[1].parentElement.parentElement.parentElement.previousElementSibling.children[0].textContent;
					var Variation2Choice = selectedVariation[1].textContent;
					
					getVaration2(productId,VariationName,VariationChoice,Variation2Name,Variation2Choice);
				}
            });
        });
    }

	function getVaration1(productId,VariationName,VariationChoice) 
	{
		$.ajax({
			url:"PHP_product.php",
			method:"POST",
			data:{
				type:1,
				productId:productId,
				VariationName:VariationName,
				VariationChoice:VariationChoice
			},
			dataType: 'JSON',
			success: function(response){
				var len = response.length;
				for(var i=0; i<len; i++){
					var price = response[i].price;
					var stock = response[i].stock;

					

					var priceHTML = `
					<div class="col">
						<span style="color:#a31f37;font-size:18pt;font-weight: bold;">RM ` + price + `</span>
					</div>
					`;
					
					$("#PriceDiv").empty();
					$("#PriceDiv").append(priceHTML);

					var stockHTML = `
					<span id="stockAmount" style="color:#a31f37;font-size:10pt;">` + stock + `</span>
					<span style="color:#a31f37;font-size:10pt;">piece available</span>
					`;
					
					$("#stockAvailable").empty();
					$("#stockAvailable").append(stockHTML);
				}
				if(!!document.getElementById("VariationErrorMsg"))
				{
					document.getElementById("VariationErrorMsg").remove();
				}
			},
			error: function(err) {
				//$('#login_message').html(err.responseText);
				alert(err.responseText);
			}
		});
	}

	function getVaration2(productId,VariationName,VariationChoice,Variation2Name,Variation2Choice) 
	{
		$.ajax({
			url:"PHP_product.php",
			method:"POST",
			data:{
				type:2,
				productId:productId,
				VariationName:VariationName,
				VariationChoice:VariationChoice,
				Variation2Name:Variation2Name,
				Variation2Choice:Variation2Choice
			},
			dataType: 'JSON',
			success: function(response){
				var len = response.length;
				for(var i=0; i<len; i++){
					var price = response[i].price;
					var stock = response[i].stock;

					var priceHTML = `
					<div class="col">
						<span style="color:#a31f37;font-size:18pt;font-weight: bold;">RM ` + price + `</span>
					</div>
					`;
					
					$("#PriceDiv").empty();
					$("#PriceDiv").append(priceHTML);

					var stockHTML = `
					<span id="stockAmount" style="color:#a31f37;font-size:10pt;">` + stock + `</span>
					<span style="color:#a31f37;font-size:10pt;">piece available</span>
					`;
					
					$("#stockAvailable").empty();
					$("#stockAvailable").append(stockHTML);
				}

				if(!!document.getElementById("VariationErrorMsg"))
				{
					document.getElementById("VariationErrorMsg").remove();
				}
			},
			error: function(err) {
				//$('#login_message').html(err.responseText);
				alert(err.responseText);
			}
		});
	}

	initAddToCartButton();

	function initAddToCartButton()
    {
        document.getElementById('btnAddToCart').addEventListener('click', function handleClick(event) {
			if(document.getElementById("stockAvailable").contains(document.getElementById("stockAmount")))
			{
				console.log("condition 1");
				//addToCart();
			}
			else
			{
				if(!!document.getElementById("VariationErrorMsg"))
				{
					var errorMsg = `<p id="VariationErrorMsg" style="color: #f24a4a;padding: 0 0 0 12px;display:none;">Please select product variation to continue</p>`;
					document.getElementById("QuantityDiv").insertAdjacentHTML('beforeend', errorMsg);
				}
			}
		});
    }

	function addToCart(productId) 
	{
		$.ajax({
			url:"PHP_product.php",
			method:"POST",
			data:{
				addToCart:true,
			},
			dataType: 'JSON',
			success: function(response){
				//Add to cart successful show something 
			},
			error: function(err) {
				alert(err.responseText);
			}
		});
	}

</script>