<?php
    require __DIR__ . '/header.php';

?>
<?php
$sql_2 = "SELECT
myOrder.order_id,
myOrder.order_status,
product.product_id,
product.product_name,
product.product_cover_picture,
product.product_price,
product.product_variation,
orderDetails.quantity,
orderDetails.amount,
shopProfile.shop_name
FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN product ON orderDetails.product_id = product.product_id
JOIN shopProfile ON product.shop_id = shopProfile.shop_id
ORDER BY myOrder.order_id
";
$stmt_2 = $conn->prepare($sql_2);
$stmt_2->execute();
$orders = $stmt_2->get_result();

?>
<!--CHEONG KIT MIN (Rating)-->
<?php
$_SESSION["userId"] = "U000018";


	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['rid'], $_POST['wreview']) && !empty($_POST['rid']) && $_POST['wreview'] === 'Review'){
		
		$selectedPID = $_POST['rid'];
		$sql = "SELECT product_id, product_name, product_brand, product_price, product_cover_picture, shop_id
				FROM `product`
				WHERE product_id = ?";
		
		if($stmt = mysqli_prepare ($conn, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $selectedPID);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			
			if(mysqli_stmt_num_rows($stmt) == 1){
				mysqli_stmt_bind_result($stmt, $j1,$j2,$j3,$j4,$j5,$j6);
				mysqli_stmt_fetch($stmt);
			}
			
			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
		
		}
		
		$_SESSION["shop_id_product"] = $j6;
		
		
	}

	
		


	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['rrsub'], $_POST['reviewid']) && !empty($_POST['reviewid']) && $_POST['rrsub'] === 'Submit'){
	
		$shop_id = $_SESSION["shop_id_product"];
		$product_id = $_POST['reviewid']; //change into btn click $_POST
		$user_id = $_SESSION["userId"];	//change into S_SESSION [user id]
		$commentsec = $_POST['commentsec'];
		$ratingsec = $_POST['rating'];
		
		if (!file_exists("img/")){
				mkdir("img");	//make directory
		}
		
		if (!file_exists("img/rating/")){
				mkdir("img/rating");	//make directory
		}
		
		
		$gotpic = [];
		$tempNamepic = [];
		for($i = 0; $i<5; $i++){
			if($_FILES['img']['name'][$i] !== ""){
				array_push($gotpic, "img/rating/" . $_FILES['img']['name'][$i]);
				array_push($tempNamepic, $_FILES['img']['tmp_name'][$i]);
			}else{
				//echo "<div class='alert alert-danger'>NOT</div>";
			}
		}
		for($k = 0; $k< 5 - count($gotpic); $i++){
				array_push($gotpic, '');
		}
					
			
			$pc1 = $gotpic[0];
			$pc2 = $gotpic[1];
			$pc3 = $gotpic[2];
			$pc4 = $gotpic[3];
			$pc5 = $gotpic[4];
		
																		
		$sql = "INSERT INTO `reviewRating`(`product_id`, `user_id`, `message`,`rating`, `pic1`,`pic2`,`pic3`, `pic4`, `pic5`, `seller_id`) VALUES (?,?,?,?,?,?,?,?,?,?)";
			if($stmt = mysqli_prepare($conn, $sql)){
				mysqli_stmt_bind_param($stmt, 'sssissssss', $product_id, $user_id,$commentsec,$ratingsec,$pc1,$pc2,$pc3,$pc4,$pc5,$shop_id); 	//s=string , d=decimal value, i=integer
		
				mysqli_stmt_execute($stmt);
			
				if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
				{
					//echo "<script>alert('Insert successfully');</script>";
					
					for($r = 0; $r< 5; $r++){
						//move_uploaded_file($tempNamepic[$r], $gotpic[$r]);
						if(!empty($tempNamepic[$r])){
								$filepathname = $gotpic[$r];
								$tempT = $tempNamepic[$r];
								move_uploaded_file($tempT, $filepathname);
								//echo "<script>alert('$filepathname');</script>";							
							}
					}
					/**/
					
					$sql = "UPDATE reviewRating AS a, (SELECT id from reviewRating order by id desc LIMIT 1) AS b 
							SET a.rr_id = concat('RR', b.id)
							WHERE a.id = b.id;";
							if($stmt = mysqli_prepare($conn, $sql)){
                            mysqli_stmt_execute($stmt);
                            if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                            {}
                            else{}}	
                            //END  
					
				}else{
					echo "<script>alert('Fail to Insert');</script>";
				}
		
				mysqli_stmt_close($stmt);
			}
		
		
	}
   
