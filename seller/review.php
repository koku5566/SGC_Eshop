<?php
    require __DIR__ . '/header.php'
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />-->
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
		   <select class="form-control" id = "selectMe">
			  <option value = "">Default select</option>
			  <option value = "1">ONE</option>
			  <option value = "0">ZERO</option>
			 
			</select>
		  </div>
		 </body>
		 
		 
		 
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
			  <!--SECTION ALL-->
			  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab" style ="max-height 2000px;">
					<h1>ALL</h1>
					<div id="result"></div>
			  </div>
			  <!--SECTION FIVE-->
			  <div class="tab-pane fade" id="five" role="tabpanel" aria-labelledby="five-tab" style ="max-height 2000px;">
					<h1>FIVE</h1>
			  </div>
			  <!--SECTION FOUR-->
			  <div class="tab-pane fade" id="four" role="tabpanel" aria-labelledby="four-tab" style ="max-height 2000px;">
					<h1>FOUR</h1>
			  </div>
			  <!--SECTION THREE-->
			  <div class="tab-pane fade" id="three" role="tabpanel" aria-labelledby="three-tab" style ="max-height 2000px;">
					<h1>THREE</h1>
			  </div>
			  <!--SECTION TWO-->
			  <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab" style ="max-height 2000px;">
					<h1>TWO</h1>
			  </div>
			  <!--SECTION ONE-->
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
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search, "searchOne");
  }
  else
  {
   load_data();
  }
 });
 $('#selectMe').change(function(){
  var drop = $(this).text();
  //$('#Crd option:selected').text();
  if(drop != '')
  {
   load_data(drop, "dropdownTwo");
   
  }
  else
  {
   load_data();
  }
 });
 
 
 
 
 
 
});
</script>
<?php
    require __DIR__ . '/footer.php'
?>