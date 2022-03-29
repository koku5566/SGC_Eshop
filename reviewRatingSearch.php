<?php
$conn = mysqli_connect("localhost","sgcprot1_SGC_ESHOP","bXrAcmvi,B#U","sgcprot1_SGC_ESHOP");
$product = "P000001"; 	//FUTURE WOULD MAYBE TAKE SESSION REPLACE THIS NOW USE HARD CODE

$output = '';



if(isset($_POST["restriction"]) && !empty($_POST["restriction"]) && $_POST["restriction"] !== "All"){
	$restriction = mysqli_real_escape_string($conn, $_POST["restriction"]);
	
	$rr = " && rating = $restriction ";
	
	
}else{
	$rr = "";
}

if(isset($_POST["restriction2"]) && !empty($_POST["restriction2"]) && $_POST["restriction2"] !== "All"){
	$restriction2 = mysqli_real_escape_string($conn, $_POST["restriction2"]);
	
	//$rr2 = " && product_id = '$restriction2' ";
	
	$rr2 = "";
}else{
	$rr2 = "";
}

 $query = "SELECT rr.rr_id, rr.product_id, rr.user_id, u.name, u.email, u.profile_picture, u.role, rr.message, rr.rating, rr.pic1, rr.pic2, rr.pic3, rr.pic4, rr.pic5, rr.status, rr.seller_id, rr.r_message 
		  FROM user u INNER JOIN  reviewRating rr 
		  ON  u.userID = rr.user_id 
		  WHERE rr.disable_date IS NULL && rr.product_id = '$product' $rr $rr2
		  ORDER BY rr.rr_id";

/*
 $query = "SELECT rr_id, product_id, user_id, message, rating, status, seller_id, r_message, disable_date
		   FROM reviewRating 
		   WHERE disable_date IS NULL && status = 0 && seller_id = '$product' $rr $rr2
		   ORDER BY rr_id;";
		*/   
	echo "Rating = $rr |";
	echo "Product = $rr2 ";


$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 
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
	 /*
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
  
  $output .='<div class="col-xl-3 col-lg-4 col-sm-6 divpink">
			<div style="height: 100%">
			
			<img src = "https://pbs.twimg.com/profile_images/1452244355062829065/jUmYXUCM_400x400.jpg" class = "reviewprofilepic">
			<div class = "namestar">
				<h6 style = "font-size: 1rem; padding-top: 1rem; margin-bottom: 0px;">Rakan & Xayah</h6>
				<div style="margin-bottom: 0.1em;">													
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star"></i>
					<i class="bi bi-star"></i>
				</div>	
			</div>


	<h6 class = "divcontent">Rakan and Xayah are Vastaya bird-people with different roles. Xayah the Rebel carries the blade in the relationship. She is an AD carry assassin that enables her to shoot sharp feather-like blades with deadly grace and precision. Rakan the Charmer goes to battle to support his lover.
	</h6>
											
	<table style = "margin-bottom: 0.3rem;">
		<tr>
			<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
			<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
			<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
			<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
			<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>
		<tr>
	</table>
	
	<button class="hyperlink" data-toggle="modal" data-target="#exampleModalLong" value= "RR001">see more...</button>
	</div>   
	
</div>
</div>';
  
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>