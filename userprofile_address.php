<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false || $_SESSION['role'] != "ADMIN")
	{
		echo "<script>alert('Login as Admin account to access');
			window.location.href='login.php';</script>";
    }
?>
<?php
	if(isset($_POST['remove']))
	{
		$_SESSION['DeleteAddress'] = false;
		$UID = $_POST['remove'];

		$sql = "DELETE FROM userAddress WHERE address_id = '$UID'";

		if (mysqli_query($conn, $sql)) {
			$_SESSION['DeleteAddress'] = true;
		} else {
			echo "Error: " . mysqli_error($conn);
		}
	}
	
	if(isset($_POST['edit']))
	{
		$_SESSION['ToEdit'] = $_POST['edit'];
		echo("<script>window.location.href='userEditAddress.php';</script>");
	}
?>

<div id="DataDiv">
<h1>My Address Book</h1>
<a href="../userAddAddress.php" class="btn btn-primary btn-block">Add Address</a>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
<?php
	$UID = $_SESSION["uid"];
	
	$sql = "SELECT * FROM userAddress WHERE user_id ='$UID'";

	$res_data = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($res_data)){
		echo("
			<div>
			<button href=\"../userEditAddress.php\" name=\"edit\" value=".$row["address_id"]." class=\"btn btn-primary\">
				".$row["contact_name"]."
				".$row["phone_number"]."
				".$row["address"]."
				".$row["postal_code"]."
				".$row["area"]."
				".$row["state"]."
				".$row["country"]."
				<button name=\"remove\" value=".$row["address_id"]." class=\"btn btn-primary\">Remove</button>
			</button>
			</div>
			");
	}
?>
</form>

<?php
if(isset($_SESSION['DeleteAddress']))
	{
		if($_SESSION['DeleteAddress'] == true)
		{
			echo "<script>alert('Address Removed');</script>";
		}
		$_SESSION['DeleteAddress'] = NULL;
	}
?>
</div>

<?php require __DIR__ . '/footer.php' ?>