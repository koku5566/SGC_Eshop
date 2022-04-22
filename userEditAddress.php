<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false)
	{
		?><script>window.location = '<?php echo("$domain/login.php");?>'</script><?php
		exit;
    }
?>

<?php
	if(isset($_GET['address-id'])){
		$_SESSION['ToEdit']=$_GET['address-id'];
	}
	else
	{
		?><script>window.location = '<?php echo("$domain/userprofile_address.php");?>'</script><?php
	}

	if(isset($_POST['update']))
	{
		$UID = $_SESSION['ToEdit'];
		$name = $_POST['name'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$postal = $_POST['postal'];
		$area = $_POST['area'];
		$state = $_POST['state'];
		$country = $_POST['country'];

		$sql_u = "SELECT * FROM userAddress WHERE address_id = '$UID'";

		$stmt_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($stmt_u) > 0) {
			if($_POST['address'] != ""){
				$sql = "UPDATE userAddress SET contact_name='$name', phone_number='$contact', address='$address', postal_code='$postal', area='$area', state='$state', country='$country' WHERE address_id='$UID'";
			}
			else
			{
				echo("<script>alert('Error');</script>");
			}
		
			if (mysqli_query($conn, $sql)) {
				$_SESSION['Update'] = true;
				echo "<script>alert('Details Updated');
				window.location.href='userprofile_address.php';</script>";
				
			}
			else
			{
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
                                        <div class="h1 text-gray-900 mb-4">Address</div>
                                    </div>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
<?php
	$UID = $_SESSION['ToEdit'];
	$sql = "SELECT * FROM userAddress WHERE address_id = '$UID'";
	$res_data = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res_data) > 0){
		while($row = mysqli_fetch_array($res_data)){
			echo("
				<input name=\"product\" value=\"".$row["address_id"]."\" hidden/>

				<div class=\"form-group\">
				<label>Contact Name</label>
				<input required type=\"text\" name=\"name\" maxlength=\"50\" value=\"".$row["contact_name"]."\" class=\"form-control\"/>
				</div>

				<div class=\"form-group\">
				<label>Contact Number</label>
				<input required type=\"tel\" name=\"contact\" pattern=\"[0-9]{2,3,4}-[0-9]{7,}\" maxlength=\"13\" placeholder=\"0000-00000000\" value=\"".$row["phone_number"]."\" class=\"form-control\"/>
				</div>

				<div class=\"form-group\">
				<label>Address</label>
				<input required type=\"text\" name=\"address\" maxlength=\"50\" value=\"".$row["address"]."\" class=\"form-control\"/>
				</div>

				<div class=\"form-group\">
				<label>Postal Code</label>
				<input required type=\"text\" name=\"postal\" pattern=\"[0-9]{1,}\" maxlength=\"10\" value=\"".$row["postal_code"]."\" class=\"form-control\"/>
				</div>

				<div class=\"form-group\">
				<label>Area</label>
				<input required type=\"text\" name=\"area\" maxlength=\"50\" value=\"".$row["area"]."\" class=\"form-control\"/>
				</div>

				<div class=\"form-group\">
				<label>State</label>
				<input required type=\"text\" name=\"state\" maxlength=\"50\" value=\"".$row["state"]."\" class=\"form-control\"/>
				</div>

				<div class=\"form-group\">
				<label>Country</label>
				<input required type=\"text\" name=\"country\" maxlength=\"50\" value=\"".$row["country"]."\" class=\"form-control\"/>
				</div>
				
				<button type=\"submit\" class=\"btn btn-primary btn-block\" name=\"update\">Update</button>
				");
		}
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