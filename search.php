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
                                                    <input class="form-check-input" type="checkbox" name="chkStandardDelivery" <?php isset($_GET['chkStandardDelivery']) ? "checked" : ""; ?> id="term1">
                                                    <label class="form-check-label" for="term1">
                                                        Standard Delivery
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chkSelfCollection"  <?php isset($_GET['chkSelfCollection']) ? "checked" : ""; ?> id="term2">
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
                                                            <input type="text" class="form-control" name="minPrice" placeholder="RM MIN">
                                                        </div>
                                                    </div>
                                                    <div class="col mb-3" style="max-width: 14px;padding: 0;">
                                                        <i class="fa fa-minus" style="padding: 10px 0;" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="maxPrice" placeholder="RM MAX">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="input-group">
                                                            <button type="submit" class="btn btn-primary" style="width:100%">Apply Filter</button>
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
                                            $sql = "SELECT * FROM product WHERE product_name LIKE '%$SearchBy%' AND product_status = 'A' ";
                                            echo($sql);
                                            $result = mysqli_query($conn, $sql);
                                
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {

                                                    //Fetch each product information
                                                    $id = $row['product_id'];
                                                    $sql_1 = "SELECT A.product_id, A.product_name,A.product_cover_picture,A.product_variation,A.product_price,A.product_stock,A.product_sold,A.product_status,
                                                    C.max_price,D.min_price,F.total_stock, R.rating FROM `product` AS A 
                                                    LEFT JOIN variation AS B ON A.product_id = B.product_id 
                                                    LEFT JOIN (SELECT product_id,product_price AS max_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price DESC LIMIT 1) AS C ON A.product_id = C.product_id 
                                                    LEFT JOIN (SELECT product_id,product_price AS min_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price ASC LIMIT 1) AS D ON A.product_id = D.product_id 
                                                    LEFT JOIN (SELECT product_id, SUM(product_stock) AS total_stock FROM `variation` WHERE product_id = '$id' GROUP BY product_id) AS F ON A.product_id = F.product_id
                                                    LEFT JOIN (SELECT avg(rr.rating) AS rating, rr.product_id FROM user u INNER JOIN  reviewRating rr ON  u.userID = rr.user_id WHERE rr.disable_date IS NULL AND rr.product_id = '$id') AS R ON A.product_id = R.product_id 
                                                    WHERE A.product_id = '$id'
                                                    LIMIT 1";
                                                    $result_1 = mysqli_query($conn, $sql_1);

                                                    if (mysqli_num_rows($result_1) > 0) {
                                                        while($row_1 = mysqli_fetch_assoc($result_1)) {
                                                            
                                                            echo("
                                                                <div class=\"col-xl-2 col-lg-4 col-sm-6 product-item\" style=\"padding-bottom: .625rem;\">
                                                                    <a data-sqe=\"link\" href=\"product.php?id=".$row_1['product_id']."\">
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

                                                            
                                                            //Pricing
                                                            //If got variation
                                                            if($row_1['product_variation'] == 1)
                                                            {
                                                                if($row_1['min_price'] != $row_1['max_price'])
                                                                {
                                                                    echo("<b><span style=\"font-size:1rem;\">RM ".$row_1['min_price']." - RM ".$row_1['max_price']." <span></b>");
                                                                }
                                                                else
                                                                {
                                                                    echo("<b><span style=\"font-size:1rem;\">RM ".$row_1['min_price']."<span></b>");
                                                                }
                                                                echo("</div>");
                                                                //End of Price Division

                                                                

                                                                //Start Stock Division
                                                                echo("     
                                                                                <div class=\"Stock\">
                                                                                    <div class=\"row\" style=\"height: 40px;\">
                                                                                        <div class=\"col-xl-7\">
                                                                ");

                                                                //Start Rating Division
                                                                echo("<div class=\"Rating\">");

                                                                $calavgrat = $row_1['rating'];
                                                                if($calavgrat == "")
                                                                {
                                                                    echo("<p style=\"font-size:0.8rem;color:grey;\">No Rating Yet</p>");
                                                                }
                                                                else{
                                                                    $check = true;
                                                                    for($i = 0; $i<5; $i++){
                                                                        if(round($calavgrat) && $check == true){
                                                                        echo "<i class=\"fa fa-star\"></i>";
                                                                        $calavgrat -= 1;
                                                                        }else{
                                                                        if ($calavgrat >= 0 && $calavgrat < 0.5 ){
                                                                            echo "<i class=\"fa fa-star-half-alt\"></i>";
                                                                        }
                                                                        else{
                                                                            echo "<i class=\"fa fa-star\" style=\"font-weight:normal;\"></i>";
                                                                        }
                                                                        $check = false;
                                                                        $calavgrat -= 1;
                                                                        }
                                                                    }
                                                                }
                                                                echo("</div>");
                                                                //End of Rating Division

                                                                echo("  
                                                                                        </div>
                                                                                        <div class=\"col-xl-5\">
                                                                                            <p style=\"font-size:0.8rem;color:grey;\">Sold ".$row_1['product_sold']."</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                ");
                                                                //End of Stock Division
                                                            }
                                                            //If no variation
                                                            else
                                                            {
                                                                echo("<b><span style=\"font-size:1rem;\">RM ".$row_1['product_price']." <span></b>");
                                                                echo("</div>");
                                                                //End of Price Division

                                                                //Start Stock Division
                                                                echo("     
                                                                                <div class=\"Stock\">
                                                                                    <div class=\"row\" style=\"height: 40px;\">
                                                                                        <div class=\"col-xl-7\">
                                                                ");

                                                                //Start Rating Division
                                                                echo("<div class=\"Rating\">");

                                                                $calavgrat = $row_1['rating'];
                                                                if($calavgrat == "")
                                                                {
                                                                    echo("<p style=\"font-size:0.8rem;color:grey;\">No Rating Yet</p>");
                                                                }
                                                                else{
                                                                    $check = true;
                                                                    for($i = 0; $i<5; $i++){
                                                                        if(round($calavgrat) && $check == true){
                                                                        echo "<i class=\"fa fa-star\"></i>";
                                                                        $calavgrat -= 1;
                                                                        }else{
                                                                        if ($calavgrat >= 0 && $calavgrat < 0.5 ){
                                                                            echo "<i class=\"fa fa-star-half-alt\"></i>";
                                                                        }
                                                                        else{
                                                                            echo "<i class=\"fa fa-star\" style=\"font-weight:normal;\"></i>";
                                                                        }
                                                                        $check = false;
                                                                        $calavgrat -= 1;
                                                                        }
                                                                    }
                                                                }
                                                                echo("</div>");
                                                                //End of Rating Division

                                                                echo("  
                                                                                        </div>
                                                                                        <div class=\"col-xl-5\">
                                                                                            <p style=\"font-size:0.8rem;color:grey;\">Sold ".$row_1['product_sold']."</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                ");
                                                                //End of Stock Division
                                                            }

                                                            //Start of Location Division
                                                            //$location = $row_1['location'];
                                                            $location = "Subang Jaya";
                                                            echo("
                                                                <div class=\"Location\">
                                                                    <span style=\"font-size: 10pt; color:grey;\" >$location</span>
                                                                </div>
                                                            ");
                                                            //End of Location Division

                                                            echo("
                                                                                        
                                                                                    
                                                                            </div>
                                                                        </div>   
                                                                    </a>
                                                                </div>
                                                            ");
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