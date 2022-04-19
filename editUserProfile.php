<?php include('PHP_GetDataFromDb.php');  ?>

<?php
if(isset($_POST['editUser']))
{
	$UID=$_POST['username'];
	$sql = "SELECT * FROM user WHERE username = '$UID'";

	$res_data = mysqli_query($conn,$sql);
	if (mysqli_num_rows($res_data) > 0){
		while($row = mysqli_fetch_array($res_data)){
			$return_arr[] = array("name"=>$row['name'], "email"=>$row['email'], "contact"=>$row['contact'], "role"=>$row['role']);
		}
		echo json_encode($return_arr);
	}
	else
	{
		echo json_encode("error");
	}
}
?>