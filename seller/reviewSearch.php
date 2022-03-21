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
  OR status LIKE '%".$search."%' ";
  
echo "HAVENT GONE";
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
  $output .= "niama";
  echo $output;
   echo 'GOTGOTGOTOGOT';
 }
 

///////////////////////////////////////////////////////////
/*
$sql = "SELECT hcc_id, category, pic, pic_type 
	        FROM `helpCenterCategory` 
			WHERE disable_date IS NULL";	//KM - CHANGE TO helpCenterCategory
		if($stmt = mysqli_prepare ($conn, $sql)){
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $c1,$c2,$c3,$c4);
			
			
			while(mysqli_stmt_fetch($stmt)){			

					
					
					if(strlen($c2) < 15){
						//$cTrim = substr($c2, 0, 16);
						//$cTag = "$cTrim...";
						$cTag = "$c2 \n";
					}else{$cTag = $c2;}
					
				echo "<div class='item'>" .
					"<form action = '". $_SERVER['PHP_SELF']."' method = 'POST' class = 'imgCssT'>" .
						"<input type='hidden' name='pid' value='$c1'>" .
						 "<input type='image' name = 'uProduct' src='data: $c4;base64, " . base64_encode($c3)."' alt='Submit' class='imgCss'></form>" .
						"<div class='catTag'>$cTag</div></div>"; 
			}

	}

*/
?>