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




if(isset($_POST["restriction"]) || isset($_POST["restriction2"]))
{
	
  $query = "SELECT * 
			FROM(
			SELECT rr_id, product_id, user_id, message, rating, status, seller_id, r_message, disable_date
			FROM reviewRating 
			WHERE rr_id LIKE '%".$search."%'
			OR product_id LIKE '%".$search."%' 
			OR message LIKE '%".$search."%')k 
			WHERE disable_date IS NULL && status = 0 && seller_id = '$seller' $rr $rr2";
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
		   WHERE disable_date IS NULL && status = 0 && seller_id = '$seller' $rr $rr2
		   ORDER BY rr_id;";
		   
	echo "Rating = $rr |";
	echo "Product = $rr2 ";
}

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
  
  $output .='<div style="height: 100%">
			
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
	
</div>';
  
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>