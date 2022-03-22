<?php
$conn = mysqli_connect("localhost","sgcprot1_SGC_ESHOP","bXrAcmvi,B#U","sgcprot1_SGC_ESHOP");

//SEARCH FUNCTION NUMBAR ONE
/**/
$output = '';


/**/
if($_POST["dropdown"] != ""){
	$drop = mysqli_real_escape_string($conn, $_POST["dropdown"]);
	echo $drop;
	$query = "
		  SELECT * 
		  FROM(
		  SELECT cu_id, name, email, campus, subject, message, status, disable_date
		  FROM contactUs 
		  WHERE 
		  status LIKE '%".$drop."%')u
		  WHERE disable_date IS NULL; ";
	echo "babi";
}

else if(isset($_POST["query"]))
{
	echo "babi2";
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 
 
 $query = "
  SELECT * 
  FROM(
  SELECT cu_id, name, email, campus, subject, message, status, disable_date
  FROM contactUs 
  WHERE cu_id LIKE '%".$search."%'
  OR name LIKE '%".$search."%' 
  OR email LIKE '%".$search."%' 
  OR campus LIKE '%".$search."%' 
  OR subject LIKE '%".$search."%'
  OR message LIKE '%".$search."%'
  OR status LIKE '%".$search."%')k
  WHERE disable_date IS NULL; ";
  
}
else if ($_POST["query"] != "" || $_POST["dropdown"] != ""){
	$drop = mysqli_real_escape_string($conn, $_POST["dropdown"]);
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	echo "babi3";
	$query = "
		  SELECT * 
		  FROM(
		  SELECT cu_id, name, email, campus, subject, message, status, disable_date
		  FROM contactUs 
		  WHERE cu_id LIKE '%".$search."%'
		  OR name LIKE '%".$search."%' 
		  OR email LIKE '%".$search."%' 
		  OR campus LIKE '%".$search."%' 
		  OR subject LIKE '%".$search."%'
		  OR message LIKE '%".$search."%'
		  OR status LIKE '%".$drop."%')k
		  WHERE disable_date IS NULL; ";
	
}
else
{
 $query = "SELECT cu_id, name, email, campus, subject, message, status, disable_date
		   FROM contactUs
		   WHERE disable_date IS NULL
		   ORDER BY cu_id;";
  
 
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th> cu_id</th>
     <th>name</th>
     <th>email</th>
     <th>campus</th>
     <th>subject</th>
	 <th>message</th>
     <th>status</th>
	 <th>btn</th>
    </tr>
 ';
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
	<td><form action ="" method = "POST" class = "baka">
		<input type="hidden" name="uimage" value="'.$row["cu_id"].'">	
		<input type="submit" name ="t1faker" value = "faker" class="btn btn-primary"></form></td>
   </tr>
  ';
  
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

//SEARCH FUNCTION NUMBAR ONE - Version 2 -------------------------------------------------------------------------------------------------
 /*
 $output = '';

if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $sql = "
  SELECT * 
  FROM(
  SELECT cu_id, name, email, campus, subject, message, status, disable_date
  FROM contactUs 
  WHERE cu_id LIKE '%".$search."%'
  OR name LIKE '%".$search."%' 
  OR email LIKE '%".$search."%' 
  OR campus LIKE '%".$search."%' 
  OR subject LIKE '%".$search."%'
  OR message LIKE '%".$search."%'
  OR status LIKE '%".$search."%')k
  WHERE disable_date IS NULL; ";
  
}
else
{
 $sql = "SELECT cu_id, name, email, campus, subject, message, status, disable_date
		   FROM contactUs
		   WHERE disable_date IS NULL
		   ORDER BY cu_id;";
}

		
	if($stmt = mysqli_prepare ($conn, $sql)){
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8);
		
		if(mysqli_stmt_fetch($stmt) > 0){ //i think mistake this part but u use old oso ok
			$output .= '
						  <div class="table-responsive">
						   <table class="table table bordered">
							<tr>
							 <th> cu_id</th>
							 <th>name</th>
							 <th>email</th>
							 <th>campus</th>
							 <th>subject</th>
							 <th>message</th>
							 <th>status</th>
							 <th>btn</th>
							</tr>
						 ';
			
			while(mysqli_stmt_fetch($stmt)){			
				$output .= '
						   <tr>
							<td>'.$c1.'</td>
							<td>'.$c2.'</td>
							<td>'.$c3.'</td>
							<td>'.$c4.'</td>
							<td>'.$c5.'</td>
							<td>'.$c6.'</td>
							<td>'.$c7.'</td>							
							<td><form action ="" method = "POST" class = "baka">
								<input type="hidden" name="uimage" value="'.$c1.'">	
								<input type="submit" name ="t1faker" value = "faker"></form></td>
						   </tr>
						  ';

			}
			 echo $output;
		}else
			{
			 echo 'Data Not Found';
			}
		

	}
*/


//SEARCH FUNCTION NUMBAR TWO --------------------------------------------------------------------------------------------------



?>