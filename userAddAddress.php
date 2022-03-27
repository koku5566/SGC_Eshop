<?php require __DIR__ . '/header.php' ?>

<?php
if(isset($_POST['addAddress']))
	{
		$_SESSION['AddAddress'] = false;
		
		$name = $_POST['name'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$postal = $_POST['postal'];
		$area = $_POST['area'];
		$state = $_POST['state'];
		$country = $_POST['country'];

		$sql_u = "SELECT * FROM userAddress WHERE address = '$address'";

		$stmt_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($stmt_u) > 0) {	
			echo("<script>alert('Address Already Exists');</script>");
		}
		else
		{
			$sql = "INSERT INTO userAddress (contact_name, phone_number, address, postal_code, area, state, country)
			VALUES ('$name','$contact','$address','$postal','$area','$state','$country')";

			if (mysqli_query($conn, $sql)) {
				$_SESSION['AddAddress'] = true;
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		}
	}
?>

<div class="bg-gradient-primary" style="margin-top: -1.5rem !important; padding: 4rem 0;">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-left">
                                <div class="h1 text-gray-900 mb-4">Add Address</div>
                            </div>

                            <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
								<div class="form-group">
								<label>Contact Name</label>
								<input required type="text" name="name" maxlength="50" class="form-control"/>
								</div>

								<div class="form-group">
								<label>Contact Number</label>
								<input required type="tel" name="contact" pattern="[0-9]{4}-[0-9]{7,}" maxlength="13" placeholder="0000-00000000" class="form-control"/>
								</div>

								<div class="form-group">
								<label>Address</label>
								<input required type="text" name="address" maxlength="50" class="form-control"/>
								</div>

								<div class="form-group">
								<label>Postal Code</label>
								<input required type="text" name="postal" pattern="[0-9]{1,}" maxlength="10" class="form-control"/>
								</div>

								<div class="form-group">
								<label>Area</label>
								<input required type="text" name="area" maxlength="50" class="form-control"/>
								</div>

								<div class="form-group">
								<label>State</label>
								<input required type="text" name="state" maxlength="50" class="form-control"/>
								</div>

								<div class="form-group">
								<label>Country</label>
								<input required type="text" name="country" maxlength="50" class="form-control"/>
								</div>

								<button type="submit" class="btn btn-primary btn-block" name="addAddress">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_SESSION['AddAddress']))
	{
		if($_SESSION['AddAddress'] == true)
		{
			echo "<script>alert('Address Added');</script>";
		}
		$_SESSION['AddAddress'] = NULL;
	}
?>

<?php require __DIR__ . '/footer.php' ?>