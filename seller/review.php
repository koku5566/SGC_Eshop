<?php
    require __DIR__ . '/header.php'
?>
<script src = "jquery.js"></script>
<script src = "js/bootstrap.js"></script>
<link href="css/bootstrap.css" rel= "stylesheet"/>


    <!-- Begin Page Content -------------------------------------------------------------------------------------------------------------------->
    <div class="container-fluid" style="width:100%;">
    <h2>I tell u ar this </h2>
	<div class = "container">
		<br />
		<h2 align="center">Ajax Live Data Search</h2>
		<div class = "form-group">
			<div class = "input-group">
				<span class = "input-group-addon">Search</span>
				<input type = "text" name = "search_text" id = "search_text" placeholder = "Search By customer name" class = "form-control" />
			</div>
		</div>
		<br />
		<div id="result"></div>
	</div>
    </div>
    <!-- /.container-fluid --------------------------------------------------------------------------------------------------------------------->



<script>
$(document).ready(function(){
	$('#search_text').keyup(function(){
		var txt = $(this).val();
		consol.log($txt);
		if(txt != '')
		{
			
		}
		else
		{
			$('#result').html('');
			$.ajax({
				url: "reviewSearch.php",
				method: "post",
				data: {search:txt},
				dataType: "text",
				success: function(data)
				{
					$('#result').html(data);
				}
			});
		}
	});
});
</script>
<?php
   // require __DIR__ . '/footer.php'
?>