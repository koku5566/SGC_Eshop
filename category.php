<?php
    require __DIR__ . '/header.php'
?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">

                    <!-- Filter and Product List -->
                    <div class="row">
                    
                        <div class="col-xl-3 col-lg-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Search Filter</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="m-0 font-weight-bold text-primary mb-3">Rating</h6>
                                            <div class="form-check" id="rating_bar">
                                                <?php
                                                    if(isset($_GET['rating']))
                                                    {
                                                        $rating = (int) $_GET['rating'];
                                                        $ratingArray = array();

                                                        if($rating >= 1)
                                                        {
                                                            array_push($ratingArray,"<a class=\"fillStar\" href=\"?rating=1\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                        }
                                                        if($rating >= 2)
                                                        {
                                                            array_push($ratingArray,"<a class=\"fillStar\" href=\"?rating=2\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                        }
                                                        if($rating >= 3)
                                                        {
                                                            array_push($ratingArray,"<a class=\"fillStar\" href=\"?rating=3\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                        }
                                                        if($rating >= 4)
                                                        {
                                                            array_push($ratingArray,"<a class=\"fillStar\" href=\"?rating=4\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                        }
                                                        if($rating >= 5)
                                                        {
                                                            array_push($ratingArray,"<a class=\"fillStar\" href=\"?rating=5\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                        }
                                                    
                                                        while(count($ratingArray) < 5) {
                                                            $counter = count($caratingArrayrs) + 1;
                                                            array_push($ratingArray,"<a class=\"fillStar\" href=\"?rating={$counter}\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                        } 
                                                    }
                                                    else
                                                    {
                                                        echo{"
                                                            <a href=\"?rating=5\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                            <a href=\"?rating=4\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                            <a href=\"?rating=3\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                            <a href=\"?rating=2\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                            <a href=\"?rating=1\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                        "};
                                                    }

                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="m-0 font-weight-bold text-primary">Shipped From</h6>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="term1">
                                                <label class="form-check-label" for="term1">
                                                    West Malaysia
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="term2">
                                                <label class="form-check-label" for="term2">
                                                    East Malaysia
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="m-0 font-weight-bold text-primary">Shipping Option</h6>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="term1">
                                                <label class="form-check-label" for="term1">
                                                    Standard Delivery
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="term2">
                                                <label class="form-check-label" for="term2">
                                                    Self Collection
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="m-0 font-weight-bold text-primary">Condition</h6>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="term1">
                                                <label class="form-check-label" for="term1">
                                                    New
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="term2">
                                                <label class="form-check-label" for="term2">
                                                    Used
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="m-0 font-weight-bold text-primary">Payment Option</h6>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="term1">
                                                <label class="form-check-label" for="term1">
                                                    Debit or Credit Card
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="term2">
                                                <label class="form-check-label" for="term2">
                                                    Online Transfer
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                        </div>
                        <!--Product List -->
                        <div class="col-xl-9 col-lg-9">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-xl-2 col-lg-2">
                                            <h5 class="m-0 font-weight-bold text-primary">Products</h5>
                                        </div>
                                        <div class="col-xl-10 col-lg-10">
                                            <div class="row" style="float:right;">
                                                <div class="col" style="display:contents;">
                                                    <h5 class="m-0 font-weight-bold text-primary">Sort By</h5>
                                                </div>
                                                <div class="col">
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Latest</option>
                                                        <option value="1">Rating</option>
                                                        <option value="2">Sold</option>
                                                        <option value="3">Price</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    input[type=checkbox]
    {
        /* Double-sized Checkboxes */
        -ms-transform: scale(1.4); /* IE */
        -moz-transform: scale(1.4); /* FF */
        -webkit-transform: scale(1.4); /* Safari and Chrome */
        -o-transform: scale(1.4); /* Opera */
        padding: 10px;
    }


    ul.main-menu {
        list-style: none;
        margin: 0px;
        padding: 0px;
        display: block;
    }

    .form-check{
        padding-top:.5rem;
    }

    .form-check-label{
        padding: 0 10px;
    }

</style>
