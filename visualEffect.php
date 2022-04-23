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
	A.product_self_collect, A.product_standard_delivery, 
	A.product_variation,A.product_price,A.product_stock,A.product_sold, A.category_id, A.shop_id, 
	C.max_price,D.min_price,F.total_stock, R.rating, H.total_rated FROM `product` AS A 
	LEFT JOIN variation AS B ON A.product_id = B.product_id 
	LEFT JOIN (SELECT product_id,product_price AS max_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price DESC LIMIT 1) AS C ON A.product_id = C.product_id 
	LEFT JOIN (SELECT product_id,product_price AS min_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price ASC LIMIT 1) AS D ON A.product_id = D.product_id 
	LEFT JOIN (SELECT product_id, SUM(product_stock) AS total_stock FROM `variation` WHERE product_id = '$id' GROUP BY product_id) AS F ON A.product_id = F.product_id
	LEFT JOIN (SELECT round(AVG(rr.rating),0) AS rating, rr.product_id FROM user u INNER JOIN  reviewRating rr ON  u.user_id = rr.user_id WHERE rr.disable_date IS NULL AND rr.product_id = '$id') AS R ON A.product_id = R.product_id 
	LEFT JOIN (SELECT product_id, COUNT(rating) AS total_rated FROM reviewRating WHERE product_id = '$id' GROUP BY product_id) AS H ON A.product_id = H.product_id
	WHERE A.product_id = '$id' AND A.product_status = 'A'
	LIMIT 1";
	$result_product = mysqli_query($conn, $sql_product);

	echo($sql_product);
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
			$i_product_self_collect = $row_product['product_self_collect'];
			$i_product_standard_delivery = $row_product['product_standard_delivery'];
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
			$i_ratingRated = $row_product['total_rated'];
		}
	}
	else{
		?>
			<script type="text/javascript">
				//window.location.href = window.location.origin + "/index.php";
			</script>
		<?php
	}
