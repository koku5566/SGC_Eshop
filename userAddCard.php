<?php require __DIR__ . '/header.php' ?>

<?php
	if($_SESSION['login'] == false)
	{
		echo "<script>alert('Login to Continue');
			window.location.href='login.php';</script>";
    }
?>
<?php
if(isset($_POST['addCard']))
	{
		$_SESSION['AddCard'] = false;
		$uid = $_SESSION['uid'];

		$cardNo = $_POST['cardNo'];
		$expDate = $_POST['expDate'];
		$cardCVV = $_POST['cardCVV'];
		$name = $_POST['name'];

		$sql_u = "SELECT * FROM userCard WHERE card_number = '$accountNo'";

		$stmt_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($stmt_u) > 0) {	
			echo("<script>alert('Bank Account Already Exists');</script>");
		}
		else
		{
			$sql = "INSERT INTO userCard (user_id, card_number, expiry_date, card_cvv, name)
			VALUES ('$uid','$cardNo','$expDate','$cardCVV','$name')";

			if (mysqli_query($conn, $sql)) {
				$_SESSION['AddCard'] = true;
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
                                <div class="h1 text-gray-900 mb-4">Add Card</div>
                            </div>

                            <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
								<div class="form-group">
								<label>Card Number</label>
								<input required type="text" name="cardNo" pattern="[0-9]{1,}" maxlength="19" class="form-control"/>
								</div>

								<div class="form-group">
								<label>Expiry Date (MM/YY)</label>
								<input required type="text" name="expDate" maxlength="6" class="form-control"/>
								</div>
								
								<div class="form-group">
								<label>CVV</label>
								<input required type="text" name="cardCVV" pattern="[0-9]{3,4}" maxlength="4" class="form-control"/>
								</div>

								<div class="form-group">
								<label>Name on Card</label>
								<input required type="text" name="name" maxlength="100" class="form-control"/>
								</div>

								<button type="submit" class="btn btn-primary btn-block" name="addCard">Add</button>
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
if(isset($_SESSION['AddCard']))
	{
		if($_SESSION['AddCard'] == true)
		{
			echo "<script>alert('Card Added');</script>";
		}
		$_SESSION['AddCard'] = NULL;
	}
?>

<?php require __DIR__ . '/footer.php' ?>