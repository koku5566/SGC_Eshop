<?php require_once __DIR__ . '/mysqli_connect.php' ?>

<?php

    $domain_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

    //Load Search Auto Complete Array
    $sql = "SELECT product_name FROM product";
    $result = mysqli_query($conn, $sql);

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $productArray[] = $row;
    }

    function SanitizeString(string $str){
		if(get_magic_quotes_gpc()){
			$str = stripslashes($str); // take out all backslash inside the string
		}
		$str = strip_tags($str);//take out all html tag
		$str = htmlentities($str, ENT_QUOTES);
		
        return $str;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['search'])) {
            $searchTerm = test_input($_POST["search"]);
            // check if name only contains letters and whitespace
            if (preg_match("/^[a-zA-Z-' ]*$/",$searchTerm)) {
                ?>
                    <script type="text/javascript">
                    window.location.href = window.location.origin + "/search.php?search=<?php echo($searchTerm)?>";
                    </script>
                <?php

            }
        }
      }
      
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(!isset($_SESSION)){
        session_start();
    }
    
    //Login
    if(!isset($_SESSION['login']))
    {
        $_SESSION['login'] = false;
    }
    if(!isset($_SESSION['name']))
    {
        $_SESSION['name'] = "";
    }
    if(!isset($_SESSION['id']))
    {
        $_SESSION['id'] = "";
    }
    if(!isset($_SESSION['userid']))
    {
        $_SESSION['userid'] = "";
    }
    if(!isset($_SESSION['userid']))
    {
        $_SESSION['userid'] = "";
    }
    if(!isset($_SESSION['role']))
    {
        $_SESSION['role'] = "";
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Merchant Login- SGC E-Shop</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/sellerClassic.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/index.php">
                        <div class="sidebar-brand-icon">
                            <img src="/img/segilogo.png" style="width:50px;height:50px;" alt="">
                        </div>
                        <div class="sidebar-brand-text mx-3">SGC E-Shop</div>
                    </a>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!--Login-->
                        <?php if ($_SESSION['login'] == true) :?>
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler ?? 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun ?? 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez ?? 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog ?? 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo($_SESSION['name']);?></span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../seller/shopProfile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Account
                                </a>

                                <!--Admin Panel-->
                                <?php if ($_SESSION['login'] == true && $_SESSION['role'] == "ADMIN") :?>
                                <a class="dropdown-item" href="../admin.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    ADMIN PANEL
                                </a>
                                <?php endif?>

                                <?php if ($_SESSION['login'] == true && $_SESSION['role'] != "ADMIN") :?>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Purchase
                                </a>
                                <?php endif?>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                        <?php else :?>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #a31f37;">Sign Up</a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../register.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    User
                                </a>

                                <a class="dropdown-item" href="../seller/sellerRegister.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Seller
                                </a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #a31f37;"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Sign Up</a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../register.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    User
                                </a>

                                <?php if($_SESSION['enableSeller'] == true):?>
                                <a class="dropdown-item" href="../seller/sellerRegister.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Seller
                                </a>
                                <?php endif?>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item no-arrow">
                            <a class="nav-link" href="../login.php" style="color: #a31f37;"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Login</a>
                        </li>
                        <?php endif?>

                    </ul>

                </nav>
                <!-- End of Topbar -->

<?php
if(isset($_POST['signup']))
	{
		$_SESSION['AddUser'] = false;
		if(!empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['username'],$_POST['password']))
		{
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$password1 = md5($_POST['password1']);
			$contact = ("6010-0000000");
			$date = date("d/m/Y");

			if($password==$password1){
				$sql_u = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";

				$stmt_u = mysqli_query($conn, $sql_u);

				if (mysqli_num_rows($stmt_u) > 0) {	
					echo("<script>alert('Username or Email Already Exists');</script>");
				}
				else
				{
					$sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'sgcprot1_SGC_ESHOP' AND TABLE_NAME = 'user'";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)) {
							$userid = $row["AUTO_INCREMENT"];

							$sql  = "INSERT INTO user (user_id, username, email, password, name, contact, registration_date, role)
							VALUES ((SELECT CONCAT('U',(SELECT LPAD((SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'sgcprot1_SGC_ESHOP' AND TABLE_NAME = 'user'), 6, 0))) AS newUserId),'$username','$email','$password','$username','$contact','$date','SELLER')";		
							
                            if (mysqli_query($conn, $sql)) {
								$_SESSION['AddUser'] = true;

								$sql = "INSERT INTO shopProfile (shop_id, shop_name) VALUES ((SELECT CONCAT('U',(SELECT LPAD('$userid', 6, 0)))),'$username')";

								if (mysqli_query($conn, $sql)) {
									echo "<script>alert('Registered Successful');
									window.location.href='sellerLogin.php';</script>";
								}
								else {
									echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
							} 
							else {
								echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
						}
					}
					mysqli_close($conn);
				}
			}
			else
			{
				echo("<script>alert('Password NOT Match');</script>");
			}
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
                                <div class="h1 text-gray-900 mb-4">Sign Up</div>
								<div class="h3 mb-4">Create Your SEGi Group of Colleges E-Shop Seller Account</div>
                            </div>

                            <form class="user" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
										<label>Email Address</label>
										<input required type="email" name="email" class="form-control" id="inputEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" placeholder="xxxxx@xxx.xxx"/>
                                    </div>
									
                                    <div class="col-sm-6">
										<label>Username</label>
										<input required type="text" name="username" class="form-control" id="inputUsername" maxlength="50" placeholder="Enter Your Username">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
										<label>Password</label>
										<input required type="password" name="password" class="form-control" id="inputPassword" maxlength="50" pattern="(?=.*\d).{8,}" placeholder="Use 8 or more characters with a mix of letters and numbers" title="Use 8 or more characters with a mix of letters and numbers">
                                    </div>
                                    <div class="col-sm-6">
										<label>Confirm Password</label>
										<input required type="password" name="password1" class="form-control" id="inputRepeatPassword" maxlength="50">
                                    </div>
                                </div>

								<div class="form-group">
									<div class="custom-control custom-checkbox small">
										<input required type="checkbox" class="custom-control-input" id="customCheck">
										<label class="custom-control-label" for="customCheck">By Clicking "SIGN UP", I Agree to SEGi Group Colleges E-Shop's <a href="x.php">Terms of Use</a> and <a href="x.php">Privacy Policy</a></label>
									</div>
                                </div>

								<button type="submit" class="btn btn-primary btn-block" name="signup">SIGN UP</button>
                            </form>

                            <hr>
                            <div class="text-center">
								Already Have an Account?<a href="../seller/sellerLogin.php"> Login </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_SESSION['AddUser']))
	{
		if($_SESSION['AddUser'] == true)
		{
			echo("");
		}
		$_SESSION['AddUser'] = NULL;
	}
?>

<?php require __DIR__ . '/footer.php' ?>