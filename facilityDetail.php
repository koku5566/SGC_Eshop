<?php
    require __DIR__ . '/header.php';
?>
<?php
    $_SESSION['facilityId'] = $_GET['facilityId'];
?>
<?php
	//Fetch each product information
	$id = $_SESSION['facilityId'];
    
	$sql_facility = "SELECT * FROM facilityPic WHERE facility_id = '$id'";

	$result_facility = mysqli_query($conn, $sql_facility);

	if (mysqli_num_rows($result_facility) > 0) {
		while($row_facility = mysqli_fetch_assoc($result_facility)) {
			
			$title = $row_facility['title'];
			$priceperhour = $row_facility['price_per_hour'];
            $description = $row_facility['pic_description'];
            $address = $row_facility['address'];
            $whatsapp = $row_facility['contact_whatsapp'];
			$picList = array($row_facility['pic_cover']);
			array_push($picList,$row_facility['pic1'],$row_facility['pic2']);
			array_push($picList,$row_facility['pic3'],$row_facility['pic4']);

		}
	}
	else{
		?>
			<script type="text/javascript">
				window.location.href = window.location.origin + "/facilityrental.php";
			</script>
		<?php
	}
?>
                <!-- Begin Page Content -->
                <div class="container-fluid" id="mainContainer">
                    <!-- Facility Row -->
                    <div class="row mb-3" style="background-color:white;">
                        <!-- Picture -->
                        <div class="col-xl-5 col-md-6 mb-6">
							<div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                                <!-- slides -->
                                <div class="carousel-inner">
									<?php
										for($i = 0; $i < count($picList); $i++)
										{
											if($picList[$i] != "")
											{
												$picName = "/img/facility/".$picList[$i];
												if($i == 0)
												{
													echo("<div class=\"carousel-item active\"> <img src=\"$picName\" alt=\"$title\"> </div>");
												}
												else
												{
													echo("<div class=\"carousel-item\"> <img src=\"$picName\" alt=\"$title\"> </div>");
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
										for($i = 0; $i < count($picList); $i++)
										{
											if($picList[$i] != "")
											{
												$picName = "/img/facility/".$picList[$i];
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
                                    <h1 style="color:#a31f37;"><?php echo($title) ?></h1>
                                    <hr>
                                </div>
                            </div>
                            <!-- Price -->
                            <div class="row mb-4" id="PriceDiv">
                                <div class="col">
                                    <span style="color:#a31f37;font-size:18pt;font-weight: bold;">RM <?php echo($priceperhour); ?> Per Hour</span>
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="row">
                                <div class="col">
                                    <span style="color:black;font-size:14pt;"><?php echo($description); ?></span>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="row mb-5" style="margin-top: 100px;">
                                <div class="col">
									<a href="https://api.whatsapp.com/send/?phone=<?php echo($whatsapp); ?>" class="btn btn-success" style="width:100%;">Contact Us Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->


<div class="modal fade" id="MsgModel" tabindex="-1" role="dialog" aria-labelledby="MsgModel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div id="SuccessMsg">
			<div class="SuccessMsg-content">
				<img src="/img/resource/check.png" style="width: 80px;"/>
				<p style="color: white;">Item has been added to your shopping cart</p>
			</div>
		</div>
	</div>
</div>


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
				addToCart();
			}
			else
			{
				if(!document.getElementById("VariationErrorMsg"))
				{
					var errorMsg = `<p id="VariationErrorMsg" style="color: #f24a4a;padding: 0 0 0 12px;">Please select product variation to continue</p>`;
					document.getElementById("QuantityDiv").insertAdjacentHTML('beforeend', errorMsg);
				}
			}
		});
    }

	function addToCart(productId) 
	{
		var qty = document.getElementById('txtQuantity').value;
		$.ajax({
			url:"PHP_product.php",
			method:"POST",
			data:{
				addToCart:true,
				quantity:qty
			},
			dataType: 'JSON',
			success: function(response){
				if(response == "true")
				{
					$("#MsgModel").modal('show');
					setTimeout(function() {$("#MsgModel").modal('hide');}, 2000);
				}
			},
			error: function(err) {
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