?>
<!--CHEONG KIT MIN (END of Rating)-->
<!--CHEONG KIT MIN (Rating)-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
				
<!--CHEONG KIT MIN (END of Rating)-->
                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
				<!--CHEONG KIT MIN (Rating)-->
				<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Product Review</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <!--CONTENT START-->
					  <div class="modal-body">
						<!--DISPLAY HERE
						<div id = "modalResult" style = "height: 100%"></div>
						-->
						<div style="height: 100%">
								<!--CONCAT at 90 -->
									<img src = "<?php echo (isset($j5) && !empty ($j5))? 'img/product/'.$j5 : 'https://pbs.twimg.com/profile_images/1452244355062829065/jUmYXUCM_400x400.jpg'; ?>" class = "productpic">
									<div class = "namestar">
										<!--VALUE $C1 CHANGE TO RELAVANT INFO AR -->
										<h5 style = "font-size: 1rem; padding-top: 1rem; margin-bottom: 0.3rem; color: #333; font-weight: bold;"><?php echo (isset($j2) && !empty ($j2))? $j2 : 'NO PRODUCT NAME AVAILABLE'; ?></h5>
										<h6><?php echo (isset($j3) && !empty ($j3))? $j3 : 'NO MODEL/BRAND AVAILABLE'; ?></h6>
										<h3><?php echo (isset($j4) && !empty ($j4))? 'RM '.$j4 : 'NO PRICE AVAILABLE'; ?></h3>									
									</div>
									
								
								<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" enctype = "multipart/form-data">	
									<div class="rating"> 
										<input type="radio" name="rating" value="5" id="5" checked required><label for="5">☆</label> 
										<input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
										<input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
										<input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
										<input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
									</div>
									
									
							
							<textarea class="form-control" id="exampleFormControlTextarea1" name = "commentsec"rows="3" placeholder = "Write a Review..." style = "8rem;"></textarea>
							
							<!---------------------------------------------------------------------------------------------------------------------->
								
								<div class="card-body">
										<div class="row">
										   
											<div class="col-xl-10 col-lg-10 col-sm-12">
												<div class="row">
													<div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
														<div class="drag-list">
															<div class="row" style="margin-right: 0.5rem;margin-left: 0.5rem;">
																
																<div style="padding-bottom: .625rem;display:flex">
																	<div class="drag-item" draggable="true">
																		<div class="image-container">
																			<img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="" id = "view1">
																			<div class="image-layer">
																				
																			</div>
																			<div class="image-tools-delete hide">
																				<i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
																			</div>
																			<div class="image-tools-add">
																				<label class="custom-file-upload">
																					<input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
																					<i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
																				</label>
																			</div>
																		</div>
																		<p>Picture 1</p>
																	</div>
																	<div class="drag-item" draggable="true">
																		<div class="image-container">
																			<img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="" id = "view2">
																			<div class="image-layer">
																				
																			</div>
																			<div class="image-tools-delete hide">
																				<i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
																			</div>
																			<div class="image-tools-add">
																				<label class="custom-file-upload">
																					<input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
																					<i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
																				</label>
																			</div>
																		</div>
																		<p>Picture 2</p>
																	</div>
																	<div class="drag-item" draggable="true">
																		<div class="image-container">
																			<img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="" id = "view3">
																			<div class="image-layer">
																				
																			</div>
																			<div class="image-tools-delete hide">
																				<i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
																			</div>
																			<div class="image-tools-add">
																				<label class="custom-file-upload">
																					<input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
																					<i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
																				</label>
																			</div>
																		</div>
																		<p>Picture 3</p>
																	</div>
																	<div class="drag-item" draggable="true">
																		<div class="image-container">
																			<img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="" id = "view4">
																			<div class="image-layer">
																				
																			</div>
																			<div class="image-tools-delete hide">
																				<i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
																			</div>
																			<div class="image-tools-add">
																				<label class="custom-file-upload">
																					<input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
																					<i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
																				</label>
																			</div>
																		</div>
																		<p>Picture 4</p>
																	</div>
																	<div class="drag-item" draggable="true">
																		<div class="image-container">
																			<img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="" id = "view5">
																			<div class="image-layer">
																				
																			</div>
																			<div class="image-tools-delete hide">
																				<i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
																			</div>
																			<div class="image-tools-add">
																				<label class="custom-file-upload">
																					<input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
																					<i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
																				</label>
																			</div>
																		</div>
																		<p>Picture 5</p>
																	</div>
																</div>
																
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
							<!----------------------------------------------------------------------------------------------------------------------------->	
							
										

					  </div>
					  <!--CONTENT END-->
					  <div class="modal-footer">
						<input type = "hidden" name = "reviewid" value = "<?php echo (isset($j1) && !empty ($j1))? $j1 : 'RMB-ID LAI'; ?>">
						<input type = "submit" class = "btn btn-primary" name = "rrsub" value = "Submit">
					  </div>
					  </form>
					</div>
				  </div>
				</div>
				</div>
				<!--CHEONG KIT MIN (END of Rating)-->
				
				
				
				
				
				
                    <!---GET ORDER----->
                    <h1 style="text-align:center; color: red ;">PURCHASE HISTORY</h1>
                    <a href="index.php" style="font-size:20px;">BACK</a>
                  
                    <section id="orders" class="order container my-5 py-3 ">
                        <div class="container mt-2">
                            <h2 class="font-weight-bold text-center">YOUR ORDERS</h2>
                            <hr class="mx-auto">
                        </div>
                        <?php while($row = $orders ->fetch_assoc()){ ?>
                        
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                            <div class="col md-auto text-start"><span><strong><?php echo $row['shop_name']?></strong></span>
                                            </div>
                                            <div class="col md-auto text-end" style="text-align:right;"><span><strong>
                                             OrderID:<?php echo $row['order_id']?></strong></span>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Prod ID</th>
                                                    <th>Product(s)</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Product Quantity</th>
                                                    <th>Total Amount</th>
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                              
                                                <tr >
                                                    
                                                    <td style="text-align: center;"><?php echo $row['product_id']?></td>
                                                    <td><img src=/img/product/<?php echo $row['product_cover_picture']?> style="object-fit:contain;width:30%;height:30%"><td>
                                                    <td style="text-align: left;"><?php echo $row['product_name']?></td>
                                                    <td style="text-align: center;"><?php echo $row['quantity']?></td>
                                                    <td style="text-align: center;"><?php echo $row['amount']?></td>
                                                    
                                                </tr>
                                            
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                </div>
                        
                                <div class="card-footer">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                
                                            <form method="POST" action="orderDetails.php">
                                                            <input type="hidden" value="<?php echo $row['order_id']?>" name="order_id"/>
                                                            <input class="btn btn-primary" name="orderDetails_btn" value="Details" type="submit"/>

                                                            
                                                         </form>
                                             <button type="button" class="btn btn-primary" style="margin-left:10px;">Order Again</button>
											 
                                             
											 <!--CHEONG KIT MIN (Rating)-->
											<!--
											  <button type="button" class="btn btn-primary" style="margin-left:10px;">Ratings</button>
											  -->
												<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">
												<input type = "hidden" name = "rid" value = "<?php echo $row['product_id']?>">
												<input type = "submit" class="btn btn-primary" name = "wreview" value = "Review"></form>											  
											 <!--CHEONG KIT MIN (END of Rating)-->
                                             <span style="margin-left:20%;">Total</span>
                                             <span style="margin-left:18%;" ><?php echo $row['amount']?></span>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <br>
                        <?php }?>
                        
                    </section>

                    




                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php';
