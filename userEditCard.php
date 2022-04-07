<?php require __DIR__ . '/header.php' ?>

<?php
	if($_SESSION['login'] == false)
	{
		echo "<script>alert('Login to access');
			window.location.href='login.php';</script>";
    }
?>
<?php
	if(isset($_POST['update']))
	{
		$UID = $_SESSION['BToEdit'];
		$bankName = $_POST['bankName'];
		$name = $_POST['name'];
		$accountNo = $_POST['accountNo'];

		$sql_u = "SELECT * FROM userBankAccount WHERE bankAcc_id = '$UID'";

		$stmt_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($stmt_u) > 0) {
			if($_POST['accountNo'] != ""){
				$sql = "UPDATE userBankAccount SET bank_name='$bankName', bankAcc_name='$name', account_no='$accountNo' WHERE bankAcc_id='$UID'";
			}
			else{
				echo("<script>alert('Error');</script>");
			}
		
			if (mysqli_query($conn, $sql)) {
				$_SESSION['Update'] = true;
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		}
		else
		{
			echo("<script>alert('Error');</script>");
		}
	}
?>

<div class="row">
<?php require __DIR__ . '/userprofilenav.php' ?>
<div id="DataDiv">
<h1>Bank Account</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
<?php
	$UID = $_SESSION['BToEdit'];
	$sql = "SELECT * FROM userBankAccount WHERE bankAcc_id = '$UID'";
	$res_data = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res_data) > 0){
		while($row = mysqli_fetch_array($res_data)){
			echo("
				<input name=\"product\" value=\"".$row["address_id"]."\" hidden/>

				<div class=\"form-group\">
				<label>Bank Name</label>
				<input required type=\"text\" name=\"bankName\" maxlength=\"100\" value=\"".$row["bank_name"]."\" class=\"form-control\"/>
				</div>

				<div class=\"form-group\">
				<label>Bank Account Holder Name</label>
				<input required type=\"tel\" name=\"name\" maxlength=\"13\" value=\"".$row["bankAcc_name"]."\" class=\"form-control\"/>
				</div>

				<div class=\"form-group\">
				<label>Account Number</label>
				<input required type=\"text\" name=\"accountNo\" pattern=\"[0-9]{1,}\" maxlength=\"25\" value=\"".$row["account_no"]."\" class=\"form-control\"/>
				</div>
				
				<button type=\"submit\" class=\"btn btn-primary btn-block\" name=\"update\">Update</button>
				");
		}
	}
?>
</form>
</div>
</div>

<?php
if(isset($_SESSION['Update']))
	{
		if($_SESSION['Update'] == true)
		{
			echo "<script>alert('Details Updated');
			window.location.href='userprofile_payment.php';</script>";
		}
		$_SESSION['Update'] = NULL;
	}
?>

<?php require __DIR__ . '/footer.php' ?>