<?php
    require __DIR__ . '/header.php'
?>
<?php
    if(isset($_GET['ClearFilter']))
    {
        unset($_SESSION["Search"]);
        unset($_SESSION["chkStandardDelivery"]);
        unset($_SESSION["chkSelfCollection"]);
        unset($_SESSION["Rating"]);
        unset($_SESSION["minPrice"]);
        unset($_SESSION["maxPrice"]);
        unset($_SESSION["SortBy"]);
    }
    else
    {
        if(isset($_GET['ApplyFilter']))
        {
            if(isset($_GET['chkStandardDelivery']) && $_GET['chkStandardDelivery'] != "")
            {
                $_SESSION['chkStandardDelivery'] = $_GET['chkStandardDelivery'];
            }
            else
            {
                unset($_SESSION["chkStandardDelivery"]);
            }
            if(isset($_GET['chkSelfCollection']) && $_GET['chkSelfCollection'] != "")
            {
                $_SESSION['chkSelfCollection'] = $_GET['chkSelfCollection'];
            }
            else
            {
                unset($_SESSION["chkSelfCollection"]);
            }
            if(isset($_GET['minPrice']) && $_GET['minPrice'] != "")
            {
                $_SESSION['minPrice'] = $_GET['minPrice'];
            }
            else
            {
                unset($_SESSION["minPrice"]);
            }
            if(isset($_GET['maxPrice']) && $_GET['maxPrice'] != "")
            {
                $_SESSION['maxPrice'] = $_GET['maxPrice'];
            }
            else
            {
                unset($_SESSION["maxPrice"]);
            }
        }
        else{
            //Save into session
            if(isset($_GET['Search']) && $_GET['Search'] != "")
            {
                $_SESSION['Search'] = $_GET['Search'];
            }
            if(isset($_GET['chkStandardDelivery']) && $_GET['chkStandardDelivery'] != "")
            {
                $_SESSION['chkStandardDelivery'] = $_GET['chkStandardDelivery'];
            }
            if(isset($_GET['chkSelfCollection']) && $_GET['chkSelfCollection'] != "")
            {
                $_SESSION['chkSelfCollection'] = $_GET['chkSelfCollection'];
            }
            if(isset($_GET['Rating']) && $_GET['Rating'] != "")
            {
                $_SESSION['Rating'] = $_GET['Rating'];
            }
            if(isset($_GET['minPrice']) && $_GET['minPrice'] != "")
            {
                $_SESSION['minPrice'] = $_GET['minPrice'];
            }
            if(isset($_GET['maxPrice']) && $_GET['maxPrice'] != "")
            {
                $_SESSION['maxPrice'] = $_GET['maxPrice'];
            }
            if(isset($_GET['SortBy'])  && $_GET['SortBy'] != "")
            {
                $_SESSION['SortBy'] = $_GET['SortBy'];
            }
        }
    }
    