?>

<style>

.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 2.2rem;
    color: #A31F37;
    cursor: pointer
	font-weight: bold;
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}



.fa-star:hover{
	color: pink;
}
.fa-star{
	color: none;
}
.bi.bi-star-fill{
	-webkit-text-fill-color: orange;
}
.tqy{
	font-size:1.32rem;
	margin: 0 0.22rem;
}
.productpic{
	display: block; 
	float: left;
	margin: 0.75em 1em 0 1em; 
	border-radius: 8%; 
	width: 6.5rem; 
	height: 6.5rem;
}

.divcontent{
	font-size: 0.85rem; 
	max-height: 5rem; 
	min-height: 5rem; 
	overflow: hidden; 
	margin-top: 0.5 rem;
}
.namestar{
	min-height: 7.5rem;
	padding: auto;
	position: relative;
	
}
.image-container{
        width: 80px;
        height: 80px;
        background-color: white;
    }

    .image-layer:hover ~ .image-tools-delete{
        display:block;
    }

    .image-layer{
        width: 80px;
        height: 80px;
        opacity:0.5;
        position:absolute;
        margin-top: -80px;
    }

    .image-tools-delete:hover{
        display:block;
    }

    .image-tools-delete{
        width: 80px;
        height: 30px;
        background:grey;
        position:absolute;
        margin-top: -30px;
    }

    .image-tools-delete-icon{
        color: white;
        justify-content: center;
        display: grid;
        margin-top: 5px;
        font-size: 20px;
    }


    .image-tools-add{
        width: 80px;
        height: 80px;
        background:white;
        opacity:0.5;
        position:absolute;
        margin-top: -80px;
        z-index:100;
    }

    .image-tools-add-icon{
        color: black;
        justify-content: center;
        display: grid;
        margin-top: 30px;
        font-size: 20px;
    }

    .custom-file-upload{
        width:100%;
        height:100%;
    }

    .imgInp{
        display:none;
    }

    .img-thumbnail{
        min-height: 0;
        border: 1px solid #e3e3e3;
        border-radius: 10px;
    }

    .hide{
        display:none;
    }
