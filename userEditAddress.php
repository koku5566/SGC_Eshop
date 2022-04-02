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
<h1>Address</h1>
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
				<input required type=\"tel\" name=\"contact\" pattern=\"[0-9]{4}-[0-9]{7,}\" maxlength=\"13\" placeholder=\"0000-00000000\" value=\"".$row["phone_number"]."\" class=\"form-control\"/>
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

<?php
if(isset($_SESSION['Update']))
	{
		if($_SESSION['Update'] == true)
		{
			echo "<script>alert('Details Updated');
			window.location.href='userprofile_address.php';</script>";
		}
		$_SESSION['Update'] = NULL;
	}
?>

<?php require __DIR__ . '/footer.php' ?>