<?php
    require __DIR__ . '/header.php'
?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php 
                            $productId = $_GET['id'];
                            //Display Current Directory
                            $sql = "SELECT B.category_name AS mainCategory, A.sub_Yes, C.category_name AS subCategory FROM `categoryCombination` AS A 
                            LEFT JOIN  category AS B ON A.main_category = B.category_id
                            LEFT JOIN  category AS C ON A.sub_category = C.category_id
                            WHERE combination_id = (SELECT category_id FROM `product` WHERE product_id = '$productId')
                            ";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $mainCategoryName = $row["mainCategory"];
                                    $subYes = $row["sub_Yes"];
                                    $subCategoryName = $row["subCategory"];
                                    
                                    //If no sub category, display as normal
                                    echo("<li class=\"breadcrumb-item\"><a href=\"?Category={$mainCategoryName}\">$mainCategoryName</a></li>";
                                    if($subYes == 1)
                                    {
                                        echo("<li class=\"breadcrumb-item\"><a href=\"?Category={$subCategoryName}\">$subCategoryName</a></li>");
                                    }
                                    
                                    echo("<li class=\"breadcrumb-item active\"><a href=\"?Product={example}\">Product</a></li>");
                                }
                            }   
                        ?>
                    </ol>
                </nav>

                    <!-- Product Row -->
                    <div class="row">
                        <!-- Picture -->
                        <div class="col-xl-8 col-md-6 mb-6">
                            <div id="custCarousel" class="carousel slide" data-interval="false">
                                <!-- slides -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active"> <img src="/img/product/iphone-black.jpg" alt="Iphone"> </div>
                                    <div class="carousel-item"> <img src="/img/product/iphone-gold.jpg" alt="Iphone"> </div>
                                    <div class="carousel-item"> <img src="/img/product/iphone-green.png" alt="Iphone"> </div>
                                    <div class="carousel-item"> <img src="/img/product/iphone-grey.png" alt="Iphone"> </div>
                                </div> <!-- Left right --> <a class="carousel-control-prev" href="#custCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#custCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> <!-- Thumbnails -->
                                <ol class="carousel-indicators list-inline" style="height:130px;">
                                    <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="/img/product/iphone-black.jpg" class="img-fluid"> </a> </li>
                                    <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="/img/product/iphone-black.jpg" class="img-fluid"> </a> </li>
                                    <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="/img/product/iphone-green.png" class="img-fluid"> </a> </li>
                                    <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="3" data-target="#custCarousel"> <img src="/img/product/iphone-grey.png" class="img-fluid"> </a> </li>
                                </ol>
                            </div>
                        </div>

                        <!-- Product Content -->
                        <div class="col-xl-4 col-md-6 mb-6">
                            <br>
                            <!-- Name -->
                            <div class="row">
                                <div class="col">
                                    <h1 style="color:#a31f37;">IPhone 10 Pro Max</h1>
                                    <hr>
                                </div>
                            </div>
                            <!-- Rating/Rating Number/Sold -->
                            <div class="row">
                                <div class="col">
                                    <b>4.9 Rating</b>
                                </div>
                                <div class="col">
                                    <b>200 Rated</b>
                                </div>
                                <div class="col">
                                    <b>300 Sold</b>
                                </div>
                            </div>
                            <br>
                            <!-- Price -->
                            <div class="row">
                                <div class="col">
                                    <span style="color:#a31f37;font-size:18pt">RM 3500 - RM 4800</span>
                                </div>
                            </div>
                            <!-- Variation -->
                            <div class="row">
                                <div class="variation">
                                    <!-- Variation Loop here -->
                                    <div class="row">
                                        <ol class="list-inline">
                                            <li class="list-inline-item variation-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="/img/product/iphone-black.jpg" class="img-fluid"> </a> </li>
                                            <li class="list-inline-item variation-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="/img/product/iphone-black.jpg" class="img-fluid"> </a> </li>
                                            <li class="list-inline-item variation-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="/img/product/iphone-green.png" class="img-fluid"> </a> </li>
                                            <li class="list-inline-item variation-item"> <a id="carousel-selector-2" data-slide-to="3" data-target="#custCarousel"> <img src="/img/product/iphone-grey.png" class="img-fluid"> </a> </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <!-- Quantity -->
                            <div class="row">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <button class="quantity-selector-btn" onclick="this.parentNode.parentNode.querySelector('input[type=number]').stepDown(); RefreshValue(this);" name = "ChangeQuantity" type = "button"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input min="1" name="quantity[]" value="1" type="number" class="form-control quantity-input">
                                        <div class="input-group-append">
                                        <button class="quantity-selector-btn" onclick="this.parentNode.parentNode.querySelector('input[type=number]').stepUp(); RefreshValue(this);" class="plus" name = "ChangeQuantity\" type = "button"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="10 Stock Avaiable">
                                    
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn btn-primary">
                                        <span class="text">Add To Cart</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shop Profile -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <img class="img-thumbnail" src="data:image/jpeg;base64,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">
                                        </div>
                                        <div class="col-9 sidebar-brand-text" style="font-size:2rem;">Offical Apple Store</div>
                                    </div>


                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="row">
                                        <div class="col list-parent"> 
                                            <i class="fa fa-star"></i>
                                            <span>4.5</span>
                                        </div>
                                        <div class="col list-parent"> 
                                            <i class="fa fa-gift"></i>
                                            <span>120</span>
                                        </div>
                                        <div class="col list-parent"> 
                                            <i class="fa fa-calendar"></i>
                                            <span>2021</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-2" style="text-align:center;">
                                    <a href="#" class="btn btn-primary" style="margin-top: 20%;">
                                        <span class="text">View Shop</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Row -->
                    <div class="row">
                        <div class="col">

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
    .image-container{
        width:100%;
        height: 40vh;
        padding: 20px;
    }
    .image-container .image{
        max-height: 100%;
        max-width: 100%;
    }
    .list-parent{
        white-space: nowrap;
        font-size: x-large;
    }
    .list-inline-item{
        background-color:white;
    }

    .carousel-item{
        height:60vh;
        background-color:white;
    }

    .carousel-inner img {
        width: 100%;
        height: 100%;
        object-fit:contain;
    }

    #custCarousel .carousel-indicators {
        position: static;
        margin-top: 20px
    }

    #custCarousel .carousel-indicators>li {
        width: 100px
    }

    #custCarousel .carousel-indicators li img {
        display: block;
        opacity: 0.5
    }

    .variation-item{
        width:100px;
        padding:1rem;
        text-align:center;
        color:black;
    }

    #custCarousel .carousel-indicators li.active img {
        opacity: 1
    }

    #custCarousel .carousel-indicators li:hover img {
        opacity: 0.75
    }

    .numner-input{
        padding: 0 0 1rem 0;
    }

    .quantity-input{
        appearance: textfield;
        min-height: 3rem;
        text-align: center;
    }

    .quantity-selector-btn{
        min-width:3rem;
        min-height:3rem;
        color: #ffffff;
        border-color: #a31f37;
        background-color: #a31f37;
        transition: all ease 200ms;
    }

    .quantity-selector-btn:hover{
        opacity:0.8;
    }


</style>