<?php
    require __DIR__ . '/header.php'
?>


                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
                    <!-- List All Product -->
                    <div class="row">
                        <!--Product List -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary ">CHOOSE A CAMPUS</h5>
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
                                                    <div class="card-body">
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
                                                    <div class="card-body">
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
                                                    <div class="card-body">
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
                                                    <div class="card-body">
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
                        </div>
                    </div>
                    <br>
                      <h1>sss<h1>
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
    .card-body{
        color: red;
    }



</style>
