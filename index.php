<?php
    require __DIR__ . '/header.php'
?>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['restaurant']))
        {
            $_SESSION['Restaurant_ID'] = $_POST['restaurant'];
            echo("<script>window.location.href = \"main.php\";</script>");
        }
    }
?>
                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">

                    <!-- Content Row - Slidebar and SlideShow -->
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-0">
                            <div class="browse-menus">
                                <div class="browse-menu active">
                                    <ul class="main-menu">
                                        <!-- PHP Loop here - Category -->
                                        <?php
                                            //Check for Main Category
                                            $sql = "SELECT * FROM mainCategory";
                                            $result = mysqli_query($conn, $sql);
                                
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {

                                                    $verifier = 0;
                                                    //Check For Sub Category
                                                    $sql_1 = "SELECT * FROM subCategory WHERE main_category_id = \"".$row['main_category_id']."\"";
                                                    $result_1 = mysqli_query($conn, $sql_1);
                                        
                                                    if (mysqli_num_rows($result_1) > 0) {
                                                        $verifier = 1;
                                                        echo("
                                                            <li class=\"menu-item menu-item-has-children\" style=\"display: list-item;\">
                                                                <a href=\"https://eshop.sgcprototype2.com/?id=".$row['main_category_name']."\" class=\"nav-link\">".$row['main_category_name']."</a>
                                                                    <ul class=\"dropdown-menu\">
                                                        ");

                                                        while($row_1 = mysqli_fetch_assoc($result_1)) {
                                                            echo("
                                                                        <li class=\"menu-item\">
                                                                            <a href=\"https://eshop.sgcprototype2.com/".$row_1['sub_category_name']."\" class=\"dropdown-item\">".$row_1['sub_category_name']."</a>
                                                                        </li>
                                                            ");
                                                        }
                                                        echo("
                                                                </li>
                                                            </ul>
                                                        ");
                                                    }

                                                    if($verifier == 0)
                                                    {
                                                        //If no sub category, display as normal
                                                        echo("
                                                        <li class=\"menu-item\" style=\"display: list-item;\">
                                                        <a href=\"https://eshop.sgcprototype2.com/?id=".$row['main_category_name']."\" class=\"nav-link\">".$row['main_category_name']."</a>
                                                        </li>
                                                        ");
                                                    } 
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        
                        <!-- Slideshow -->
                        <div class="col-xl-10">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block w-100" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        </div>

                        </div>
                    </div>

                    <br>

                    <!-- Plan do for category (Not sure yet) -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- List All Product -->
                    <div class="row">
                        <!--Product List -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="Name">
                                                            <p class="card-text product-name">IPhone 10 Pro Max</p>
                                                        </div>
                                                        <div class="Tag">
                                                            <span style="border: 1px dashed red; font-size:10pt;">Student 10% discount</span>
                                                        </div>
                                                        <div class="Price">
                                                            <b><span style="font-size:16pt;">RM 4800<span></b>
                                                        </div>
                                                        <div class="Rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                        </div>
                                                        <div class="Location">
                                                           <span style="font-size: 10pt; color:grey;" >Subang Jaya</span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="Name">
                                                            <p class="card-text product-name">IPhone 10 Pro Max</p>
                                                        </div>
                                                        <div class="Tag">
                                                            <span style="border: 1px dashed red; font-size:10pt;">Student 10% discount</span>
                                                        </div>
                                                        <div class="Price">
                                                            <b><span style="font-size:16pt;">RM 4800<span></b>
                                                        </div>
                                                        <div class="Rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                        </div>
                                                        <div class="Location">
                                                           <span style="font-size: 10pt; color:grey;" >Subang Jaya</span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="Name">
                                                            <p class="card-text product-name">IPhone 10 Pro Max</p>
                                                        </div>
                                                        <div class="Tag">
                                                            <span style="border: 1px dashed red; font-size:10pt;">Student 10% discount</span>
                                                        </div>
                                                        <div class="Price">
                                                            <b><span style="font-size:16pt;">RM 4800<span></b>
                                                        </div>
                                                        <div class="Rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                        </div>
                                                        <div class="Location">
                                                           <span style="font-size: 10pt; color:grey;" >Subang Jaya</span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="Name">
                                                            <p class="card-text product-name">IPhone 10 Pro Max</p>
                                                        </div>
                                                        <div class="Tag">
                                                            <span style="border: 1px dashed red; font-size:10pt;">Student 10% discount</span>
                                                        </div>
                                                        <div class="Price">
                                                            <b><span style="font-size:16pt;">RM 4800<span></b>
                                                        </div>
                                                        <div class="Rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                        </div>
                                                        <div class="Location">
                                                           <span style="font-size: 10pt; color:grey;" >Subang Jaya</span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="Name">
                                                            <p class="card-text product-name">IPhone 10 Pro Max</p>
                                                        </div>
                                                        <div class="Tag">
                                                            <span style="border: 1px dashed red; font-size:10pt;">Student 10% discount</span>
                                                        </div>
                                                        <div class="Price">
                                                            <b><span style="font-size:16pt;">RM 4800<span></b>
                                                        </div>
                                                        <div class="Rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                        </div>
                                                        <div class="Location">
                                                           <span style="font-size: 10pt; color:grey;" >Subang Jaya</span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="Name">
                                                            <p class="card-text product-name">IPhone 10 Pro Max</p>
                                                        </div>
                                                        <div class="Tag">
                                                            <span style="border: 1px dashed red; font-size:10pt;">Student 10% discount</span>
                                                        </div>
                                                        <div class="Price">
                                                            <b><span style="font-size:16pt;">RM 4800<span></b>
                                                        </div>
                                                        <div class="Rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                        </div>
                                                        <div class="Location">
                                                           <span style="font-size: 10pt; color:grey;" >Subang Jaya</span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="Name">
                                                            <p class="card-text product-name">IPhone 10 Pro Max</p>
                                                        </div>
                                                        <div class="Tag">
                                                            <span style="border: 1px dashed red; font-size:10pt;">Student 10% discount</span>
                                                        </div>
                                                        <div class="Price">
                                                            <b><span style="font-size:16pt;">RM 4800<span></b>
                                                        </div>
                                                        <div class="Rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                        </div>
                                                        <div class="Location">
                                                           <span style="font-size: 10pt; color:grey;" >Subang Jaya</span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="#">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="Name">
                                                            <p class="card-text product-name">IPhone 10 Pro Max</p>
                                                        </div>
                                                        <div class="Tag">
                                                            <span style="border: 1px dashed red; font-size:10pt;">Student 10% discount</span>
                                                        </div>
                                                        <div class="Price">
                                                            <b><span style="font-size:16pt;">RM 4800<span></b>
                                                        </div>
                                                        <div class="Rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-alt"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                            <i class="fa fa-star" style="font-weight:normal;"></i>
                                                        </div>
                                                        <div class="Location">
                                                           <span style="font-size: 10pt; color:grey;" >Subang Jaya</span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

    a:hover{
        text-decoration:none;
        color:#a31f37;
    }


    .product-name{
        color:black;
        height:50px;
        overflow:hidden;
    }

    /* Category Menu */
    .browse-menus {
        position:relative;
        z-index:1;
    }

    .browse-menus .browse-menu{
        width: 100%;
        height:auto;
        z-index:0;
        background-color:#ffffff;
    }

    .browse-menu ul.main-menu{
        border: 1px solid var(--bs-gray-light);
    }

    .browse-menu .main-menu li{
        border-bottom: 1px solid #e1e1e1;
        position: relative;
        list-style: none;
    }

    .browse-menu .main-menu li a{
        padding: 0 18px;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: flex-start;
        line-height:50px;
    }

    .browse-menu .dropdown-menu {
        top: 0;
        left: 100%;
        border-bottom-width: 4px;
        border-style: solid;
        border-color: var(--bs-primary);
        position: absolute;
        z-index: 99;
        width: 220px;
        background: var(--bs-white);
        padding: 4px 0;
        margin: 0;
        border: 0;
        border-top-color: currentcolor;
        border-top-style: none;
        border-right-color: currentcolor;
        border-right-style: none;
        border-bottom-color: currentcolor;
        border-bottom-style: none;
        border-bottom-width: 0px;
        border-left-color: currentcolor;
        border-left-style: none;
        border-radius: 0;
        -moz-box-shadow: 0 -8px 16px rgba(0, 0, 0, 0.075);
        box-shadow: 0 -8px 16px rgba(0, 0, 0, 0.075);
        font-size: 1rem;
        text-align: left;
        display: block;
        opacity: 0;
        visibility: hidden;
        -webkit-transform: scaleY(0);
        transform: scaleY(0);
        -webkit-transform-origin: 0 0;
        transform-origin: 0 0;
        -webkit-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
    }

    .browse-menu .main-menu > li.menu-item-has-children > a:before,
    .main-header .widget_nav_menu li.menu-item-has-children > a:after,
    .main-footer .widget_nav_menu li.menu-item-has-children > a:after,
    .main-footer .main-menu > li.menu-item-has-children > a:before,
    .main-navbar .main-menu > li.menu-item-has-children > a:before {
        content: "\f105";
        font-family: var(--fa-style-family,);
        font-weight: 700;
        position: absolute;
        top: 0;
        right: 8px;
        bottom: 0;
        display: flex;
        align-items: center;
        color: inherit;
        font-size: 16px;
        -webkit-transition: var(--bs-transition);
        transition: var(--bs-transition);
    }

    .browse-menu .main-menu > li.menu-item-has-children > a:before {
        right: 23px;
        color: #ADA7A9;
    }

    .browse-menu .main-menu > li.menu-item-has-children:hover > a:before,
    .browse-menu .main-menu > li.menu-item-has-children.focus > a:before {
        right: 20px;
        color: var(--bs-primary);
    }

    .main-header .widget_nav_menu li.menu-item-has-children.focus > a:after,
    .main-footer .widget_nav_menu li.menu-item-has-children.focus > a:after,
    .main-footer .main-menu > li.menu-item-has-children.focus > a:before,
    .main-navbar .main-menu > li.menu-item-has-children.focus > a:before,
    .main-header .widget_nav_menu li.menu-item-has-children:hover > a:after,
    .main-footer .widget_nav_menu li.menu-item-has-children:hover > a:after,
    .main-footer .main-menu > li.menu-item-has-children:hover > a:before,
    .main-navbar .main-menu > li.menu-item-has-children:hover > a:before,
    .main-navbar .main-menu > li.menu-item-has-children.active > a:before  {
        transform: rotate(90deg);
        color: var(--bs-primary);
    }

    .browse-menu .main-menu .menu-item:hover > .dropdown-menu,
    .browse-menu .main-menu .menu-item.focus > .dropdown-menu,
    .main-footer .widget_nav_menu .menu-item:hover > .sub-menu,
    .main-footer .widget_nav_menu .menu-item.focus > .sub-menu,
    .main-header .widget_nav_menu .menu-item:hover > .sub-menu,
    .main-header .widget_nav_menu .menu-item.focus > .sub-menu,
    .main-footer .main-menu .menu-item:hover > .dropdown-menu,
    .main-footer .main-menu .menu-item.focus > .dropdown-menu,
    .main-navbar .main-menu .menu-item:hover > .dropdown-menu,
    .main-navbar .main-menu .menu-item.focus > .dropdown-menu {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        -webkit-transform: scaleY(1);
        transform: scaleY(1);
    }


    .browse-menu .main-menu > li.menu-item-has-children > a {
        padding-right: 30px;
    }

    .main-header .widget_nav_menu li.menu-item-has-children > a,
    .main-footer .widget_nav_menu li.menu-item-has-children > a,
    .main-footer ul.main-menu > li.menu-item-has-children > a,
    .main-navbar ul.main-menu > li.menu-item-has-children > a {
        padding-right: 20px;
    }

    .main-footer .main-menu .dropdown-menu .menu-item-has-children > a:after,
    .main-footer .widget_nav_menu .sub-menu .menu-item-has-children > a:after,
    .main-header .widget_nav_menu .sub-menu .menu-item-has-children > a:after,
    .main-navbar .dropdown-menu .menu-item-has-children > a:after {
        font-family: var(--bs-font-awesome);
        font-weight: 900;
        content: "\f054";
        position: absolute;
        top: 50%;
        right: 20px;
        font-size: 10px;
        opacity: 0.7;  
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .main-footer .main-menu .dropdown-menu .menu-item-has-children:hover > a:after,
    .main-footer .main-menu .dropdown-menu .menu-item-has-children.focus > a:after,
    .main-footer .widget_nav_menu .sub-menu .menu-item-has-children:hover > a:after,
    .main-footer .widget_nav_menu .sub-menu .menu-item-has-children.focus > a:after,
    .main-header .widget_nav_menu .sub-menu .menu-item-has-children:hover > a:after,
    .main-header .widget_nav_menu .sub-menu .menu-item-has-children.focus > a:after,
    .main-navbar .dropdown-menu .menu-item-has-children:hover > a:after,
    .main-navbar .dropdown-menu .menu-item-has-children.focus > a:after {
        opacity: 1;
        right: 15px;
    }

    .main-mobile-menu ul.main-menu li.menu-item-has-children {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .main-mobile-menu ul.main-menu li.menu-item-has-children ul.dropdown-menu li > a {
        padding-left: 25px;
        width: 100%;
    }

    .main-mobile-menu ul.main-menu .menu-item-has-children > a {
        flex: 1;
    }

    .main-mobile-menu ul.main-menu .menu-item-has-children.current > a {
        margin: 0;
    }

    .header-search-popup .header-search-close,
    .more-link:after, .more-link,
    .widget .cat-item:hover a + span,
    .widget_title:after,
    .navbar-brand, img.navbar-brand,
    .is-sticky-menu img.navbar-brand,
    .active-two .main-navbar .main-menu > li > a,
    .main-navbar .dropdown-menu > li,
    .main-navbar .dropdown-menu li a,
    .main-navbar .dropdown-menu .menu-item-has-children > a:after,
    .main-footer .dropdown-menu > li,
    .main-footer .dropdown-menu li a,
    .main-footer .main-menu .dropdown-menu .menu-item-has-children > a:after,
    .sub-menu .menu-item-has-children > a:after,
    .mobile-collapsed > button,
    .mobile-collapsed > button:before,
    .main-mobile-build li > a,
    .hamburger-menu div,
    .hamburger-menu .meat,
    .hamburger-menu .bottom-bun,
    .header-sidebar-toggle span,
    .header-sidebar-toggle span:before,
    .header-sidebar-toggle span:after,
    .header-search-active .header-search-popup form,
    .header-search-popup form,
    .close-style:before, .close-style:after,
    .header-search-popup span:before, .header-search-popup span:after,
    .edd_checkout a, .button,
    button, input, input[type="button"],
    input[type="reset"], input[type="submit"] {
        -webkit-transition: var(--bs-transition);
        transition: var(--bs-transition);
    }

    ul.main-menu {
    list-style: none;
    margin: 0px;
    padding: 0px;
    display: block;
    }

    .img-div{
        max-width:100%;
        height:auto;
    }

    .wd-20{
        flex: 0 0 20%;
        width:20%;
        position: relative;
        width: 100%;
        padding-right: .75rem;
        padding-left: .75rem;
    }

    .image-container{
        width:100%;
        height:30vh;
        background-color:white;
    }

</style>
