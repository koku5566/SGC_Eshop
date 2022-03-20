<?php
    require __DIR__ . '/header.php'
?>
<?php
$output = '';
$sql = "SELECT cu_id, name, email, campus, subject, message, status 
		FROM `contactUs` 
		WHERE cu_id LIKE '%".$_POST["search"]."%'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<h4 align ="center">Search Result</h4>';
	$output .= '<div class = "table-responsive">
							  <table class = "table table bordered">
							  <tr>
								<th>cu_id</th>
								<th>Name</th>
								<th>Email</th>
								<th>Campus</th>
								<th>Subject</th>
								<th>Message</th>
								<th>Status</th>
							   </tr>';
    while($row = mysqli_fetch_array($result))
	{
	  $output .= '
				<tr>
					<td>'.$row["cu_id"].'</td>
					<td>'.$row["name"].'</td>
					<td>'.$row["email"].'</td>
					<td>'.$row["campus"].'</td>
					<td>'.$row["subject"].'</td>
					<td>'.$row["message"].'</td>
					<td>'.$row["status"].'</td>
				</tr>
				
			';
	}
	echo $output;
	echo "<script>alert('no way')</script>";
}
else
{
	echo 'Data Not Found';
}


?>

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



<style>
</style>

<script>
$(document).ready(function(){
	$('#search_text').keyup(function(){
		var txt = $(this).val();
		if(txt != '')
		{
			
		}
		else
		{
			$('#result').html('');
			$.ajax({
				url: "fetch.php",
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
    require __DIR__ . '/footer.php'
?>