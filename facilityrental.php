<?php
    require __DIR__ . '/header.php'
?>


                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
                    <!-- List All Product -->
                    <div class="row">
                    <div class="card-header py-3">
                                    <h5 class="w3-display-middle">CHOOSE A CAMPUS</h5>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-sm-6" style="padding-bottom: .625rem;">
                                            <a data-sqe="link" href="product.php?id=a">
                                                <div class="card">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body-text">
                                                        <div class="Name">
                                                            <p class="card-text campus-name">SUBANG JAYA</p>
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
                                                    <div class="card-body-text">
                                                        <div class="Name">
                                                            <p class="card-text campus-name">PENANG</p>
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
                                                    <div class="card-body-text">
                                                        <div class="Name">
                                                            <p class="card-text campus-name">SARAWAK</p>
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
                                                    <div class="card-body-text">
                                                        <div class="Name">
                                                            <p class="card-text campus-name">KUALA LUMPUR</p>
                                                        </div>                                                                                                          
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                    <br>
                    <div class="card-header py-3">
                                    <h5 class="w3-display-middle">EXPLORE SEGI FACILITIES</h5>
                                </div>
                    <!-- Slideshow -->
                    <div class="w3-display-middle" style="width:100%">
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
                <!-- /.container-fluid -->
                <br>

<?php
    require __DIR__ . '/footer.php'
?>

<style>
    .campus-name{
        color:white;
        height:50px;
        overflow:hidden;
        text-align: center;   

    }
    .card-body-text{
       background-color: gray;
       opacity: 2;
    }
    .card-body{
       background-color: #A31F37;
    }


</style>
