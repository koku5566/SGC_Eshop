<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false)
	{
		echo "<script>alert('Login to access');
			window.location.href='login.php';</script>";
    }
?>
<?php
	if(isset($_POST['removeB']))
	{
		$_SESSION['DeletePaymentB'] = false;
		$UID = $_POST['removeB'];

		$sql = "DELETE FROM userBankAccount WHERE bankAcc_id = '$UID'";
		if (mysqli_query($conn, $sql)) {
			$_SESSION['DeletePaymentB'] = true;
		} else {
			echo "Error: " . mysqli_error($conn);
		}
	}
	
	if(isset($_POST['removeC']))
	{
		$_SESSION['DeletePaymentC'] = false;
		$UID = $_POST['removeC'];

		$sql = "DELETE FROM userCard WHERE card_id = '$UID'";
		if (mysqli_query($conn, $sql)) {
			$_SESSION['DeletePaymentC'] = true;
		} else {
			echo "Error: " . mysqli_error($conn);
		}
	}

	if(isset($_POST['editB']))
	{
		$_SESSION['BToEdit'] = $_POST['editB'];
		echo("<script>window.location.href='userEditBank.php';</script>");
	}

	if(isset($_POST['editC']))
	{
		$_SESSION['CToEdit'] = $_POST['editC'];
		echo("<script>window.location.href='userEditCard.php';</script>");
	}
?>

<div class="row">
<?php require __DIR__ . '/userprofilenav.php' ?>
<div id="DataDiv">
<div class="h1">My Payment Method</div>
<a href="../userAddBank.php" class="btn btn-primary btn-block">Add Bank Account</a>
<a href="../userAddCard.php" class="btn btn-primary btn-block">Add Card</a>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
<div class="h3">Bank</div>
<?php
	$UID = $_SESSION["uid"];
	
	$sql = "SELECT * FROM userBankAccount WHERE user_id ='$UID'";
	//$sql = "SELECT * FROM userBankAccount INNER JOIN userCard ON userBankAccount.user_id ='$UID' AND userCard.user_id ='$UID'";

	$res_data = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($res_data)){
		echo("
			<div class=\"container\">
			<button href=\"../userEditBank.php\" name=\"editB\" value=".$row["bankAcc_id"]." class=\"btn btn-primary\">
				".$row["bank_name"]."
				".$row["bankAcc_name"]."
				".$row["account_no"]."
				<button name=\"removeB\" value=".$row["bankAcc_id"]." class=\"btn btn-primary\">Remove</button>
			</button>
			</div>
			");
	}
?>

<div class="h3">Card</div>
<?php
	$sql_1 = "SELECT * FROM userCard WHERE user_id ='$UID'";

	$res_data = mysqli_query($conn,$sql_1);
	while($row = mysqli_fetch_array($res_data)){
		echo("
			<div class=\"container\">
			<button href=\"../userEditCard.php\" name=\"editC\" value=".$row["card_id"]." class=\"btn btn-primary\">
				".$row["name"]."
				".$row["card_number"]."
				".$row["expiry_date"]."
				<button name=\"removeC\" value=".$row["card_id"]." class=\"btn btn-primary\">Remove</button>
			</button>
			</div>
			");
	}
?>
</form>
</div>
</div>

<?php
if(isset($_SESSION['DeletePaymentB']))
	{
		if($_SESSION['DeletePaymentB'] == true)
		{
			echo "<script>alert('Bank Account Removed');</script>";
		}
		$_SESSION['DeletePaymentB'] = NULL;
	}
	
if(isset($_SESSION['DeletePaymentC']))
	{
		if($_SESSION['DeletePaymentC'] == true)
		{
			echo "<script>alert('Card Removed');</script>";
		}
		$_SESSION['DeletePaymentC'] = NULL;
	}
?>

<?php require __DIR__ . '/footer.php' ?>