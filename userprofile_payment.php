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
		$_SESSION['DeletePayment'] = false;
		$UID = $_POST['remove'];

		$sql = "DELETE FROM userAddress WHERE address_id = '$UID'";

		if (mysqli_query($conn, $sql)) {
			$_SESSION['DeletePayment'] = true;
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

<div class="row">
<?php require __DIR__ . '/userprofilenav.php' ?>
<div id="DataDiv">
<h1>My Address Book</h1>
<a href="../userAddBank.php" class="btn btn-primary btn-block">Add Bank Account</a>
<a href="../userAddCard.php" class="btn btn-primary btn-block">Add Card</a>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
<?php
	$UID = $_SESSION["uid"];
	
	$sql = "SELECT * FROM userBankAccount INNER JOIN userCard ON user_id ='$UID'";

	$res_data = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($res_data)){
		echo("
			<div class=\"container\">
			<button href=\"../userEditBank.php\" name=\"edit\" value=".$row["bankAcc_id"]." class=\"btn btn-primary\">
				".$row["bank_name"]."
				".$row["bankAcc_name"]."
				".$row["account_no"]."
				<button name=\"remove\" value=".$row["bankAcc_id"]." class=\"btn btn-primary\">Remove</button>
			</button>
			</div>

			<div class=\"container\">
			<button href=\"../userEditCard.php\" name=\"edit\" value=".$row["card_id"]." class=\"btn btn-primary\">
				".$row["name"]."
				".$row["card_number"]."
				".$row["expiry_date"]."
				<button name=\"remove\" value=".$row["card_id"]." class=\"btn btn-primary\">Remove</button>
			</button>
			</div>
			");
	}
?>
</form>
</div>
</div>

<?php
if(isset($_SESSION['DeletePayment']))
	{
		if($_SESSION['DeletePayment'] == true)
		{
			echo "<script>alert('Payment Method Removed');</script>";
		}
		$_SESSION['DeletePayment'] = NULL;
	}
?>

<?php require __DIR__ . '/footer.php' ?>