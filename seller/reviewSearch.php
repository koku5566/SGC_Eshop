<?php
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $sql = "
  SELECT cu_id, name, email, campus, subject, message, status
  FROM contactUs 
  WHERE cu_id LIKE '%".$search."%'
  OR name LIKE '%".$search."%' 
  OR email LIKE '%".$search."%' 
  OR campus LIKE '%".$search."%' 
  OR subject LIKE '%".$search."%'
  OR message LIKE '%".$search."%'
  OR status LIKE '%".$search."%'
  
 ";
}
else
{
 $sql = "SELECT cu_id, name, email, campus, subject, message, status 
		   FROM contactUs 
		   WHERE disable_date IS NULL
		   ORDER BY cu_id;";
  

 echo "sohai gone d";
}
$result = mysqli_query($conn, $sql);

 
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
 echo 'GOTGOTGOTOGOT';


?>