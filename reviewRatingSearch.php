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
	if($_POST["restriction2"] == "1"){
		$rr2 = " && message IS NOT NULL && pic1 IS NULL && pic2 IS NULL && pic3 IS NULL && pic4 IS NULL && pic5 IS NULL";
	}
	if($_POST["restriction2"] == "2"){
		$rr2 = " && message IS NULL && pic1 IS NOT NULL || pic2 IS NOT NULL || pic3 IS NOT NULL || pic4 IS NOT NULL || pic5 IS NOT NULL";
	
	}
	//$rr2 = " && product_id = '$restriction2' ";
	
	
}else{
	$rr2 = "";
}

 $query = "SELECT rr.rr_id, rr.product_id, rr.user_id, u.name, u.email, u.profile_picture, u.role, rr.message, rr.rating, rr.pic1, rr.pic2, rr.pic3, rr.pic4, rr.pic5, rr.status, rr.seller_id, rr.r_message 
		  FROM user u INNER JOIN  reviewRating rr 
		  ON  u.userID = rr.user_id 
		  WHERE rr.disable_date IS NULL && rr.product_id = '$product' $rr $rr2
		  ORDER BY rr.rr_id";

  
	//echo "Rating = $rr |";
	//echo "Product = $rr2 ";


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
	 
	 $profilePicR = '';
	 if($row["profile_picture"] === null){
		 $profilePicR .= '<img src = "https://us.123rf.com/450wm/panyamail/panyamail1809/panyamail180900248/109879025-user-avatar-icon-sign-profile-symbol.jpg?ver=6" class = "reviewprofilepic">';
	 }else{
		 //DISPLAY PROFILE PIC NO LE JIU DEFAULT ^^
		 $profilePicR .= '<img src = "https://cdn.vox-cdn.com/thumbor/9j-s_MPUfWM4bWdZfPqxBxGkvlw=/1400x1050/filters:format(jpeg)/cdn.vox-cdn.com/uploads/chorus_asset/file/22312759/rickroll_4k.jpg" class = "reviewprofilepic">';
	 }
	 
	 
	 $picR = '';
	 for($i=1; $i<=5; $i++){
		 if($row["pic$i"] === null){
			 $picR .='';
			 /*
			 $picR .='<td><img src="https://cdn4.iconfinder.com/data/icons/lucid-files-and-folders/24/file_disabled_not_allowed_no_permission_no_access-512.png" class="imgReply"></td>';
			 */
		 }else{
			 //DISPLAY REAL PICTURE/VIDEO THEY POST
			 $picR .='<td><img src="https://i.kym-cdn.com/photos/images/original/001/431/201/40f.png" class="imgReply"></td>';
		 }
			 
	 }
	 
  
  $output .='<div class="col-xl-3 col-lg-4 col-sm-6 divpink">
			<div style="height: 100%">
			'.$profilePicR.'
			<div class = "namestar">
				<h6 style = "font-size: 1rem; padding-top: 1rem; margin-bottom: 0px;">'.$row["name"].'</h6>
				<div style="margin-bottom: 0.1em;">'.$starR.'</div>																			
			</div>

	<h6 class = "divcontent">'.$row["message"].'</h6>
										
	<table style = "margin-bottom: 0.3rem;">
		<tr>
			'.$picR.'
		<tr>
	</table>
	
	<form action = "'. $_SERVER['PHP_SELF'].'" method = "POST">
		<input type = "hidden" name = "pid" value = "'.$row["rr_id"].'">
		<input type = "submit" name = "eProduct" value = "see more..." class="hyperlink">
	</form>
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