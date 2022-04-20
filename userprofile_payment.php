<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false)
	{
		?><script>window.location = '<?php echo("$domain/login.php");?>'</script><?php
		exit;
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
			echo "<script>alert('Bank Account Removed');</script>";
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
			echo "<script>alert('Card Removed');</script>";
		} else {
			echo "Error: " . mysqli_error($conn);
		}
	}
?>

<div class="row">
<?php require __DIR__ . '/userprofilenav.php' ?>
<div class="bg-gradient col-xl-9" style="margin-top: -1.5rem !important;">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-6 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-left">
                                        <div class="h1 text-gray-900 mb-4">My Payment Option</div>
                                    </div>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
<div class="row">
<div class="h3">Bank</div><a href="../userAddBank.php" class="btn btn-primary btn-block">Add Bank Account</a></div>
<?php
	$UID = $_SESSION["uid"];
	
	$sql = "SELECT * FROM userBankAccount WHERE user_id ='$UID'";
	//$sql = "SELECT * FROM userBankAccount INNER JOIN userCard ON userBankAccount.user_id ='$UID' AND userCard.user_id ='$UID'";

	$res_data = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($res_data)){
		echo("
			<div class=\"mb-3\">
				<div class=\"userBank\">
					<p style=\"font-weight: bold; font-size: 1.6rem;\">".$row["bank_name"]."</p>
					<div class=\"row\">
						<div class=\"col-lg-4\">
							<p style=\"font-size: 1.3rem;\">".$row["bankAcc_name"]."</p>
							<p style=\"font-size: 1.15rem;\">
							".$row["account_no"]."
							</p>
						</div>
					</div>
				</div>
				<button name=\"removeB\" value=".$row["bankAcc_id"]." class=\"btn btn-primary\"><i class='fa fa-trash' aria-hidden='true'></i></button>
			</div>
			<hr>
			");
	}
?>

<hr>

<div class="row">
<div class="h3">Card</div>
<a href="../userAddCard.php" class="btn btn-primary btn-block">Add Card</a></div>
<?php
	$sql_1 = "SELECT * FROM userCard WHERE user_id ='$UID'";

	$res_data = mysqli_query($conn,$sql_1);
	while($row = mysqli_fetch_array($res_data)){
		echo("
			<div class=\"mb-3\">
				<div class=\"userCard\">
					<p style=\"font-weight: bold; font-size: 1.6rem;\">".$row["name"]."</p>
					<div class=\"row\">
						<div class=\"col-lg-4\">
							<p style=\"font-size: 1.3rem;\">".$row["card_number"]."</p>
							<p style=\"font-size: 1.15rem;\">
							".$row["expiry_date"]."
							</p>
						</div>
					</div>
				</div>
				<button name=\"removeC\" value=".$row["card_id"]." class=\"btn btn-primary\"><i class='fa fa-trash' aria-hidden='true'></i></button>
			</div>
			<hr>
			");
	}
?>
</form>
	                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php require __DIR__ . '/footer.php' ?>