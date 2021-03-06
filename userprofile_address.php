<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false || $_SESSION['role'] == "SELLER")
	{
		?><script>window.location = '<?php echo("$domain/E404.php");?>'</script><?php
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
                                        <div class="h1 text-gray-900 mb-4 container-left-col2">My Address Book</div>
										<div class="container-right-col2"><a class="btn btn-primary" href="../userAddAddress.php"><i class="fa-solid fa-plus"></i></a></div>
                                    </div>
									<hr>
<?php
	$UID = $_SESSION["userid"];
	
	$sql = "SELECT * FROM userAddress WHERE user_id ='$UID'";

	$res_data = $conn->query($sql);
	if($res_data->num_rows>0){
		while($row = $res_data->fetch_assoc()){
			echo("
				<div class=\"row\" style=\"border-left: 3px solid #a31f37; margin-bottom: 1rem;\">
					<div class=\"col-11\" style=\"background-color: lightyellow;\">
						<a class=\"address-tag\" href=\"../userEditAddress.php?address-id=".$row["address_id"]."\">
							<div class=\"container-col2\">
								<div class=\"container-left-col2\">
									<p style=\"font-weight: bold; font-size: 1.6rem;\">".$row["contact_name"]."</p>
									<p style=\"font-size: 1.3rem;\">".$row["phone_number"]."</p>
									<p style=\"font-size: 1.15rem;\">".$row["address"].", ".$row["postal_code"]." ".$row["area"].", ".$row["state"].", ".$row["country"]."</p>
								</div>
							</div>
						</a>
					</div>
					<div class=\"col-1\">
						<form method=\"post\" style=\"height:100%;width:100%;\">
							<button name=\"remove\" value=".$row["address_id"]." type=\"submit\" style=\"height:100%;\" class=\"btn btn-primary\">R<br>E<br>M<br>O<br>V<br>E</button>
						</form>
					</div>
				</div>
				");
		}
	}else{
		echo("
		<div class=\"text-center\" style=\"flex:auto;\"><p class=\"p-title\" style=\"font-size: 1.5rem;\">No Address</p></div>
		");
	}
?>
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

<style>
.container-left-col2 {
	width: 100%;
	display: table-cell;
	vertical-align: middle;
}
.container-right-col2 {
	width: 20%;
	display: table-cell;
	vertical-align: middle;
}

@media only screen and (max-width: 768px) {
	.container-left-col2 {
	display: block;
	}
	.container-right-col2 {
	display: block;
	}
}
</style>