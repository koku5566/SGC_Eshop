<?php
    require __DIR__ . '/header.php'
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />-->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
 
<?php
/*
if($_SESSION['login'] == false)
	 {
		echo "<script>
				alert('Login to Continue');
				window.location.href='helpCenterAdmin1.php';
			  </script>";
    }
*/



?>
<?php

$shopId = $_SESSION['userid'];
//$_SESSION['userid']
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['uimg']) && !empty($_POST['uimg'])  ){	
            
            
            $selectedPID = $_POST['uimg'];
            //CHANGE SELLER ID HOR I TELL U SLAP KAO U
			/*
            $sql = "SELECT rr_id, product_id, user_id, message, rating, seller_id, r_message 
					FROM reviewRating
					WHERE rr_id = ? && disable_date IS NULL && seller_id = '$shopId';";
			*/
		    $sql = "SELECT rr.*, u.username 
					FROM user u INNER JOIN   
					(SELECT  rr_id, product_id, user_id, message, rating, seller_id, r_message, pic1, pic2, pic3, pic4, pic5
					FROM reviewRating
					WHERE disable_date IS NULL) rr
					ON u.user_id = rr.user_id
					WHERE rr.rr_id = ? && rr.seller_id = '$shopId'";
		   
            if($stmt = mysqli_prepare ($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $selectedPID);	//HARLO IF THIS INT = i, STRING = s
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12,$c13);
                    mysqli_stmt_fetch($stmt);
                }
                
                mysqli_stmt_free_result($stmt);
                mysqli_stmt_close($stmt);
            
            }
    }
	
	
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['CUmessagereply']) && !empty($_POST['CUmessagereply']) && $_POST['CUreplyadmin'] === 'Reply' ){
			$CUmessagereply = $_POST['CUmessagereply'];
			$selectedPID = $_POST['CUid'];
			$status = 1;
			/*echo "$selectedPID | $CUmessagereply";*/

			  $sql = "UPDATE 
					  reviewRating SET status =?, r_message=? 
			          WHERE rr_id =?";
				if($stmt = mysqli_prepare($conn, $sql)){
					mysqli_stmt_bind_param($stmt, 'iss', $status, $CUmessagereply, $selectedPID); 	//s=string , d=decimal value i=ID
			
					mysqli_stmt_execute($stmt);
				
					if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
					{
						echo "<div class='alert alert-success'>Message Reply Successfully</div>";
					}else{
						echo "<div class='alert alert-danger'>Fail to Update</div>";
					}
			
					mysqli_stmt_close($stmt);
				}




}	

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['uimg'], $_POST['sktfaker']) && !empty($_POST['uimg']) && $_POST['sktfaker'] === 'Reply'){
	$selectedPID = $_POST['uimg'];
	$today = date("Y-m-d");
	//echo "<script>alert('SHOW ME DA WAE')</script>";
	/*
	$sql = "UPDATE reviewRating SET disable_date=? WHERE rr_id=?;";
                                   
                if($stmt = mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt, 'ss', $today, $selectedPID); 	//s=string , d=decimal value i=ID
            
                    mysqli_stmt_execute($stmt);
                
                    if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                    {               
						echo "<div class='alert alert-success'>Delete Successfully</div>";
                    }else{                        
						echo "<div class='alert alert-danger'>Fail to Delete</div>";
                    }
                    mysqli_stmt_close($stmt);
                }
	
	*/
}


?>