?>

                <!-- Begin Page Content -->
                <div class="container-fluid" id="mainContainer">
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
                                                        if(isset($_SESSION['Rating']))
                                                        {
                                                            $rating = (int) $_SESSION['Rating'];
                                                            $ratingArray = array();

                                                            if($rating >= 1)
                                                            {
                                                                array_push($ratingArray,"<a class=\"fillStar\" href=\"?Rating=1\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                            }
                                                            if($rating >= 2)
                                                            {
                                                                array_push($ratingArray,"<a class=\"fillStar\" href=\"?Rating=2\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                            }
                                                            if($rating >= 3)
                                                            {
                                                                array_push($ratingArray,"<a class=\"fillStar\" href=\"?Rating=3\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                            }
                                                            if($rating >= 4)
                                                            {
                                                                array_push($ratingArray,"<a class=\"fillStar\" href=\"?Rating=4\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                            }
                                                            if($rating >= 5)
                                                            {
                                                                array_push($ratingArray,"<a class=\"fillStar\" href=\"?Rating=5\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                            }
                                                        
                                                            while(count($ratingArray) < 5) {
                                                                $counter = count($ratingArray) + 1;
                                                                array_push($ratingArray,"<a href=\"?Rating={$counter}\"><span class=\"fa fa-star ratingStar\"></span></a>");
                                                            } 

                                                            foreach ($ratingArray as $value) {
                                                                echo("{$value}");
                                                            }

                                                            /*
                                                            foreach (array_reverse($ratingArray) as $value) {
                                                                echo("{$value}");
                                                            }
                                                            */
                                                        }
                                                        else
                                                        {
                                                            echo("
                                                                <a href=\"?Rating=5\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                                <a href=\"?Rating=4\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                                <a href=\"?Rating=3\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                                <a href=\"?Rating=2\"><span class=\"fa fa-star ratingStar\"></span></a>
                                                                <a href=\"?Rating=1\"><span class=\"fa fa-star ratingStar\"></span></a>
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
                                                    <input class="form-check-input" type="checkbox" name="chkStandardDelivery" <?php echo(isset($_SESSION['chkStandardDelivery']) ? "checked" : ""); ?> id="term1">
                                                    <label class="form-check-label" for="term1">
                                                        Standard Delivery
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chkSelfCollection"  <?php  echo(isset($_SESSION['chkSelfCollection']) ? "checked" : ""); ?> id="term2">
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
                                                            <input type="text" class="form-control" name="minPrice" value="<?php echo($_SESSION['minPrice']); ?>" placeholder="RM MIN">
                                                        </div>
                                                    </div>
                                                    <div class="col mb-3" style="max-width: 14px;padding: 0;">
                                                        <i class="fa fa-minus" style="padding: 10px 0;" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="maxPrice" value="<?php echo($_SESSION['maxPrice']); ?>" placeholder="RM MAX">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col-xl-6 col-sm-12">
                                                                <button type="submit" name="ApplyFilter" class="btn btn-primary" style="width:100%">Apply Filter</button>
                                                            </div>
                                                            <div class="col-xl-6 col-sm-12">
                                                                <button type="submit" name="ClearFilter" class="btn btn-secondary" style="width:100%">Clear Filter</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!--Result for shop and product -->
                             <div class="col-xl-9 col-lg-9">
                                <!--Shop List -->                      
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <div class="row">
                                            <div class="col-xl-2 col-lg-3">
                                                <h5 class="m-0 font-weight-bold text-primary">Shop List</h5>
                                            </div>
                                            <div class="col-xl-10 col-lg-9">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-content row mb-3">
                                            <!--PHP Loop Product List by Search Result-->
                                            <?php
                                                if(isset($_SESSION['Search']))
                                                {
                                                    $SearchBy = $_SESSION['Search'];
                                                    $sql = "SELECT * FROM shopProfile WHERE shop_name LIKE '%$SearchBy%' LIMIT 4";

                                                    $result = mysqli_query($conn, $sql);
                                    
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while($row = mysqli_fetch_assoc($result)) {

                                                            $id = $row['shop_id'];
                                                            $name = $row['shop_name'];
                                                            $imgblob = $row['shop_profile_image'];

                                                            echo("
                                                            
                                                            <div class=\"col-xl-3 col-lg-4 col-sm-6 shop-item\" style=\"padding-bottom: 0.625rem;\">
                                                                <a data-sqe=\"link\" href=\"shopDetails.php?id=$id\">
                                                                    <div class=\"card\">
                                                                        <div class=\"image-container\">
                                                                            <img class=\"card-img-top img-thumbnail\" style=\"object-fit:contain;width:100%;height:100%\" src=\"data:image/png;base64,".base64_encode($imgblob)." alt=\"$name\">
                                                                        </div>
                                                                        <div class=\"card-body\">
                                                                            <div class=\"Name\">
                                                                            <p class=\"card-text product-name\">$name</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            
                                                            ");
                                                            ?>
                                                                <div class="row" style="display:block;width:100%;text-align:center;">
                                                                    <img src="/img/resource/shop-not-found.png" style="width:200px; height:200px;opacity:0.3;"/>
                                                                    <h5>No Shop Found</h5>
                                                                </div>
                                                            <?php  
                                                        }
                                                    }
                                                    else{

                                                    }
                                                }
                                                else
                                                {
                                                ?>
                                                    <div class="row" style="display:block;width:100%;text-align:center;">
                                                        <img src="/img/resource/shop-not-found.png" style="width:200px; height:200px;opacity:0.3;"/>
                                                        <h5>No Shop Found</h5>
                                                    </div>
                                                <?php  
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--Product List -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <div class="row">
                                            <div class="col-xl-2 col-lg-3">
                                                <h5 class="m-0 font-weight-bold text-primary">Products</h5>
                                            </div>
                                            <div class="col-xl-10 col-lg-9">
                                                <div class="row" style="float:right;">
                                                    <div class="col" style="display:contents;">
                                                        <h5 class="m-0 font-weight-bold text-primary">Sort By</h5>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-select" name="SortBy" onchange="this.form.submit()">
                                                            <option value="Latest" <?php echo($_SESSION['SortBy'] == "Latest" ? "selected" : ""); ?>>Latest</option>
                                                            <option value="Rating" <?php echo($_SESSION['SortBy'] == "Rating" ? "selected" : ""); ?>>Rating</option>
                                                            <option value="Sold" <?php echo($_SESSION['SortBy'] == "Sold" ? "selected" : ""); ?>>Sold</option>
                                                            <option value="Price" <?php echo($_SESSION['SortBy'] == "Price" ? "selected" : ""); ?>>Price</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-content row mb-3" style="display: none">
                                            <!--PHP Loop Product List by Search Result-->
                                            <?php
                                                //Check for Main Category
                                                $sql = "SELECT A.product_id, R.rating FROM product AS A 
                                                LEFT JOIN (SELECT DISTINCT(product_id), rating FROM reviewRating t1 WHERE rating = (SELECT MIN(rating) FROM reviewRating WHERE product_id = t1.product_id)) AS R ON A.product_id = R.product_id 
                                                LEFT JOIN categoryCombination AS C ON A.category_id = C.combination_id 
                                                WHERE A.product_status = 'A' ";

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

                                                //Set to sql

                                                if(isset($_SESSION['Search']))
                                                {
                                                    $SearchBy = $_SESSION['Search'];
                                                    $sql .= "AND (product_name LIKE '%$SearchBy%') ";
                                                }

                                                if(isset($_SESSION['chkStandardDelivery']))
                                                {
                                                    $sql .= "AND product_standard_delivery = '1' ";
                                                }

                                                if(isset($_SESSION['chkSelfCollection']))
                                                {
                                                    $sql .= "AND product_self_collect = '1' ";
                                                }

                                                if(isset($_SESSION['Rating']))
                                                {
                                                    $Rating = $_SESSION['Rating'];
                                                    $sql .= "AND rating >= $Rating ";
                                                }

                                                if(isset($_SESSION['maxPrice']))
                                                {
                                                    $maxPrice = $_SESSION['maxPrice'];
                                                    $sql .= "AND product_price <= $maxPrice ";
                                                }

                                                if(isset($_SESSION['minPrice']))
                                                {
                                                    $minPrice = $_SESSION['minPrice'];
                                                    $sql .= "AND product_price >= $minPrice ";
                                                }

                                                if(isset($_SESSION['SortBy']))
                                                {
                                                    $SortBy = $_SESSION['SortBy'];
                                                    $key = "";
                                                    switch($SortBy)
                                                    {
                                                        case "Latest" :
                                                            $sql .= " ORDER BY product_id DESC";
                                                            break;
                                                        case "Rating" :
                                                            $sql .= " ORDER BY product_id ASC";
                                                            break;
                                                        case "Sold" :
                                                            $sql .= " ORDER BY product_sold ASC";
                                                            break;
                                                        case "Price" :
                                                            $sql .= " ORDER BY product_price ASC";
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                    
                                                }
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
                                                                    <div class=\"col-xl-3 col-lg-4 col-sm-6 product-item\" style=\"padding-bottom: .625rem;\">
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
                                                                                        <div class=\"row\" style=\"min-height: 40px;\">
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
                                                                                        <div class=\"row\" style=\"min-height: 40px;\">
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
                                                else
                                                {
                                                ?>
                                                    <div class="row" style="display:block;width:100%;text-align:center;">
                                                        <img src="/img/resource/product-not-found.png" style="width:200px; height:200px;opacity:0.3;"/>
                                                        <h5>No Result Found</h5>
                                                    </div>
                                                <?php  
                                                }
                                                
                                            ?>
                                        </div>
                                        <div class="row" style="justify-content: end;margin-right: 10px;">
                                            <div class="pagination">
                                                <!--<li class="page-item previous-page disable"><a class="page-link" href="#">Prev</a></li>
                                                <li class="page-item current-page active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                                                <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
                                                <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
                                                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                                                <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
                                                <li class="page-item next-page"><a class="page-link" href="#">Next</a></li>-->
                                            </div>
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

<!-- Category List CSS here -->
<style>
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
</style>

<!-- Pagination CSS here -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    .previous-page, .next-page{
    cursor: pointer;
    transition: 0.3s ease;
    }

    .previous-page:hover{
    transform: translateX(-5px);
    }

    .next-page:hover{
    transform: translateX(5px);
    }

    .current-page, .dots{
    cursor: pointer;
    }        
</style>

<!-- Pagination Script Here -->
<script type="text/javascript">
    function getPageList(totalPages, page, maxLength){
        function range(start, end){
        return Array.from(Array(end - start + 1), (_, i) => i + start);
        }
    
        var sideWidth = maxLength < 9 ? 1 : 2;
        var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
        var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;
    
        if(totalPages <= maxLength){
        return range(1, totalPages);
        }
    
        if(page <= maxLength - sideWidth - 1 - rightWidth){
        return range(1, maxLength - sideWidth - 1).concat(0, range(totalPages - sideWidth + 1, totalPages));
        }
    
        if(page >= totalPages - sideWidth - 1 - rightWidth){
        return range(1, sideWidth).concat(0, range(totalPages- sideWidth - 1 - rightWidth - leftWidth, totalPages));
        }
    
        return range(1, sideWidth).concat(0, range(page - leftWidth, page + rightWidth), 0, range(totalPages - sideWidth + 1, totalPages));
    }
    
    $(function(){
        var numberOfItems = $(".card-content .product-item").length;
        var limitPerPage = 12; //How many card items visible per a page
        var totalPages = Math.ceil(numberOfItems / limitPerPage);
        var paginationSize = 7; //How many page elements visible in the pagination
        var currentPage;
    
        function showPage(whichPage){
            if(whichPage < 1 || whichPage > totalPages) return false;
        
            currentPage = whichPage;
        
            $(".card-content .product-item").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();
        
            $(".pagination li").slice(1, -1).remove();
        
            getPageList(totalPages, currentPage, paginationSize).forEach(item => {
                $("<li>").addClass("page-item").addClass(item ? "current-page" : "dots")
                .toggleClass("active", item === currentPage).append($("<a>").addClass("page-link")
                .attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next-page");
            });
        
            $(".previous-page").toggleClass("disabled", currentPage === 1);
            $(".next-page").toggleClass("disabled", currentPage === totalPages);
            return true;
            }
        
            $(".pagination").append(
            $("<li>").addClass("page-item").addClass("previous-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Prev")),
            $("<li>").addClass("page-item").addClass("next-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Next"))
            );
        
            $(".card-content").show();
            showPage(1);
        
            $(document).on("click", ".pagination li.current-page:not(.active)", function(){
            return showPage(+$(this).text());
            });
        
            $(".next-page").on("click", function(){
            return showPage(currentPage + 1);
            });
        
            $(".previous-page").on("click", function(){
            return showPage(currentPage - 1);
        });
    });
</script>

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