</style>
<script>
<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['rid']) && !empty($_POST['rid'])  ){
			$showmedawae = "#exampleModalLong";
								 						
		}else{
			$showmedawae = "";
		}
		
?>
        $('<?php echo $showmedawae; ?>').modal('show');

    initImages();
    //initVariation();


    function rearrangeLabel(){
        var draggableItem = document.querySelectorAll('.drag-item');
        var counter=1;
        var text = "";
        draggableItem.forEach(item => {

            switch(counter)
            {
                case 1:
                    text = "Cover Picture"
                    break;
                case 2:
                    text = "Picture 1"
                    break;
                case 3:
                    text = "Picture 2"
                    break;
                case 4:
                    text = "Picture 3"
                    break;
                case 5:
                    text = "Picture 4"
                    break;
                case 6:
                    text = "Picture 5"
                    break;
                case 7:
                    text = "Picture 6"
                    break;
                case 8:
                    text = "Picture 7"
                    break;
                case 9:
                    text = "Picture 8"
                    break;
            }

            item.getElementsByTagName('p')[0].innerHTML = text;
            counter++;
        });

        const deleteImg = document.querySelectorAll('.image-tools-delete-icon');

        deleteImg.forEach(img => {
            img.addEventListener('click', function handleClick(event) {
                img.parentElement.previousElementSibling.previousElementSibling.src="";
                img.parentElement.nextElementSibling.classList.remove("hide");
                img.parentElement.classList.add("hide");
            });
        });

        const imgInp = document.querySelectorAll('.imgInp');
        imgInp.forEach(img => {
            img.addEventListener('change', function handleChange(event) {
                const [file] = img.files
                if (file) {
                    img.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(file)
                    img.parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                    img.parentElement.parentElement.classList.add("hide");
                }
            });
        });
    }

    function initImages()
    {
        const deleteImg = document.querySelectorAll('.image-tools-delete-icon');

        deleteImg.forEach(img => {
            img.addEventListener('click', function handleClick(event) {
                img.parentElement.previousElementSibling.previousElementSibling.src="";
                img.parentElement.nextElementSibling.classList.remove("hide");
				img.parentElement.nextElementSibling.firstElementChild.firstElementChild.value=null;
                img.parentElement.classList.add("hide");
            });
        });

        const imgInp = document.querySelectorAll('.imgInp');
        imgInp.forEach(img => {
            img.addEventListener('change', function handleChange(event) {
                const [file] = img.files;

                var extArr = ["jpg", "jpeg", "png"];

                if (img.files && img.files[0] && img.files.length > 1) {
                    for (var j = 0,i = 0; i < this.files.length; i++) {
                        while(imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.getAttribute('src') != "" && j < 9)
                        {
                            j++;
                        }

                        var ext = img.files[i].name.split('.').pop();
                        if(j < 9 && extArr.includes(ext))
                        {
                            imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(img.files[i])
                            imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                            imgInp[j].parentElement.parentElement.classList.add("hide");
                        }
                        else
                        {
                            alert("This Image is not a valid format");
                            img.value = "";
                            break;
                        }
                    }
                }
                else if(img.files && img.files[0])
                {
                    var ext = img.files[0].name.split('.').pop();
                    if(extArr.includes(ext))
                    {
                        img.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(file)
                        img.parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                        img.parentElement.parentElement.classList.add("hide");
                    }
                    else{
                        alert("This Image is not a valid format");
                        img.value = "";
                    }
                }
            });
        });
    }
/*******************************************************************************************************************************************/
	

										
											  
										
									

	

</script>
<!----
   --->