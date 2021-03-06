<?php
    require_once __DIR__ . '/mysqli_connect.php'
?>

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

    function SanitizeString(string $str):string{
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
    if(!isset($_SESSION['isLogin']))
    {
        $_SESSION['isLogin'] = false;
    }
    if(!isset($_SESSION['name']))
    {
        $_SESSION['name'] = "";
    }
    if(!isset($_SESSION['id']))
    {
        $_SESSION['id'] = "";
    }
    if(!isset($_SESSION['admin']))
    {
        $_SESSION['admin'] = 0;
    }

    if($_SESSION['isLogin'] == true)
	{
	echo "<script>alert('Logout to continue');
		window.location.href='Main.php';</script>";
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

    <title>Merchant - SGC E-Shop</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="../img/segilogo.png" style="width:50px;height:50px;" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">SGC E-Shop</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Shipment Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShipment"
                    aria-expanded="true" aria-controls="collapseShipment">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Shipment</span>
                </a>
                <div id="collapseShipment" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="login.html">My Shipment</a>
                        <a class="collapse-item" href="register.html">Mass Ship</a>
                        <a class="collapse-item" href="forgot-password.html">Shipping Setting</a>
                    </div>
                </div>
            </li>

             <!-- Nav Item - Order Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder"
                    aria-expanded="true" aria-controls="collapseOrder">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Order</span>
                </a>
                <div id="collapseOrder" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="login.html">My Order</a>
                        <a class="collapse-item" href="register.html">Cancellation</a>
                        <a class="collapse-item" href="forgot-password.html">Return/Refund</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Product Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
                    aria-expanded="true" aria-controls="collapseProduct">
                    <i class="fas fa-fw fa-suitcase"></i>
                    <span>Product</span>
                </a>
                <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="myProduct.php">My Product</a>
                        <a class="collapse-item" href="addProduct.php">Add New Product</a>
                        <a class="collapse-item" href="violationProduct.php">Product Violations</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Marketing Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMarketing"
                    aria-expanded="true" aria-controls="collapseMarketing">
                    <i class="fas fa-fw fa-tag"></i>
                    <span>Marketing Centre</span>
                </a>
                <div id="collapseMarketing" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="utilities-color.html">Promotion</a>
                        <a class="collapse-item" href="utilities-border.html">Voucher</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Finance Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinance"
                    aria-expanded="true" aria-controls="collapseFinance">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>Finance</span>
                </a>
                <div id="collapseFinance" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="login.html">My Income</a>
                        <a class="collapse-item" href="register.html">My Balance</a>
                        <a class="collapse-item" href="forgot-password.html">Bank Account</a>
                        <a class="collapse-item" href="forgot-password.html">Payment Settings</a>
                    </div>
                </div>
            </li>

             <!-- Nav Item - Shop Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShop"
                    aria-expanded="true" aria-controls="collapseShop">
                    <i class="fas fa-fw fa-shopping-bag"></i>
                    <span>Shop</span>
                </a>
                <div id="collapseShop" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="login.html">Shop Rating</a>
                        <a class="collapse-item" href="register.html">Shop Profile</a>
                        <a class="collapse-item" href="forgot-password.html">Shop Decoration</a>
                        <a class="collapse-item" href="forgot-password.html">Shop Categories</a>
                        <a class="collapse-item" href="forgot-password.html">My Reports</a>
                    </div>
                </div>
            </li>

             <!-- Nav Item - Setting Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting"
                    aria-expanded="true" aria-controls="collapseSetting">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Setting</span>
                </a>
                <div id="collapseSetting" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="login.html">My Address</a>
                        <a class="collapse-item" href="register.html">Shop Setting</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Customer Services -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Customer Services</span></a>
            </li>

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

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

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
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
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
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
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
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

 <!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">

<!-- Page Heading -->
<h1 style="padding: 0px;width: 314.6px;text-align: center;margin-left: 550px;color: rgb(162,30,30);">My Order</h1>
   
</div><br>

<!-- Content Row -->
<div class="row">
<!-- Content Row -->
<div class="row">
  <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;margin-left:40px;
  box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
  border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">ALL</button>
  <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
  box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
  border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">UNPAID</button>
  <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
  box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
  border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">TO SHIP</button>
  <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
  box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
  border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">SHIPPING</button>
  <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
  box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
  border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">COMPLETE</button>
  <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
  box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
  border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">RETURN/REFUND</button>
</div>
<!----------------Back Button------------------->
<button class="btn btn-primary" type="button" style="width: 89.5px;padding-left: 6px;margin-left: 12px;background: rgba(13,110,253,0);color: var(--bs-blue);border-style: none;border-color: var(--bs-body-bg);text-decoration: underline;"><i class="fa fa-long-arrow-left" style="padding-right: 9px;color: var(--bs-blue);background: rgba(255,255,255,0);"></i>Back</button>
  <br>
  <br>
  
<!---------------Search----------------------->
  
<h1 style="width: 354px;margin-left: 130px;margin-top: 20px;font-size: 25px;">Search OrderID</h1>
<input type="search" id="searchID" onkeyup="myFunction()" style="margin-left: 130px;width: 1130px;height: 40px;" placeholder="Input" />
  <!---------------The Button---------------------->
<button class="btn btn-primary" type="button" style="width: 104.5px;height: 45px;margin-left: 1020px;padding-right: 12px;margin-right: 15px;margin-top: 15px;color: var(--bs-gray-400);background: rgba(206,212,218,0);border: 2px solid var(--bs-gray-400);">RESET</button>
<button class="btn btn-primary" type="button" style="width: 104.5px;height: 45px;margin-top: 15px;background: rgb(162,30,30);border-style: none;">SEARCH</button>   
<br>
<!--<script>
function myFunction(){
var input
input = document.value.getElementby("searchID");


}
</script>-->
<!-------------------The Product row-------------------------------->
<br>
<br>
<div style="height: 700px;width: 1096px;margin-left: 155px;border-width: 0px;border-style: solid;">
<div style="height: 55px;border: 3px solid rgba(173,181,189,0.5);">
  <br>
<span style="padding-left: 5px;font-size: 19px;font-weight: bold;width: 69px;">Product(s)</span>
<span style="padding-left: 350px;font-size: 19px;font-weight: bold;width: 69px;">SKU</span>
<span style="padding-left: 120px;font-size: 19px;font-weight: bold;width: 69px;">OrderID</span>
<span style="padding-left: 120px;font-size: 19px;font-weight: bold;width: 69px;">Status</span>
<span style="padding-left: 100px;font-size: 19px;font-weight: bold;width: 69px;">Action</span>
</div>
</div>          
<!---------------------Shipping Product List----------------------------->
</div>
  <div style="border-style: solid;height: 155px;width: 1082px;margin-left: 144px;">
  <img style="width: 131px;height: 116px;margin-left: 13px;margin-top: 17px;" />
    <p style="width: 241px;margin-left: 164px;
    margin-top: -115px;height: 100px;border-style: none;">prod_Name</p>
    <p style="width: 146px;margin-left: 444px;
    margin-top: -113px;height: 48px;border-style: none;">SKU</p>
    <p style="width: 145px;margin-left: 630px;
    margin-top: -64px;height: 48px;border-style: none;">order_ID</p>
    <p style="width: 100px;margin-left: 807px;
    margin-top: -64px;height: 48px;border-style: none;">status</p>
    <button class="btn btn-primary" type="button" style="margin-left: 973px;
    margin-top: -114px;width: 81.5px;height: 58px;">View</button>
</div>