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
		   <div id="result"></div>
		  </div>
		 </body>
		 
		 
		 
		 <!--REVIEW/RATING SECTION-->
		<div style "margin-top: 15px;">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
				<a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">5<span class="fa fa-star checked"></span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="reply-tab" data-toggle="tab" href="#reply" role="tab" aria-controls="reply" aria-selected="false">Reply</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="replied-tab" data-toggle="tab" href="#replied" role="tab" aria-controls="replied" aria-selected="false">Replied</a>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  <!--SECTION ONE-->
			  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab" style ="max-height 700px;">
						
			  </div>
			  <!--SECTION TWO-->
			  <div class="tab-pane fade" id="reply" role="tabpanel" aria-labelledby="reply-tab">
					
			  </div>
			  <!--SECTION THREE-->
			  <div class="tab-pane fade" id="replied" role="tabpanel" aria-labelledby="replied-tab">
					
			   </div>
			</div>
		</div>
		<!--END OF REVIEW/RATING-->
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
</div>
<!-- /.container-fluid --------------------------------------------------------------------------------------------------------------------->



<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"reviewSearch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
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