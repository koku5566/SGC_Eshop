<?php
$conn = mysqli_connect("localhost","sgcprot1_SGC_ESHOP","3g48B8Qn8k6v6VF","sgcprot1_SGC_ESHOP");
$seller = "14"; 	//FUTURE WOULD MAYBE TAKE SESSION REPLACE THIS NOW USE HARD CODE

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
 
  
  $query = "SELECT * 
			FROM(
			SELECT rr_id, product_id, user_id, message, rating, status, seller_id, r_message, disable_date
			FROM reviewRating 
			WHERE rr_id LIKE '%".$search."%'
			OR product_id LIKE '%".$search."%' 
			OR message LIKE '%".$search."%')k 
			WHERE disable_date IS NULL && status = 0 && seller_id = '$seller' $rr $rr2";
	*/
	$query = "SELECT * 
			  FROM 
			  (SELECT p.product_name, p.product_cover_picture,rr.* 
			  FROM product p INNER JOIN 
			  (SELECT rr_id, product_id, user_id, message, rating, status, seller_id, r_message, disable_date
			  FROM reviewRating) rr
			  ON p.product_id = rr.product_id
			  WHERE p.product_name LIKE '%".$search."%'
			  OR rr.product_id LIKE '%".$search."%' 
			  OR rr.message LIKE '%".$search."%') k
			  WHERE k.disable_date IS NULL && seller_id = '$seller' $rr $rr2";
  echo "Rating = $rr |";
   echo "Product = $rr2 ";
}

else
{
	
/*	
 $query = "SELECT rr_id, product_id, user_id, message, rating, status, seller_id, r_message, disable_date
		   FROM reviewRating 
		   WHERE disable_date IS NULL && status = 0 && seller_id = '$seller' $rr $rr2
		   ORDER BY rr_id;";
	*/	   
		   
 $query = "SELECT p.product_name, p.product_cover_picture,rr.* 
				FROM product p INNER JOIN 
				(SELECT rr_id, product_id, user_id, message, rating, status, seller_id, r_message, disable_date
				FROM reviewRating) rr
				ON p.product_id = rr.product_id
				WHERE rr.disable_date IS NULL && seller_id = '$seller' $rr $rr2";
		   
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
	 <th colspan="2">Product Name</th>
     <th>Product Id</th>
     <th>Message</th>
	 <th>Action</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
	 $starR = '';
	 for($i=0; $i<5; $i++){
		 if($i < $row["rating"]){
			 $starR .='<i class="fa fa-star tqy"></i> ';
		 }else{
			 $starR .='<i class="fa fa-star ratingStar tqy"></i> ';
		 }
	 }
	 $picR = "../img/product/";	
	 if($row["product_cover_picture"] !== NULL && $row["product_cover_picture"] !== ''){
		  $picR .= $row["product_cover_picture"];
	 }else{
		 $picR .= 'https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png';
	 }
	 
  $output .= '
   <tr colspan="2">
    <td><div class = "bengi">
		<img src="'.$picR.'" class="jungle">			
	</td>	
	<td>'.$row["product_name"].'</td>											
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
  
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>