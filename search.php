<?php
    require __DIR__ . '/header.php'
?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
                    <form id="filterForm" method="get" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
                                                                $counter = count($ratingArray) + 1;
                                                                array_push($ratingArray,"<a href=\"?rating={$counter}\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                            } 

                                                            
                                                            foreach (array_reverse($ratingArray) as $value) {
                                                                echo("{$value}");
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo("
                                                                <a href=\"?rating=5\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                                <a href=\"?rating=4\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                                <a href=\"?rating=3\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                                <a href=\"?rating=2\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                                <a href=\"?rating=1\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                            ");
                                                        }

                                                    ?>
                                                    
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
                                                <h6 class="m-0 font-weight-bold text-primary">Price</h6>
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                                            </div>
                                                            <input type="text" class="form-control" name="minPrice" placeholder="min">
                                                        </div>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <p>-</p>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                                            </div>
                                                            <input type="text" class="form-control" name="maxPrice" placeholder="max">
                                                        </div>
                                                    </div>
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
                                                        <select class="form-select" name="SortBy" onchange="this.form.submit()">
                                                            <option value="Latest" <?php $_GET['SortBy'] == "Latest" ? "selected" : ""; ?>>Latest</option>
                                                            <option value="Rating" <?php $_GET['SortBy'] == "Rating" ? "selected" : ""; ?>>Rating</option>
                                                            <option value="Sold" <?php $_GET['SortBy'] == "Sold" ? "selected" : ""; ?>>Sold</option>
                                                            <option value="Price" <?php $_GET['SortBy'] == "Price" ? "selected" : ""; ?>>Price</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!--PHP Loop Product List by Search Result-->
                                            <?php
                                            $SearchBy = $_GET['Search'];
                                            $SortBy = $_GET['SortBy'];
                                            $Rating = $_GET['Rating'];
                                            $Price = $_GET['Price'];
                                            $ShippingOption = $_GET['ShippingOption'];

                                            //Check for Main Category
                                            $sql = "SELECT * FROM product WHERE product_name LIKE '%$keyword%' ";
                                            $result = mysqli_query($conn, $sql);
                                
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {

                                                    //Fetch each product information
                                                    $id = $row['product_id'];
                                                    $sql_1 = "SELECT DISTINCT A.product_id, A.product_name,A.product_cover_picture,A.product_variation,A.product_price,A.product_stock,A.product_sold,
                                                    C.max_price,D.min_price,E.total_sold,F.total_stock FROM `product` AS A 
                                                    LEFT JOIN variation AS B ON A.product_id = B.product_id 
                                                    LEFT JOIN (SELECT product_id,product_price AS max_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price DESC LIMIT 1) AS C ON A.product_id = C.product_id 
                                                    LEFT JOIN (SELECT product_id,product_price AS min_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price ASC LIMIT 1) AS D ON A.product_id = D.product_id 
                                                    LEFT JOIN (SELECT product_id, SUM(product_sold) AS total_sold FROM `variation` WHERE product_id = '$id' GROUP BY product_id) AS E ON A.product_id = E.product_id
                                                    LEFT JOIN (SELECT product_id, SUM(product_stock) AS total_stock FROM `variation` WHERE product_id = '$id' GROUP BY product_id) AS F ON A.product_id = F.product_id
                                                    WHERE A.product_id = '$id' 
                                                    LIMIT 1";

                                                    $result_1 = mysqli_query($conn, $sql_1);
                                        
                                                    if (mysqli_num_rows($result_1) > 0) {
                                                        while($row_1 = mysqli_fetch_assoc($result_1)) {
                                                            
                                                            echo("
                                                                <div class=\"col-xl-3 col-lg-4 col-sm-6\" style=\"padding-bottom: .625rem;\">
                                                                    <a data-sqe=\"link\" href=\"".$row_1['product_id']."\">
                                                                        <div class=\"card\">
                                                                            <div class=\"image-container\">
                                                                                <img class=\"card-img-top img-thumbnail\" style=\"object-fit:contain;width:100%;height:100%\" src=\"/img/product/".$row_1['product_cover_picture']."\" alt=\"".$row_1['product_name']."\">
                                                                            </div>
                                                                            <div class=\"card-body\">
                                                                                <div class=\"Name\">
                                                                                    <p class=\"card-text product-name\">".$row_1['product_name']."</p>
                                                                                </div>
                                                                                <div class=\"Tag\">
                                                                                    <span style=\"border: 1px dashed red; font-size:10pt;\">Student 10% discount</span>
                                                                                </div>
                                                                                <div class=\"Price\">
                                                            ");

                                                            //If got variation
                                                            if($row_1['product_variation'] == 1)
                                                            {
                                                                if($row_1['min_price'] == $row_1['max_price'])
                                                                {
                                                                    echo("<b><span style=\"font-size:16pt;\">RM ".$row_1['min_price']."<span></b>");
                                                                }
                                                                else
                                                                {
                                                                    echo("<b><span style=\"font-size:16pt;\">RM ".$row_1['min_price']." - RM ".$row_1['max_price']." <span></b>");
                                                                }
                                                                

                                                                echo("
                                                                                </div>
                                                                                <div class=\"Rating\">
                                                                                    <i class=\"fa fa-star\"></i>
                                                                                    <i class=\"fa fa-star\"></i>
                                                                                    <i class=\"fa fa-star-half-alt\"></i>
                                                                                    <i class=\"fa fa-star\" style=\"font-weight:normal;\"></i>
                                                                                    <i class=\"fa fa-star\" style=\"font-weight:normal;\"></i>
                                                                                </div>
                                                                                <div class=\"Location\">
                                                                                <span style=\"font-size: 10pt; color:grey;\" >Subang Jaya</span>
                                                                                </div>
                                                                                    
                                                                                </div>
                                                                            </div>   
                                                                        </a>
                                                                    </div>
                                                                ");
                                                            }
                                                            //If no variation
                                                            else
                                                            {
                                                                echo("<b><span style=\"font-size:16pt;\">RM ".$row_1['product_price']." <span></b>");

                                                                echo("
                                                                                </div>
                                                                                <div class=\"Rating\">
                                                                                    <i class=\"fa fa-star\"></i>
                                                                                    <i class=\"fa fa-star\"></i>
                                                                                    <i class=\"fa fa-star-half-alt\"></i>
                                                                                    <i class=\"fa fa-star\" style=\"font-weight:normal;\"></i>
                                                                                    <i class=\"fa fa-star\" style=\"font-weight:normal;\"></i>
                                                                                </div>
                                                                                <div class=\"Location\">
                                                                                <span style=\"font-size: 10pt; color:grey;\" >Subang Jaya</span>
                                                                                </div>
                                                                                    
                                                                                </div>
                                                                            </div>   
                                                                        </a>
                                                                    </div>
                                                                ");
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                                
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>            
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

<script>
    function SortProductList(value) {
        $.ajax({
            type: "GET",
            url: "category.php",
            data: "SortBy =" + value,
            success: function(result) {
                ;
            }
        });
    };
</script>