<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false)
	{
		?><script>window.location = '<?php echo("$domain/login.php");?>'</script><?php
		exit;
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
			echo "<script>alert('Address Removed');</script>";
		} else {
			echo "Error: " . mysqli_error($conn);
		}
	}
	
	if(isset($_POST['edit']))
	{
		$_SESSION['ToEdit'] = $_POST['edit'];
		?><script>window.location = '<?php echo("$domain/userEditAddress.php");?>'</script><?php
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
                                        <div class="h1 text-gray-900 mb-4">My Address Book</div>
                                    </div>
<a href="../userAddAddress.php" class="btn btn-primary btn-block">Add Address</a>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data" id="userForm">
<?php
	$UID = $_SESSION["uid"];
	
	$sql = "SELECT * FROM userAddress WHERE user_id ='$UID'";

	$res_data = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($res_data)){
		echo("
			<div class=\"mb-3\">
				<a class=\"address-tag\" href=\"../userEditAddress.php\" name=\"edit\" value=".$row["address_id"]." onclick=\"document.getElementById('userForm').submit()\">
					<div class=\"address\">
						<p style=\"font-weight: bold; font-size: 1.6rem;\">".$row["contact_name"]."</p>
						<div class=\"row\">
							<div class=\"col-lg-4\">
								<p style=\"font-size: 1.3rem;\">".$row["phone_number"]."</p>
								<p style=\"font-size: 1.15rem;\">
								".$row["address"]."
								".$row["postal_code"]."
								".$row["area"]."
								".$row["state"]."
								".$row["country"]."
								</p>
							</div>
						</div>
					</div>
					<button name=\"remove\" value=".$row["address_id"]." class=\"btn btn-primary\"><i class='fa fa-trash' aria-hidden='true'></i></button>
				</a>
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