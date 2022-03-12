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
                                                                <a href=\"{$domain_link}/category.php?id=".$row['main_category_name']."\" class=\"nav-link\">
                                                                <img src=\"".$row['main_category_pic']."\" style=\"width:25px;margin-right:5px;\">
                                                                ".$row['main_category_name']."
                                                                <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>

                                                                </a>
                                                                    <ul class=\"dropdown-menu\">
                                                        ");

                                                        while($row_1 = mysqli_fetch_assoc($result_1)) {
                                                            echo("
                                                                        <li class=\"menu-item\">
                                                                            <a href=\"{$domain_link}/category.php?id=".$row_1['sub_category_name']."\" class=\"dropdown-item\">".$row_1['sub_category_name']."</a>
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
                                                        <a href=\"{$domain_link}/category.php?id=".$row['main_category_name']."\" class=\"nav-link\">
                                                        <img src=\"".$row['main_category_pic']."\" style=\"width:25px;margin-right:5px;\">
                                                        ".$row['main_category_name']."
                                                        </a>
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
                        <a class="carousel-control-prev" style="z-index:0;" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" style="z-index:0;" href="#carouselExampleIndicators" role="button" data-slide="next">
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
                                            <a data-sqe="link" href="product.php?id=a">
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
        background-color:white;
        padding: 0;
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

    .browse-menu .main-menu > li.menu-item-has-children > a > i:before{
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

    .browse-menu .main-menu > li.menu-item-has-children >  a > i:before{
        right: 23px;
    }

    .browse-menu .main-menu > li.menu-item-has-children:hover >  a > i:before,
    .browse-menu .main-menu > li.menu-item-has-children.focus >  a > i:before{
        right: 20px;
        color: var(--bs-primary);
    }

    .browse-menu .main-menu .menu-item:hover > .dropdown-menu,
    .browse-menu .main-menu .menu-item.focus > .dropdown-menu{
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        -webkit-transform: scaleY(1);
        transform: scaleY(1);
    }

    .browse-menu .main-menu > li.menu-item-has-children > a {
        padding-right: 30px;
    }

    .dropdown-item{
        color:#a31f37;
    }

    .dropdown-item:focus, .dropdown-item:hover {
        color:#a31f37;
        text-decoration: none;
        background-color: #eaecf4;
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
