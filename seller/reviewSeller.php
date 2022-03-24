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
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['uimage']) && !empty($_POST['uimage'])){
	
	echo $_POST['uimage'];
	
}


?>

<!-- Begin Page Content -------------------------------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:100%;">
        <h1>SELLER REVIEW</h1>
		<body>
		
			<div class="container">
				<div class="row">
					<div class="col">
						<!--Seller-->
						  <select class="form-control" id = "selectSeller">
							  <option value = "All">Seller Name*</option>
							  <option value = "C-SJ">SEGI College Subang Jaya</option>
							  <option value = "C-KL">SEGI College Kuala Lumpur</option>
							  <option value = "C-P">SEGI College Penang</option>
							  <option value = "C-S">SEGI College Sarawak</option>
							  <option value = "C-KD">SEGI College Kota Damansara</option>
							  <option value = "U-KD">SEGI University Kota Damansara</option>  
						</select>
					</div>
					<div class="col">
						<!--Star-->
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
			<div class="input-group">
			 <span class="input-group-addon">Search</span>
			 <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
			</div>
		   </div>
		   <br />
		  </div>
		  
		  
		 </body>
		 <br />
		  
		  
		 
		 

		 
		
		
		
		<div id="result"></div>
		
		
		<!--
		 <form action ="" method = "POST">
		   <select class="form-control" id = "selectMe" name = "selectMe" onchange  ="ablemeFunction()">
			  <option value = "All">Default select</option>
			  <option value = "1">ONE</option>
			  <option value = "0">ZERO</option>			 
			</select>
			
		
	
			<select class="form-control" id = "selectMe2">
			  <option value = "All">Campus*</option>
			  <option value = "C-SJ">SEGI College Subang Jaya</option>
			  <option value = "C-KL">SEGI College Kuala Lumpur</option>
			  <option value = "C-P">SEGI College Penang</option>
			  <option value = "C-S">SEGI College Sarawak</option>
			  <option value = "C-KD">SEGI College Kota Damansara</option>
			  <option value = "U-KD">SEGI University Kota Damansara</option>   
			</select>
			

			<input type = "button" id = "sss" class ="btn btn-info" value = "Hantar la babi">
			</form>
		
		
		-->
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
		 <!--REVIEW/RATING SECTION-->
		<div style "margin-top: 15px;">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
				<a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All<span class="fa fa-star checked"></span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="five-tab" data-toggle="tab" href="#five" role="tab" aria-controls="five" aria-selected="false">5<span class="fa fa-star checked"></span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab" aria-controls="four" aria-selected="false">4<span class="fa fa-star checked"></span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="three" aria-selected="false">3<span class="fa fa-star checked"></span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="two" aria-selected="false">2<span class="fa fa-star checked"></span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="one" aria-selected="false">1<span class="fa fa-star checked"></span></a>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  
			  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab" style ="max-height 2000px;">
					<h1>ALL</h1>
					
					
					
					
					
					
			  </div>
			 
			  <div class="tab-pane fade" id="five" role="tabpanel" aria-labelledby="five-tab" style ="max-height 2000px;">
					<h1>FIVE</h1>
					<div id="result2"></div>
			  </div>
			 
			  <div class="tab-pane fade" id="four" role="tabpanel" aria-labelledby="four-tab" style ="max-height 2000px;">
					<h1>FOUR</h1>
			  </div>
			  
			  <div class="tab-pane fade" id="three" role="tabpanel" aria-labelledby="three-tab" style ="max-height 2000px;">
					<h1>THREE</h1>
			  </div>
			
			  <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab" style ="max-height 2000px;">
					<h1>TWO</h1>
			  </div>
			
			  <div class="tab-pane fade" id="one" role="tabpanel" aria-labelledby="one-tab" style ="max-height 2000px;">
					<h1>ONE</h1>
			  </div>
			</div>
		</div>
		<!--END OF REVIEW/RATING-->
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
</div>
<!-- /.container-fluid --------------------------------------------------------------------------------------------------------------------->
<style>
.checked {
  color: orange;
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
   url:"reviewSearch.php",
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
/*
 $('#search_text').keyup(function(){
  var search = $(this).val();
  var restriction = $('#selectStar').val();
  if(search != '')
  {
	 //alert('pp1');
	 if(restriction == "All"){
		 load_data(search,"","");
	 }else{
		 load_data(search,restriction,"");
		 //alert(restriction);
	 }
  }
  else
  {
   load_data();
  }
 });
 //Rating Star
 $('#selectStar').change(function(){
  var restriction = $(this).val();
  
  if(restriction != 'All')
  {
   load_data("", restriction, "");
 
  }
  else
  {
   load_data();
  }
 });
 //Seller
 $('#selectSeller').change(function(){
  var restriction2 = $(this).val();
  
  if(restriction2 != 'All')
  {
   load_data("", "",restriction2);
	//alert(restriction2);
  }
  else
  {
   load_data();
  }
 });
 */
 
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
 

  /*
 $('#selectStar #selectSeller').change(function(){
  var restriction = $('#selectStar').val();
  var restriction2 = $('#selectSeller').val();
  
  if(restriction == 'All' && restriction2 == 'All')
  {
   load_data();
   alert('allah')
  }else{
	load_data("", restriction, restriction2);
	alert('jesus')
  }

 
});
 */




});
</script>


<?php
    require __DIR__ . '/footer.php'
?>