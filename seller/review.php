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

		<body>
		  <div class="container">
		   <br />
		   <h2 align="center">Ajax Live Data Search using Jquery PHP MySql</h2><br />
		   <div class="form-group">
			<div class="input-group">
			 <span class="input-group-addon">Search</span>
			 <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
			</div>
		   </div>
		   <br />
		   <form action ="" method = "POST">
		   <select class="form-control" id = "selectMe">
			  <option value = "">Default select</option>
			  <option value = "1">ONE</option>
			  <option value = "0">ZERO</option>
			 
			</select>
			<!---->
			<select class="form-control" id = "selectMe2">
			  <option value = "">Default select</option>
			  <option value = "1">ONE</option>
			  <option value = "0">ZERO</option>
			 
			</select>
			
			<input type = "button" id = "sss" class ="btn btn-info" value = "Hantar la babi">
			</form>
		  </div>
		 </body>
		 
		 
		 <!--Result-->
		 
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
					<div id="result"></div>
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

 function load_data(query, dropdown)
 {
  $.ajax({
   url:"reviewSearch.php",
   method:"POST",
   data:{query:query,
		 dropdown:dropdown},
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
  if(search != '')
  {
   load_data(search, "");
	//alert('pp1');
  }
  else
  {
   load_data();
  }
 });
 $('#selectMe').change(function(){
  var drop = $(this).val();
  //$('#Crd option:selected').text();
  if(drop != '')
  {
   load_data("", drop);
 //alert('pp2');
  }
  else
  {
   load_data();
  }
 });

*/
//----------------------------------------------------------------------------------------------------

$('#sss').click(function(){
	var drop1  = $('#selectMe').val();
	var drop2  = $('#selectMe2').val();
	
	if(drop1 != '')
	{
		alert(drop1);
	}
	else if(drop2 != '') 
	{		
		alert(drop2);
	}
	else if(drop1 != '' && drop2 != '')
	{
		alert(drop1 + drop2);
	}
	else{
		alert('BOTH NOTHING');
	}
	
	
	
})




 
/*
$('#search_text, #selectMe').on('keyup change', function(){
	var search = $(this).val();
	var drop = $(this).val();
	if(drop != '' && search != ''){
		load_data(search, drop);
		alert(search);
		alert(drop);
	}else{
		 load_data();
		 alert('no hab');
	}
	
})
*/
 /*
 if(check1){
	 load_data(search, "");
	 alert('check1');
 }
 else if (check2){
	 load_data("", drop);
	  alert('check2');
 }
 else if (check1 && check2){
	 load_data(search, drop);
	  alert('check1&2');
 }
 */
 
 
 
 
 
 
 
});



</script>
<?php
    require __DIR__ . '/footer.php'
?>