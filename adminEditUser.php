<?php
	$title = "RTX-Tech ADMIN PANEL";
	include "Header.php";
	
	if($_SESSION['login'] == false || $_SESSION['role'] == "admin")
	{
		echo "<script>alert('Login as Admin account to access');
			window.location.href='Main.php';</script>";
    }
?>
<?php
	if(isset($_POST['update']))
	{
		$UID = $_SESSION['ToEdit'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$user = $_POST['user'];

		$sql_u = "SELECT * FROM user WHERE userID = '$UID'";

		$stmt_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($stmt_u) > 0) {
			
			if($_POST['password'] != ""){
				$sql = "UPDATE user SET name='$name', email='$email', password='$password', contact='$contact', address='$address', ADMIN='$user' WHERE userID='$UID'";
			}
			else{
				$sql = "UPDATE user SET name='$name', email='$email', contact='$contact', address='$address', ADMIN='$user' WHERE userID='$UID'";
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

<div id="title"><h2>ADMIN PANEL</h2></div>
<div id="AdminPanel">
<div id = "Panel">
	<a class="nav" href="ADMIN-Product.php">Product</a>
	<a class="nav active" href="ADMIN-User.php">User</a>
	<a class="nav" href="ADMIN-Statistic.php">Statistic</a>
</div>

<div id="DataDiv">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
<?php
	$UID = $_SESSION['ToEdit'];
	$sql = "SELECT * FROM user WHERE userID = '$UID'";
	$res_data = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res_data) > 0){
		while($row = mysqli_fetch_array($res_data)){
			echo("
				<input name=\"product\" value=\"".$row["userID"]."\" hidden/>
				
				<p id=\"label\">User Category
				<select id=\"user\" name=\"user\">
				");
				if($row['ADMIN'] == 0)
				{
					echo("<option value=\"0\" selected=\"selected\">User</option>
					<option value=\"1\">Admin</option>");
				}
				else{
					echo("<option value=\"0\">User</option>
					<option value=\"1\" selected=\"selected\">Admin</option>");
				}
				echo("
				</select></p>
				
				<p id=\"label\">Name</p>
				<input required type=\"text\" name=\"name\" maxlength=\"50\" value=\"".$row["name"]."\"/>
				
				<p id=\"label\">Email Address</p>
				<input required type=\"text\" name=\"email\" maxlength=\"50\" placeholder=\"xxxxx@xxx.xxx\" value=\"".$row["email"]."\"/>
				
				<p id=\"label\">Password</p>
				<input type=\"password\" name=\"password\" maxlength=\"50\"/>
				
				<p id=\"label\">Contact</p>
				<input required type=\"tel\" name=\"contact\" pattern=\"[0-9]{3}-[0-9]{7-8}\" maxlength=\"12\" placeholder=\"000-0000000\" value=\"".$row["contact"]."\"/>
				
				<p id=\"label\">Address</p>
				<textarea required type=\"text\" name=\"address\" maxlength=\"999\">".$row["address"]."</textarea><br><br>
				
				<button type=\"submit\" name=\"update\">Update</button>
				");
		}
	}
	/*<input required type=\"password\" name=\"password\" pattern=\".{8,}\" maxlength=\"50\" value=\"".$row["password"]."\"/>*/
?>
</form>
<?php
if(isset($_SESSION['Update']))
	{
		if($_SESSION['Update'] == true)
		{
			echo "<script>alert('Details Updated');
			window.location.href='ADMIN-User.php';</script>";
		}
		$_SESSION['Update'] = NULL;
	}
?>
</div>
</div>

<?php include "Footer.php"; ?>