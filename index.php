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

                                                    //Check For Sub Category
                                                    $sql_1 = "SELECT * FROM subCategory WHERE main_category_id = \"".$row['main_category_id']."\"";
                                                    $result_1 = mysqli_query($conn, $sql_1);
                                        
                                                    if (mysqli_num_rows($result_1) > 0) {

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

                                                    //If no sub category, display as normal
                                                    echo("
                                                        <li class=\"menu-item\" style=\"display: list-item;\">
                                                        <a href=\"https://eshop.sgcprototype2.com/?id=".$row['main_category_name']."\" class=\"nav-link\">".$row['main_category_name']."</a>
                                                        </li>
                                                    ");
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        
                        <!-- Slideshow -->
                        <div class="col-xl-10">
                            <div id="carouselExampleIndicators" class="carousel slide mb-3" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
<<<<<<< HEAD
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img class="d-block w-100 img-div" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100 img-div" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100 img-div" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="Third slide">
=======
                            <div class="carousel-inner" style="height:20rem;">
                                <div class="carousel-item active" style="height:inherit;">
                                <img class="d-block w-100 img-div" src="https://media.istockphoto.com/photos/freedom-chains-that-transform-into-birds-charge-concept-picture-id1322104312?b=1&k=20&m=1322104312&s=170667a&w=0&h=VQyPkFkMKmo0e4ixjhiOLjiRs_ZiyKR_4SAsagQQdkk=" alt="First slide">
                                </div>
                                <div class="carousel-item" style="height:inherit;">
                                <img class="d-block w-100 img-div" src="https://www.planetware.com/wpimages/2020/02/france-in-pictures-beautiful-places-to-photograph-eiffel-tower.jpg" alt="Second slide">
                                </div>
                                <div class="carousel-item" style="height:inherit;">
                                <img class="d-block w-100 img-div" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" alt="Third slide">
>>>>>>> parent of 08dc898 (Update index.php)
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

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
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
    }

</style>