<!-- Begin Page Content -------------------------------------------------------------------------------------------------------------------->
<div class="container-fluid" id="mainContainer">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Review Seller</h1>
	</div>
	
	
	
	<!--MODAL-->
	<div id="myModalReply" class="modal">
					<!--THE MODAL CONTENT-->
						<div class="modal-content" >
						<h4 class = "displayCategoryModal" >Reply Message</h4>
						<span class="closeM" id = "closeModalReply">&times;</span>
							<div class="editQuestion">
								
								<!--REPLY MESSAGE MODAL-->
									
									<div>
										<h6 style = "font-size: 1rem; margin-bottom: 0.1rem;"><?php echo(isset($c13) && !empty ($c13))? $c13 : ''; ?></h6>
										<div style="margin-bottom: 0.1em;">
											<?php 									
											$starR = '';
											if(isset($c5) && !empty ($c5)){
												for($i=0; $i<5; $i++){
													if($i < $c5){
														$starR .='<i class="fa fa-star tqy"></i> ';
														
													}else{
													 $starR .='<i class="fa fa-star ratingStar tqy"></i> ';
													}
												}
												echo $starR;
											}else{echo '';}																
											?>
										</div>	
										
										
										<h6 style = "font-size: 0.85rem">
										<?php if(isset($c4) && !empty($c4)){
												if(strlen($c4) > 100){
													$CUtrim  = substr($c4, 0, 50);
													$CUmsg = "$CUtrim.....";
													echo "$CUmsg";
												}else{echo "$c4";}

											}else{echo "";}
										?>
										</h6>
										<table style = "margin-bottom: 0.3rem;">
											<tr>
												<?php
												
												/**/
													$picR = "../";
													 if($c8 === null || $c8 == ''){
														echo "<td><img src='https://archive.org/download/no-photo-available/no-photo-available.png' class='imgReply'></td>";										
													}else{
														 $pic1 = $picR . $c8;
														echo "<td><img src='".$pic1."' class='imgReply'></td>";
													 }
													 
													 if($c9 === null || $c9 == ''){
														echo "<td><img src='https://archive.org/download/no-photo-available/no-photo-available.png' class='imgReply'></td>";										
													}else{
														 $pic2 = $picR . $c9;
														echo "<td><img src='".$pic2."' class='imgReply'></td>";
													 }
													 
													 if($c10 === null || $c10 == ''){
														echo "<td><img src='https://archive.org/download/no-photo-available/no-photo-available.png' class='imgReply'></td>";										
													}else{
														 $pic3 = $picR . $c10;
														echo "<td><img src='".$pic3."' class='imgReply'></td>";
													 }
													 
													 if($c11 === null || $c11 == ''){
														echo "<td><img src='https://archive.org/download/no-photo-available/no-photo-available.png' class='imgReply'></td>";										
													}else{
														 $pic4 = $picR . $c11;
														echo "<td><img src='".$pic4."' class='imgReply'></td>";
													 }
													 
													 if($c12 === null || $c12 == ''){
														echo "<td><img src='https://archive.org/download/no-photo-available/no-photo-available.png' class='imgReply'></td>";										
													}else{
														 $pic5 = $picR . $c12;
														echo "<td><img src='".$pic5."' class='imgReply'></td>";
													 }
														
														 	 
													 
												
												
												
												
												?>
												<!--
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
												-->
												
											<tr>
										</table>																			
																					
												
										
									</div>
									<form action ='<?php echo $_SERVER['PHP_SELF'];?>' method = 'POST'>				
										
										<textarea class="form-control" name = "CUmessagereply" id="CUmessagereply" style = "height: 8em;" placeholder="Message" onchange = "myCUFunction()"></textarea>

										<?php echo (isset($c1) && !empty ($c1))? "<input type = 'hidden' name = 'CUid' value = '".$c1."'>" : ''; ?>
										<input type = 'submit' name ='CUreplyadmin' value ='Reply' style="float:right; margin: 5px 20px 0px 0px;" class="btn btn-success" id = 'CUreplyadminid' disabled>
										
										
																				
									</form>
								<!--REPLY MESSAGE MODAL-->
									
									
								
							

						</div>
				</div>
			</div>	
			
						<?php
								if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['uimg']) && !empty($_POST['uimg'])  ){
									
									$CUid = $_POST['uimg'];
									
									echo"<script>document.getElementById('myModalReply').style.display = 'block';</script>";	
								}
								
									
									
																	
								echo "<script>function myCUFunction(){
									
									  let msgreply = document.getElementById('CUmessagereply').value;
									  
									  
									  let f = false;
										
										if (msgreply  === '') 
										{f = false;}		
										else			
										{f = true;} 
										
										if(f == true)
										{document.getElementById('CUreplyadminid').disabled = false;}	
										else
										{document.getElementById('CUreplyadminid').disabled = true;}
										
								}</script>";
						?>
			<!--END OF MODAL REPLY MESSAGE-->

			<!--END OF MODAL-->
	
	
	
	
		<body>
			<div class="container">
				<div class="row">
					<div class="col">
						<!--Seller || REPLACE WITH WORKABLE SELLER ID AND CHANGE review.Search CODE !!!!!!!!!!!!!!-->
						  <label>Product</label>
						  <select class="form-control" id = "selectSeller">
							  <option value = "All">All*</option>
							  <?php
							    $sql ="SELECT product_id, product_name 
									   FROM product
									   WHERE shop_id = '$shopId'";
								if($stmt = mysqli_prepare ($conn, $sql)){
									mysqli_stmt_execute($stmt);
									mysqli_stmt_bind_result($stmt, $k1, $k2);
									
									while(mysqli_stmt_fetch($stmt)){
										echo "<option value = '$k1'>$k2</option>";
									}
									mysqli_stmt_close($stmt);									
								}							  							  
							  ?>
							  <!--
							  <option value = "P000001">Product 1</option>
							  <option value = "P000002">Product 2</option>
							  <option value = "P000003">Product 3</option>		
							  -->							  
						</select>
					</div>
					<div class="col">
						<!--Star-->
						<label>Rating</label>
						 <select class="form-control" id = "selectStar">
							  <option value = "All">All*</option>
							  <option value = "5">5</option>
							  <option value = "4">4</option>
							  <option value = "3">3</option>
							  <option value = "2">2</option>
							  <option value = "1">1</option>
						</select>		
					</div>
				</div>
			</div>
			
			<br />
		
		  <div class="container">
		   <div class="form-group">
			<div class="input-group-prepend">
			 <span class="input-group-text">Search</span>
			 <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
			</div>
		   </div>
		   <br />
		  </div>
		  
		  
		 </body>
		 <br />
		  

		
		<div id="result"></div>
	 
