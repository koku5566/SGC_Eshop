<?php
    require_once __DIR__ . '/mysqli_connect.php'
?>

<?php

    $domain_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

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
    if(!isset($_SESSION['role']))
    {
        $_SESSION['role'] = "";
    }

    //Set true to enable seller register
    $_SESSION['enableSeller'] = false;
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - SGC E-Shop</title>

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

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon">
                    <img src="../img/segilogo.png" style="width:50px;height:50px;" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">SGC E-Shop</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Shipment Collapse Menu -->
            <?php if ($_SESSION['login'] == true && $_SESSION['role'] == "ADMIN") :?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin"
                    aria-expanded="true" aria-controls="collapseAdmin">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Admin Panel</span>
                </a>
                <div id="collapseAdmin" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../admin/adminManageUser.php">User Management</a>
                        <a class="collapse-item" href="../admin/adminManage.php">Product Management</a>
						<a class="collapse-item" href="../admin/review.php">Product Review</a>
                        <a class="collapse-item" href="../admin/category.php">Category Management</a>
                        <a class="collapse-item" href="../admin/promotion.php">Promotion Management</a>
                        <a class="collapse-item" href="../admin/adminTransaction.php">Transaction History</a>
                        <a class="collapse-item" href="../admin/adminViewShipping.php">Order Delivery History</a>
                        <a class="collapse-item" href="../admin/eventAdminDashboard.php">Event Management</a>
						<a class="collapse-item" href="../admin/helpCenterAdmin1.php">Help Center</a>

                    </div>
                </div>
            </li>
            <?php endif?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!--Login-->
                        <?php if ($_SESSION['login'] == true) :?>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo($_SESSION['name']);?></span>
                                <!--User Profile Picture-->
                                <?php
                                $UID = $_SESSION["id"];
                                $sql = "SELECT profile_picture FROM user WHERE username = '$UID'";

                                $res_data = mysqli_query($conn,$sql);
                                if (mysqli_num_rows($res_data) > 0){
                                    while($row = mysqli_fetch_array($res_data)){
                                        echo("
                                            <img class=\"img-profile rounded-circle\" style=\"object-fit:cover;\" src=\"data:image;base64,".base64_encode($row["profile_picture"])."\">
                                            ");
                                        }
                                    }
                                ?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!--Admin Panel-->
                                <?php if ($_SESSION['login'] == true && $_SESSION['role'] == "ADMIN") :?>
                                <a class="dropdown-item" href="../index.php">
                                    <i class="fa-solid fa-repeat fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Buyer
                                </a>
                                <?php endif?>
                            
                                <a class="dropdown-item" href="../userProfile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Account
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                        <?php else :?>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #a31f37;"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Sign Up</a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../register.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Buyer
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