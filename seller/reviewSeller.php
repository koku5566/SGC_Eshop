<?php
    require __DIR__ . '/header.php'
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />-->
 
 
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
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['uimg'], $_POST['sktfaker']) && !empty($_POST['uimg']) && $_POST['sktfaker'] === 'Reply'){
	$selectedPID = $_POST['uimg'];
	$today = date("Y-m-d");
	echo "<script>alert('SHOW ME DA WAE')</script>";
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
<div class="container-fluid" style="width:100%;">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Review Seller - APA JAY CHAO</h1>
		
	</div>
		<body>
			<!--MODAL-->
			
			<div id="myModalReply" class="modal">
					<!--THE MODAL CONTENT-->
						<div class="modal-content" style = "height: 400px;">
						<h4 class = "displayCategoryModal" >Reply Message</h4>
						<span class="closeM" id = "closeModalReply">&times;</span>
							<div class="editQuestion">
								
								<!--REPLY MESSAGE MODAL-->
									
									<div>
										<h5 style = "font-size:1.4vw"><?php echo(isset($z2) && !empty ($z2))? $z2 : ''; ?></h5>
										<h6 style = "font-size:1vw"><b><?php echo(isset($z3) && !empty ($z3))? $z3 : ''; ?></b></h6>
										<h6 style = "font-size:0.9vw">
										<?php if(isset($z6) && !empty($z6)){
												if(strlen($z6) > 100){
													$CUtrim  = substr($z6, 0, 50);
													$CUmsg = "$CUtrim.....";
													echo "$CUmsg";
												}else{echo "$z6";}

											}else{echo "";}
										?>
										</h6>										
										
									</div>
									<form action ='<?php echo $_SERVER['PHP_SELF'];?>' method = 'POST'>				
										
										<textarea class="form-control" name = "CUmessagereply" id="CUmessagereply" style = "height: 8em;" placeholder="Message" onchange = "myCUFunction()"></textarea>

										<?php echo (isset($z1) && !empty ($z1))? "<input type = 'hidden' name = 'CUid2' value = '".$z1."'>" : ''; ?>
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
			
			
			
			<div class="container">
				<div class="row">
					<div class="col">
						<!--Seller || REPLACE WITH WORKABLE SELLER ID AND CHANGE review.Search CODE !!!!!!!!!!!!!!-->
						  <label>Product</label>
						  <select class="form-control" id = "selectSeller">
							  <option value = "All">All*</option>
							  <option value = "P000001">Product 1</option>
							  <option value = "P000002">Product 2</option>
							  <option value = "P000003">Product 3</option>							  
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