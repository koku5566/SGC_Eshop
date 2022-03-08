<?php
    require_once "mysqli_connect.php";
?>

<?php

    function SanitizeString(string $str):string{
		if(get_magic_quotes_gpc()){
			$str = stripslashes($str); // take out all backslash inside the string
		}
		$str = strip_tags($str);//take out all html tag
		$str = htmlentities($str, ENT_QUOTES);
		
        return $str;
    }

    if(!isset($_SESSION)){
        session_start();
    }

    $_SESSION['Restaurant_ID'] = "";

    if(!isset($_SESSION['isLogin']))
    {
        $_SESSION['isLogin']  = false;
    }
    if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] == false){
		header('Location: Login.php');
		exit;
	}
    if(!isset($_SESSION['username']))
    {
        $_SESSION['username']  = "";
    }
    if(!isset($_SESSION['userid']))
    {
        $_SESSION['userid']  = "";
    }
    if(!isset($_SESSION['position']))
    {
        $_SESSION['position']  = "";
    }
    if(!isset($_SESSION['address']))
    {
        $_SESSION['address']  = "";
    }
    if(isset($_POST['SessionLocation']))
    {
        $_SESSION['address'] = $_POST['SessionLocation'];
    }
    if(!isset($_SESSION['SearchRestaurant']))
    {
        $_SESSION['SearchRestaurant']  = "";
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Save Change of the cart
        if(isset($_POST['SaveCart']))
        {
            if(isset($_SESSION['userid'],$_POST['productid'],$_POST['productimg'],$_POST['productname'],$_POST['type'],$_POST['price'],$_POST['remarks'],$_POST['status'],$_POST['quantity']))
            {
                $userid = $_SESSION['userid'];
                $productid = $_POST['productid'];
                $productimg = $_POST['productimg'];
                $productname = $_POST['productname'];
                $type = $_POST['type'];
                $price = $_POST['price'];
                $remarks = $_POST['remarks'];
                $status = $_POST['status'];
                $quantity = $_POST['quantity'];

                // sql to delete a record
                $sql = "DELETE FROM user_cart WHERE User_ID = '$userid' ";
                mysqli_query($conn, $sql);

                for($i=0, $count = count($productid); $i<$count; $i++) {

                    $pid  = $productid[$i];
                    $pimg = $productimg[$i];
                    $pname = $productname[$i];
                    $ptype = $type[$i];
                    $pprice = $price[$i];
                    $premark = $remarks[$i];
                    $pstatus = $status[$i];
                    $pquantity = $quantity[$i];

                    $sql_getRestaurantID = "SELECT * FROM product WHERE Product_ID = '$pid' ";
                    $result = mysqli_query($conn, $sql_getRestaurantID);
                            
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $restaurantid = $row['Restaurant_ID'];
                        }
                    }

                    $sql_getRestaurantName = "SELECT * FROM restaurant WHERE Restaurant_ID = '$restaurantid'";
                    $result = mysqli_query($conn, $sql_getRestaurantName);
                            
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $restaurantName = $row['Name'];
                        }
                    }

                    $sql_insert = "INSERT INTO user_cart (User_ID, Restaurant_Name, Product_ID,Product_img,Product_Name,Type,Quantity,Price,Remarks,Status)
                    VALUES ('$userid','$restaurantName','$pid', '$pimg', '$pname', '$ptype', '$pquantity', '$pprice','$premark','$pstatus')";

                    mysqli_query($conn, $sql_insert);
                }
            }
            else if (isset($_SESSION['userid']))
            {
                $userid = $_SESSION['userid'];
                $sql = "DELETE FROM user_cart WHERE User_ID = '$userid' ";
                mysqli_query($conn, $sql);
            }
        }
        //CheckOut the cart
        if(isset($_POST['contact'],$_POST['address'],$_POST['remark'],$_POST['total']))
        {
            $userid = $_SESSION['userid'];
            $username = $_SESSION['username'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $Temp = new DateTime("now", new DateTimeZone('Asia/Kuala_Lumpur') );
            $datePlaced = $Temp->format('Y-m-d H:i:s');
            $total = $_POST['total'];
            $remark = $_POST['remark'];

            $sql_order = "INSERT INTO order_tb (User_ID,User_Name,Contact,Address,Order_Status,Status,Date_Order_Placed,Total,Remark)
                          VALUES ('$userid','$username','$contact','$address','Waiting','0','$datePlaced','$total','$remark')";
            if (mysqli_query($conn, $sql_order)) {
                $last_id = mysqli_insert_id($conn);
            }

            $sql_update = "UPDATE user_cart SET Status = '1', Order_ID = '$last_id' WHERE User_ID = '$userid' AND Status = '0'";
            mysqli_query($conn, $sql_update);

            $sql_u = "SELECT * FROM user WHERE User_ID = '$userid'";
            $result = mysqli_query($conn, $sql_u);
                            
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $uemail = $row['Email'];
                }
            }

            echo("<script>alert(\"Order Succesful\")</script>");

            //Send Invoice
            $to = $uemail;
            $subject = "Invoice From Koala Delivery";
            $from = "maverickleeweilin88@gmail.com";
            $from2 = "maverickleeweilin88@gmail.com"; //show error when failed to send to recepient
            $fromName = "Koala Delivery";

            $headers =  "From: $fromName <$from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/mixed;\r\n";
            
            $message = "

            <p>Thank you for using our delivery !
            <br>Here is the invoice for your order
            <br>
            <br>------------------------------------------------------------------------------------------------------------------------------------------------
            <br>Koala Deliver
            <br>Username   : $username
            <br>Contact    : $contact
            <br>Address    : $address
            <br>Invoice ID : $last_id
            <br>Date       : $datePlaced
            <br>------------------------------------------------------------------------------------------------------------------------------------------------
            </p>";

            $message .= "
            <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Remark</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>";
            $SubTotal = 0;    
            $sql_invoice = "SELECT * FROM user_cart WHERE Order_ID = '$last_id'";
            $result = mysqli_query($conn, $sql_invoice);
                            
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $message .= "<tr>
                            <td>".$row['Product_Name']."</td>
                            <td>".$row['Remarks']."</td>
                            <td>".$row['Quantity']."</td>
                            <td class = \"text-align-right\">".number_format((float)$row['Price'], 2, '.', '')."</td>
                            <td class = \"text-align-right\">".number_format((float)($row['Quantity'] *$row['Price']), 2, '.', '')."</td>
                        </tr>
                            ";
                    $SubTotal += ($row['Quantity'] *$row['Price']);
                }
            }

            $sqlDeliverFees = "SELECT COUNT(DISTINCT Restaurant_Name) AS Total FROM user_cart WHERE Order_ID = '$last_id'";
            $resultDeliverFees = mysqli_query($conn, $sqlDeliverFees);
            if (mysqli_num_rows($resultDeliverFees) > 0) {
                while($row = mysqli_fetch_assoc($resultDeliverFees)) {
                    $DeliveryFees = 5* $row['Total'];
                    $DeliverTime = 20 + 10 * $row['Total'];
                }
            }
            $Total = $SubTotal + $DeliveryFees;
            $message .= "<tr style = \"padding-top:20px;\">
                    <td>SubTotal</td>
                    <td></td>
                    <td></td>
                    <td>RM</td>
                    <td class = \"text-align-right\">".number_format((float)$SubTotal, 2, '.', '')."</td>
                </tr>
                <tr class = \"CheckOutTable-div-SubTotal\">
                    <td>Delivery Fees</td>
                    <td></td>
                    <td></td>
                    <td>RM</td>
                    <td class = \"text-align-right\">".number_format((float)$DeliveryFees, 2, '.', '')."</td>
                </tr>
                <tr class = \"CheckOutTable-div-Total\">
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td>RM</td>
                    <td class = \"text-align-right\">".number_format((float)$Total, 2, '.', '')."</td>
                </tr>
            ";

            $message .= "            
            </tbody>
            </table>
            ";

            $HTMLcontent = "<p><b>Dear $username</b>,</p><p>$message</p>";
            
            $boundary = md5(time());
            $headers .= " boundary=\"{$boundary}\"";

            $message = "--{$boundary}\r\n";
            $message .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
            $message .= "Content-Transfer-Encoding: 7bit\r\n";
            $message .= $HTMLcontent . "\r\n";
            
            $message .= "--{$boundary}\r\n";
            $returnPath = "-f" . $from2;
            
            if(@mail($to, $subject, $message, $headers, $returnPath)){
                echo "<script>alert('Email send succesful')</script>";
            }
            else{
                echo "<script>alert('Failed to send email')</script>";
            }

            echo("<script>window.location.href = window.location.href;</script>");
        }
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

    <title>SGC E-Shop</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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

                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                        <div class="sidebar-brand-icon">
                            <img src="img/segilogo.png" style="width:50px;height:50px;" alt="">
                        </div>
                        <div class="sidebar-brand-text mx-3">SGC E-Shop</div>
                    </a>

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
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
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
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
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
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
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
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
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
                                    src="img/undraw_profile.svg">
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