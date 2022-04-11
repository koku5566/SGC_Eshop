<?php require __DIR__ . '/header.php' ?>

<?php
	if($_SESSION['login'] == false)
	{
		echo "<script>alert('Login to Continue');
			window.location.href='login.php';</script>";
    }
?>
<?php
if(isset($_POST['addBank']))
	{
		$_SESSION['AddBank'] = false;
		$uid = $_SESSION['uid'];

		$bankName = $_POST['bankName'];
		$name = $_POST['name'];
		$accountNo = $_POST['accountNo'];

		$sql_u = "SELECT * FROM userBankAccount WHERE account_no = '$accountNo'";

		$stmt_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($stmt_u) > 0) {	
			echo("<script>alert('Bank Account Already Exists');</script>");
		}
		else
		{
			$sql = "INSERT INTO userBankAccount (user_id, bank_name, bankAcc_name, account_no)
			VALUES ('$uid','$bankName','$name','$accountNo')";

			if (mysqli_query($conn, $sql)) {
				$_SESSION['AddBank'] = true;
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		}
	}
?>

<div class="row">
<?php require __DIR__ . '/userprofilenav.php' ?>
<div class="bg-gradient-primary col-xl-9" style="margin-top: -1.5rem !important; padding: 4rem 0;">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-left">
                                <div class="h1 text-gray-900 mb-4">Add Bank Account</div>
                            </div>

                            <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
								<div class="form-group">
								<label>Bank Name</label>
								<input required type="text" name="bankName" maxlength="100" class="form-control"/>
								</div>

								<div class="form-group">
								<label>Bank Account Holder Name</label>
								<input required type="text" name="name" maxlength="100" class="form-control"/>
								</div>

								<div class="form-group">
								<label>Account Number</label>
								<input required type="text" name="accountNo" pattern="[0-9]{1,}" maxlength="25" class="form-control"/>
								</div>

								<button type="submit" class="btn btn-primary btn-block" name="addBank">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
if(isset($_SESSION['AddBank']))
	{
		if($_SESSION['AddBank'] == true)
		{
			echo "<script>alert('Bank Account Added');</script>";
		}
		$_SESSION['AddBank'] = NULL;
	}
?>

<?php require __DIR__ . '/footer.php' ?>