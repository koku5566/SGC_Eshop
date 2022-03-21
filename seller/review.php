<?php
    require __DIR__ . '/header.php'
?>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



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