</div>
<!-- /.container-fluid --------------------------------------------------------------------------------------------------------------------->
<style>
.tqy{
		color: #A31F37
	}
.imgReply{
	width: 75%;
	height: 75%;
	object-fit: cover;
}
h4.displayCategoryModal{
	padding: 15px;
    max-width: 80%;
    margin: auto;
}
.bi.bi-star-fill{
	-webkit-text-fill-color: orange
}
.checked {
  color: orange;
}
.jungle{
	width: 100%;
	height: 100%;
	object-fit: cover;
}
.bengi{
	width: 75px;
	height: 75px;
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 45%;
 
  max-height: 100%;
}

/* The Close Button */
.closeM {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  position: absolute;
    right: 30px;
}

.closeM:hover,
.closeM:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


.modal-content .editQuestion {
	
	width: 75%;
	 /*border: 1px solid rgba(0 0 0 / .2);*/
	margin: auto;
	height: 100%
}
.modal-content .labelinput{
	margin: 12px 0px 0px 28px;
}
.modal-content .textinput{
	width: 75%;
	outline: none;
	height: 24px;
	overflow: auto;
	border: 1px solid rgba(0 0 0 / .1);
	border-radius: 5px;
}
.tqy{
		color: #A31F37
	}
.ratingStar {
    font-weight: inherit;
}
</style>


<script>
$(document).ready(function(){

	var check1 = false;
	var check2 = false;
	
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
</script>


<?php
    require __DIR__ . '/footer.php'
?>