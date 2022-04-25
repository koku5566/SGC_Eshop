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
    date_default_timezone_set("Asia/Kuala_Lumpur");
    function SanitizeString(string $str):string{
		if(get_magic_quotes_gpc()){
			$str = stripslashes($str); // take out all backslash inside the string
		}
		$str = strip_tags($str);//take out all html tag
		$str = htmlentities($str, ENT_QUOTES);
		
        return $str;
    }

    /*
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
    */
      
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
    if(!isset($_SESSION['uid']))
    {
        $_SESSION['uid'] = "";
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

    <title>SGC E-Shop</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/classic.css" rel="stylesheet">

</head>

<body id="page-top">
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                        <div class="sidebar-brand-icon">
                            <img src="img/segilogo.png" style="width:50px;height:50px;" alt="">
                        </div>
                        <div class="sidebar-brand-text mx-3">SGC E-Shop</div>
                    </a>

                    <!-- Topbar Search -->
                    <form method="get" action="<?php echo htmlspecialchars("/search.php");?>" 
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input id="searchInput" name="Search" type="text" class="form-control bg-light border-0 small" placeholder="Search for...">
                            <div class="input-group-append" id="searchButton">
                                <button class="btn btn-primary" type="submit">
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
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
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

                        <!--Login-->
                        <?php if ($_SESSION['login'] == true) :?>

                        <!--Cart-->
                        <li class="nav-item no-arrow">
                            <a class="nav-link" href="cart.php">
                                <i class="fas fa-shopping-cart fa-sm fa-fw mr-2 text-gray-400"></i>
                            </a>
                        </li>
                        
                        <div class="topbar-divider d-none d-sm-block"></div>

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
                                <a class="dropdown-item" href="../admin/adminManage.php">
                                    <i class="fa-solid fa-repeat fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Admin
                                </a>
                                <?php endif?>

                                <?php if ($_SESSION['login'] == true && $_SESSION['role'] == "SELLER") :?>
                                <a class="dropdown-item" href="../seller/viewShippingOrders.php">
                                    <i class="fa-solid fa-repeat fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Seller
                                </a>
                                <?php endif?>

                                <?php if ($_SESSION['login'] == true && $_SESSION['role'] == "USER") :?>
                                <a class="dropdown-item" href="../userProfile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Account
                                </a>
                                <a class="dropdown-item" href="../getOrder.php">
                                    <i class="fa-solid fa-dollar-sign fa-sm fa-fw mr-2 text-gray-400"></i>
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
                <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6266a4827b967b11798c6607/1g1gf57tj';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
                <!-- End of Topbar -->