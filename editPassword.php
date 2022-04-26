<?php require __DIR__ . '/mysqli_connect.php' ?>

<?php	
	if($_SESSION['login'] == false)
	{
		?><script>window.location = '<?php echo("$domain/E404.php");?>'</script><?php
		exit;
    }
?>

<?php
if(isset($_POST['editPassword']))
{
	$UID=$_POST['username'];
	$sql = "SELECT * FROM user WHERE username = '$UID'";

	$res_data = mysqli_query($conn,$sql);
	if (mysqli_num_rows($res_data) > 0){
		while($row = mysqli_fetch_array($res_data)){
			$return_arr[] = array("password"=>$row['password']);
		}
		echo json_encode($return_arr);
	}
	else
	{
		echo json_encode("error");
	}
}
?>