?>
<?php
	//Cheong Kit Min - Review & Rating PHP ----------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['pid']) && !empty($_POST['pid'])  ){
		$selectedPID = SanitizeString($_POST['pid']);
			$sql = "SELECT rr.rr_id, rr.product_id, rr.user_id, u.name, u.email, u.profile_picture, u.role, rr.message, rr.rating, rr.pic1, rr.pic2, rr.pic3, rr.pic4, rr.pic5, rr.status, rr.seller_id, rr.r_message 
					FROM user u INNER JOIN  reviewRating rr 
					ON  u.user_id = rr.user_id 
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
                <div class="container-fluid" id="mainContainer">

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
                                </div> 
								<!-- Left right --> 
								<a class="carousel-control-prev" style="bottom: 10%;" href="#custCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> 
								<a class="carousel-control-next" style="bottom: 10%;" href="#custCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> 
								<!-- Thumbnails -->
                                <ol class="carousel-indicators list-inline" style="height:60px;margin-left:0;margin-right:0;overflow:auto;">
									<?php
										$j = 0;
										for($i = 0; $i < count($i_product_pic); $i++)
										{
											if($i_product_pic[$i] != "")
											{
												$picName = "/img/product/".$i_product_pic[$i];
												if($i == 0)
												{
													echo("<li class=\"list-inline-item firstThumbnail active\"> <a id=\"carousel-selector-0\" class=\"selected\" data-slide-to=\"$j\" data-target=\"#custCarousel\"> <img src=\"$picName\" class=\"img-fluid\"> </a> </li>");
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
                                    <b><?php echo($i_rating == "" ? "No Rating Yet" :  $i_rating." Star"); ?></b>
                                </div>
                                <div class="col">
                                    <b><?php echo($i_ratingRated == "" ? "No Rating Yet" :  $i_ratingRated." Rated"); ?></b>
                                </div>
                                <div class="col">
                                    <b><?php echo($i_product_sold); ?> Sold</b>
                                </div>
                            </div>
                            <br>
							<!-- Shipping Option -->
                            <div class="row mb-4" id="ShippingOptionDiv">
								<div class="col-12">
                                    <span style="font-weight: bold;"><?php echo($i_product_self_collect == 0 ? "" :  "This is a product able to make self collect"); ?></span>
                                </div>
                                <div class="col-12">
                                    <span style="font-weight: bold;"><?php echo($i_product_virtual == 0 ? "" :  "This is a virtual product without shippingment"); ?></span>
                                </div>
                            </div>
                            <!-- Price -->
                            <div class="row mb-4" id="PriceDiv">
                                <div class="col">
									<?php
									if($i_product_variation == 0)
									{
										echo("<span style=\"color:#a31f37;font-size:18pt;font-weight: bold;\">RM$i_product_price</span>");
									}
									else{
										if($i_min_price != $i_max_price)
										{
											echo("<span style=\"color:#a31f37;font-size:18pt;font-weight: bold;\">RM$i_min_price - RM$i_max_price </span>");
										}
										else
										{
											echo("<span style=\"color:#a31f37;font-size:18pt;font-weight: bold;\">RM$i_min_price</span>");
										}
									}
									
										
									?>

                                    
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
												$v_variation1ChoicesOnly = array_combine($variation1Choice, $variation1Stock);
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
                                        <button class="quantity-selector-btn" style="border-radius: 10px 0 0 10px;" id="minus" name = "ChangeQuantity" type = "button"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input min="1" name="quantity[]" id="txtQuantity" value="1" type="number" class="form-control quantity-input" readonly>
                                        <div class="input-group-append">
                                        <button class="quantity-selector-btn" style="border-radius: 0 10px 10px 0 ;" id="plus" name = "ChangeQuantity" type = "button"><i class="fa fa-plus"></i></button>
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
											$shop_pic = $row_shop['shop_profile_image'];
										}

										if($shop_pic != "")
										{
											echo("
											<div class=\"col-xl-3 col-md-4\" style=\"text-align: center;\">
												<img class=\"img-thumbnail\" style=\"min-height:10px; width: inherit;max-width: fit-content;\"src=\"/img/shop_logo/$shop_pic\">
											</div>
											");
										}
										else
										{
											echo("
											<div class=\"col-xl-3 col-md-4\" style=\"text-align: center;\">
												<img class=\"img-thumbnail\" style=\"min-height:10px; width: inherit;max-width: fit-content;\"src=\"/img/shop_logo/store.png\">
											</div>
											");
										}
										
										echo("
										<div class=\"col-xl-9 col-md-8 sidebar-brand-text\" style=\"font-size: 1.5rem;\">
											<b>$shop_name</b>
											<a href=\"shopDetails.php?id=$shop_id\" class=\"btn btn-primary\" style=\"width: 50%;position: absolute;bottom: 10px;left: 0;\">
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
                        <div class="productDescriptionDiv">
							<?php 
							echo(html_entity_decode($i_product_description)); 
							//echo($i_product_description); 
							?>
                        </div>
                    </div>        
                </div>
                <!-- /.container-fluid -->


<?php
    require __DIR__ . '/footer.php'
?>

<style>
	/*Cheong Kit Min - Review & Rating ************************************/
	.kk{
		max-height: 15rem;
	}
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
		
		border-radius: 4px;
		outline-style: solid;
		outline-width: 1.8px;
		outline-color: #A31F37;
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
        height: 25vh;
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

	#SuccessMsg{
		position: fixed;
		top: 45%;
		left: 0;
		right: 0;
		margin-left: auto;
		margin-right: auto;
		text-align: center;
		width: 400px;
		padding: 20px 0;
		border-radius: 10px;
		background: rgba(9, 9, 9, 0.6);
		z-index: 99;
	}

	.firstThumbnail{
		margin-left: 100px !important;
	}

	@media only screen and (min-width: 600px) {
		.firstThumbnail{
			margin-left:0 !important;;
		}
	}

	.productDescriptionDiv{
		width:100%;
		padding:20px;
	}
</style>

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

	document.getElementById('txtQuantity').addEventListener('change', function handleChange(event) {
		var quantity = document.getElementById('txtQuantity');
		if(document.getElementById("stockAvailable").contains(document.getElementById("stockAmount")))
		{
			this.parentNode.parentNode.querySelector('input[type=number]').stepDown()
			var stockAvailable = document.getElementById("stockAmount");
			if(stockAvailable < quantity)
			{
				document.getElementById('txtQuantity').value = stockAvailable;
			}
		}
		else
		{
			document.getElementById('txtQuantity').value;
		}
	});

	document.getElementById('plus').addEventListener('click', function handleClick(event) {
		var quantity = document.getElementById('txtQuantity').value;
		if(document.getElementById("stockAvailable").contains(document.getElementById("stockAmount")))
		{
			var stockAvailable = document.getElementById("stockAmount").innerText;
			if(parseInt(stockAvailable) > parseInt(quantity))
			{
				document.getElementById('plus').parentNode.parentNode.querySelector('input[type=number]').stepUp();
			}
			else{
				document.getElementById('txtQuantity').value = stockAvailable;
			}
		}
		else
		{
			quantity = "0";
		}
	});

	document.getElementById('minus').addEventListener('click', function handleClick(event) {
		var quantity = document.getElementById('txtQuantity').value;
		if(document.getElementById("stockAvailable").contains(document.getElementById("stockAmount")))
		{
			var stockAvailable = document.getElementById("stockAmount").innerText;
			if(parseInt(quantity) > 1)
			{
				document.getElementById('plus').parentNode.parentNode.querySelector('input[type=number]').stepDown();
			}
			else{
				document.getElementById('txtQuantity').value = "0";
			}
		}
		else
		{
			document.getElementById('txtQuantity').value = "0";
		}
	});

</script>