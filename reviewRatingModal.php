<?php
$conn = mysqli_connect("localhost","sgcprot1_SGC_ESHOP","bXrAcmvi,B#U","sgcprot1_SGC_ESHOP");
$product = "P000001"; 	//FUTURE WOULD MAYBE TAKE SESSION REPLACE THIS NOW USE HARD CODE

$output = 'SHOW ME DA WAE';


if(isset($_POST["query"]))
{

 $modal = mysqli_real_escape_string($conn, $_POST["query"]);
 echo "$modal|";
 /*
  $query = "SELECT * 
			FROM(
			SELECT rr_id, product_id, user_id, message, rating, status, seller_id, r_message, disable_date
			FROM reviewRating 
			WHERE rr_id LIKE '%".$modal."%'
			OR product_id LIKE '%".$modal."%' 
			OR message LIKE '%".$modal."%')k 
			WHERE disable_date IS NULL && status = 0 && seller_id = '$product' ";
  */
  
  $query = "";
}

else
{
	
 $query = "SELECT rr_id, product_id, user_id, message, rating, status, seller_id, r_message, disable_date
		   FROM reviewRating 
		   WHERE disable_date IS NULL && status = 0 && seller_id = '$product' 
		   ORDER BY rr_id;";
		   
	
}

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
	/*
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
	 <th colspan="2">rr_id</th>
     <th>product_id</th>
     <th>message</th>
	 <th>Action</th>
    </tr>
 ';*/
 while($row = mysqli_fetch_array($result))
 {/*
	 $starR = '';
	 for($i=0; $i<5; $i++){
		 if($i < $row["rating"]){
			 $starR .='<i class="bi bi-star-fill"></i> ';
		 }else{
			 $starR .='<i class="bi bi-star"></i> ';
		 }
	 }
  $output .= '
   <tr colspan="2">
    <td><div class = "bengi"><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="jungle"></div>				
	</td>	
	<td>'.$row["rr_id"].'</td>											
    <td>'.$row["product_id"].'</td>
    <td>
	<div style="margin-bottom: 0.2em;">'.$starR.'</div>
	'.$row["message"].'
	</td>
	<td><form action ="" method = "POST" class = "baka">
		<input type="hidden" name="uimg" value="'.$row["rr_id"].'">	
		<input type="submit" name ="sktfaker" value = "Reply" class="btn btn-danger"></form></td>
   </tr>
  ';
  */
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>