<?php
$output = '';
$sql = "SELECT cu_id, name, email, campus, subject, message, status 
		FROM `contactUs` 
		WHERE cu_id LIKE '%".$_POST["search_text"]."%'";
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