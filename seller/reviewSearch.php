<?php
$conn = mysqli_connect("localhost","sgcprot1_SGC_ESHOP","bXrAcmvi,B#U","sgcprot1_SGC_ESHOP");


$output = '';
$i = 1;
if(isset($_POST["query"]))
{
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
  OR status LIKE '%".$search."%';)k
  WHERE disable_date IS NULL; ";
  
}
else
{
 $query = "SELECT cu_id, name, email, campus, subject, message, status 
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
		<input type="hidden" name="uimage" value="'.$i.'">	
		<input type="submit" name ="t1faker" value = "faker"></form></td>
   </tr>
  ';
  
  $i++;
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}



?>