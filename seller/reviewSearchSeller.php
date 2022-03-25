<?php
$conn = mysqli_connect("localhost","sgcprot1_SGC_ESHOP","bXrAcmvi,B#U","sgcprot1_SGC_ESHOP");
$seller = "S000001"; 	//FUTURE WOULD MAYBE TAKE SESSION REPLACE THIS NOW USE HARD CODE

$output = '';



if(isset($_POST["restriction"]) && !empty($_POST["restriction"]) && $_POST["restriction"] !== "All"){
	$restriction = mysqli_real_escape_string($conn, $_POST["restriction"]);
	
	$rr = " && rating = $restriction ";
	
	
}else{
	$rr = "";
}

if(isset($_POST["restriction2"]) && !empty($_POST["restriction2"]) && $_POST["restriction2"] !== "All"){
	$restriction2 = mysqli_real_escape_string($conn, $_POST["restriction2"]);
	
	$rr2 = " && product_id = '$restriction2' ";
}else{
	$rr2 = "";
}




if(isset($_POST["query"]))
{
	
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 echo "$search|";
 /*
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
  WHERE disable_date IS NULL $rr $rr2";
  */
  $query = "SELECT * 
			FROM(
			SELECT rr_id, product_id, user_id, message, rating, status, seller_id, r_message, disable_date
			FROM reviewRating 
			WHERE rr_id LIKE '%".$search."%'
			OR product_id LIKE '%".$search."%' 
			OR message LIKE '%".$search."%')k 
			WHERE disable_date IS NULL && seller_id = '$seller' $rr $rr2";
  echo "Rating = $rr |";
   echo "Product = $rr2 ";
}

else
{
	/*
 $query = "SELECT cu_id, name, email, campus, subject, message, status, disable_date
		   FROM contactUs
		   WHERE disable_date IS NULL $rr $rr2
		   ORDER BY cu_id;";
	*/
 $query = "SELECT rr_id, product_id, user_id, message, rating, status, seller_id, r_message, disable_date
		   FROM reviewRating 
		   WHERE disable_date IS NULL && seller_id = '$seller' $rr $rr2
		   ORDER BY rr_id;";
		   
	echo "Rating = $rr |";
	echo "Product = $rr2 ";
}

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
	 <th colspan="2">rr_id</th>
     <th>product_id</th>
     <th>message</th>
     <th>rating</th>
	 <th>Action</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
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
    <td><div class = "bengi">
					<img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="jungle">
		</div>	
	</td>	
	<td>'.$row["rr_id"].'</td>											
    <td>'.$row["product_id"].'</td>
    <td>
	<div>'.$starR.'</div>
	'.$row["message"].'
	</td>
    <td>'.$row["rating"].'</td>
	<td><form action ="" method = "POST" class = "baka">
		<input type="hidden" name="uimg" value="'.$row["rr_id"].'">	
		<input type="submit" name ="sktfaker" value = "Reply" class="btn btn-primary"></form></td>
   </tr>
  ';
  
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>