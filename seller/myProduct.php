<?php
    require __DIR__ . '/header.php';

    $subCategoryArray = array();

    //Main Category
    $sql = "SELECT DISTINCT(B.category_id),B.category_name FROM categoryCombination AS A LEFT JOIN  category AS B ON A.main_category = B.category_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $maincategoryid = $row["category_id"];
            
            $sql_1 = "SELECT B.category_id,B.category_name FROM categoryCombination AS A LEFT JOIN  category AS B ON A.sub_category = B.category_id WHERE main_category = '$maincategoryid' AND sub_Yes = '1'";
            $result_1 = mysqli_query($conn, $sql_1);

            if (mysqli_num_rows($result_1) > 0) {
                $tempArray = array();

                while($row_1 = mysqli_fetch_assoc($result_1)) {
                    $categoryId = $row_1["category_id"];
                    $categoryName = $row_1["category_name"];

                    array_push($tempArray,array($categoryId,$categoryName));
                }
                $tempCategoryArray = array($maincategoryid => $tempArray);    
            }
            else
            {
                $tempArray = array();
                $tempCategoryArray = array($maincategoryid => $tempArray);
            }
            $subCategoryArray = $subCategoryArray + $tempCategoryArray;
        }
    }      

?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">
    <!-- Product Filter -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Filter Product</h5>
                </div>

                <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <select class="form-select" name="searchBy" aria-label="SearchBy" style="color:currentColor;border: 0.5px solid #d1d3e2; border-radius: 5px;">
                                            <option selected value="name">Product Name</option>
                                            <option value="sku">Product SKU</option>
                                        </select>
                                    </div>
                                    <input type="text" id="inpKeyword" class="form-control" name="keyword" placeholder="Enter ..." aria-label="SearchKeyword">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-sm-12" style="padding-bottom: .625rem;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Main Category</span>
                                    </div>
                                    <select class="form-control" id="mainCategory" onchange='makeSubmenu(this.value)' name="mainCategoryId">
                                        <option value="All" selected>All</option>
                                            <?php
                                            //Main Category
                                            $sql = "SELECT DISTINCT(B.category_id),B.category_name FROM categoryCombination AS A LEFT JOIN  category AS B ON A.main_category = B.category_id";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $categoryId = $row["category_id"];
                                                    $categoryName = $row["category_name"];

                                                    echo("<option value=\"$categoryId\">$categoryName</option>");
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-sm-12" style="padding-bottom: .625rem;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Sub Category</span>
                                    </div>
                                    <select class="form-control" id="subCategory" name="subCategoryId">
    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-10 col-lg-8 col-sm-4" style="padding-bottom: .625rem;">
                                
                            </div>
                            <div class="col-xl-1 col-lg-2 col-sm-4" style="padding-bottom: .625rem;">
                                <button type="submit" name="submitSearch" class="btn btn-primary">Search</button>
                            </div>
                            <div class="col-xl-1 col-lg-2 col-sm-4" style="padding-bottom: .625rem;">
                                <button type="submit"  class="btn btn-outline-dark">Reset</button>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- List All Product -->
    <div class="row">
        <!--Product List -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Product List</h5>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                            <nav id="myTab" class="nav nav-tabs" role="tablist">
                                <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">All</a>
                                <a class="nav-item nav-link" id="nav-published-tab" data-toggle="tab" href="#nav-published" role="tab" aria-controls="nav-published" aria-selected="false">Published</a>
                                <a class="nav-item nav-link" id="nav-sold-tab" data-toggle="tab" href="#nav-sold" role="tab" aria-controls="nav-sold" aria-selected="false">Out of Stock</a>
                                <a class="nav-item nav-link" id="nav-violation-tab" data-toggle="tab" href="#nav-violation" role="tab" aria-controls="nav-violation" aria-selected="false">Banned</a>
                                <a class="nav-item nav-link" id="nav-unpublish-tab" data-toggle="tab" href="#nav-unpublish" role="tab" aria-controls="nav-unpublish" aria-selected="false">Unpublished</a>
                            </nav>

                            <br>

                            <div class="tab-content" id="nav-tabContent">
                                    <!-- All Product Tab -->
                                <div class="tab-pane active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                                    <!-- Header Bar -->
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6" style="padding-bottom: .625rem;">
                                            <div class="col-xl-10 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">

                                                <?php
                                                
                                                    if(isset($_POST['submitSearch']))
                                                    {
                                                        $sql_count = "SELECT COUNT(DISTINCT A.product_id) AS total_product FROM product AS A";

                                                        if(isset($_POST['keyword']))
                                                        {
                                                            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";
                                                            switch($_POST['searchBy'])
                                                            {
                                                                case "name":
                                                                    $searchBy = "product_name";
                                                                    break;
                                                                case "mainsku":
                                                                    $searchBy = "product_sku";
                                                                    break;
                                                                case "sku":
                                                                    $searchBy = "sub_product_id";
                                                                    break;
                                                                default:
                                                                    $searchBy = "product_name";
                                                                    break;
                                                            }
                                                            $sql_count .= "WHERE $searchBy LIKE %$keyword% ";
                                                        }
                                                        if(isset($_POST['mainCategoryId']))
                                                        {
                                                            $mainCategoryId = $_POST['mainCategoryId'] != "All" ? $_POST['mainCategoryId'] : "";
                                                            $subCategoryId = $_POST['subCategoryId'] != "" ? $_POST['subCategoryId'] : "";
    
                                                            if($mainCategoryId != "All")
                                                            {
                                                                $sql = "SELECT combination_id FROM categoryCombination WHERE main_category = '$mainCategoryId'";
                                                                if($subCategoryId != "")
                                                                {
                                                                    $sql .= " sub_category = '$subCategoryId'";
                                                                }
    
                                                                $result = mysqli_query($conn, $sql);
                                                                if (mysqli_num_rows($result) > 0) {
                                                                    $sql_count .= "AND (";
                                                                    while($row = mysqli_fetch_assoc($result)) {
                                                                        $cc_id = $row['combination_id'];
                                                                        $sql_count .= "category_id = $cc_id OR";
                                                                    }
                                                                    $sql_count .= substr($sql_count,0,-2) . ")";
                                                                }
                                                            }
                                                        }

                                                        
                                                        $result = mysqli_query($conn, $sql);
                                                
                                                            if (mysqli_num_rows($result) > 0) {
                                                                while($row = mysqli_fetch_assoc($result)) {
                                                                    $total = (int) $row["total_product"];
                                                                    $percent = $total/10;
                                                                    $uploadAvailable = 1000 - $total;
                                                                    echo("
                                                                        <h5>$total Products</h5>
                                                                    
                                                                        <div class=\"progress\" style=\"height:0.3rem;\">
                                                                            <div class=\"progress-bar\" role=\"progressbar\" style=\"width: $percent%\" aria-valuenow=\"$percent\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                                                        </div>
                                                                        <p data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Number of upload product available = 1000 - Number of current product\">You can still upload $uploadAvailable products</p>
                                                                                
                                                                    ");
                                                                }
                                                            }
                                                    }
                                                    else
                                                    {
                                                        $sql = "SELECT COUNT(DISTINCT A.product_id) AS total_product FROM product AS A";
                                                        $result = mysqli_query($conn, $sql);
                                            
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while($row = mysqli_fetch_assoc($result)) {
                                                                $total = (int) $row["total_product"];
                                                                $percent = $total/10;
                                                                $uploadAvailable = 1000 - $total;
                                                                echo("
                                                                    <h5>$total Products</h5>
                                                                
                                                                    <div class=\"progress\" style=\"height:0.3rem;\">
                                                                        <div class=\"progress-bar\" role=\"progressbar\" style=\"width: $percent%\" aria-valuenow=\"$percent\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                                                    </div>
                                                                    <p data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Number of upload product available = 1000 - Number of current product\">You can still upload $uploadAvailable products</p>
                                                                            
                                                                ");
                                                            }
                                                        }
                                                    }                                                        
                                                ?>

                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-sm-6" style="padding-bottom: .625rem;text-align:end;">
                                            <a href="addProduct.php" class="btn btn-primary">New Product</a>
                                        </div>
                                    </div>

                                    <!-- Product List -->
                                    <div class="card-content" style="display: none">
                                        <!--PHP Loop Product List by Search Result-->
                                        <?php
                                            if(isset($_POST['keyword']) || isset($_POST['category']))
                                            {
                                                $keyword = "";
                                                $category="";

                                                if(isset($_POST['searchBy']))
                                                {
                                                    switch($_POST['searchBy'])
                                                    {
                                                        case "name":
                                                            $searchBy = "product_name";
                                                            break;
                                                        case "mainsku":
                                                            $searchBy = "product_sku";
                                                            break;
                                                        case "sku":
                                                            $searchBy = "sub_product_id";
                                                            break;
                                                        default:
                                                            $searchBy = "product_name";
                                                    }
                                                }

                                                if(isset($_POST['keyword']) && isset($_POST['category']))
                                                {
                                                    $keyword = $_POST['keyword'];
                                                    $category = $_POST['category'];
                                                    $sql = "SELECT DISTINCT A.product_id FROM product AS A LEFT JOIN variation AS B ON A.product_id = B.product_id LEFT JOIN category AS C ON A.category_id = C.category_id WHERE $searchBy LIKE '%$keyword%' AND category_id = '$category' ";
                                                }
                                                else if(isset($_POST['keyword']))
                                                {
                                                    $keyword = $_POST['keyword'];
                                                    $sql = "SELECT DISTINCT A.product_id FROM product AS A LEFT JOIN variation AS B ON A.product_id = B.product_id LEFT JOIN category AS C ON A.category_id = C.category_id WHERE $searchBy LIKE '%$keyword%'";
                                                }
                                                else if(isset($_POST['category']))
                                                {
                                                    $category = $_POST['category'];
                                                    $sql = "SELECT DISTINCT A.product_id FROM product AS A LEFT JOIN category AS C ON A.category_id = C.category_id WHERE category_id = '$category' ";
                                                }

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
                                                                    <div class=\"col-xl-3 col-lg-4 col-sm-6 product-item\" style=\"padding-bottom: .625rem;\">
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
                                                                    echo("<b><span style=\"font-size:1rem;\">RM ".$row_1['min_price']." - RM ".$row_1['max_price']." <span></b>");

                                                                    echo("
                                                                                    </div>
                                                                                        <div class=\"row\">
                                                                                            <div class=\"col-xl-6\">
                                                                                                <p style=\"font-size:0.8rem;color:grey;\">Stock ".$row_1['total_stock']."</p>
                                                                                            </div>
                                                                                            <div class=\"col-xl-6\">
                                                                                                <p style=\"font-size:0.8rem;color:grey;\">Sold ".$row_1['total_sold']."</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class=\"row\">
                                                                                            <div class=\"col-xl-6\" style=\"padding:0;\">
                                                                                                <button class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" name=\"EditProduct\" value=\"".$row_1['product_id']."\" >Edit</button>
                                                                                            </div>
                                                                                            <div class=\"col-xl-6\" style=\"padding:0;\">
                                                                    ");
                                                                    if($row_1['product_status'] == 1)
                                                                    {
                                                                        echo("<button class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" name=\"UnpublishProduct\" value=\"".$row_1['product_id']."\" >Unpublish</button>");
                                                                    }
                                                                    else
                                                                    {
                                                                        echo("<button class=\"btn btn-outline-info\" style=\"border:none;width:100%;\" name=\"PublishProduct\" value=\"".$row_1['product_id']."\" >Publish</button>");
                                                                    }

                                                                    echo("
                                                                                                
                                                                                            </div>
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
                                                                    echo("<b><span style=\"font-size:1rem;\">RM ".$row_1['product_price']." <span></b>");

                                                                    echo("
                                                                                    </div>
                                                                                        <div class=\"row\">
                                                                                            <div class=\"col-xl-6\">
                                                                                                <p style=\"font-size:0.8rem;color:grey;\">Stock ".$row_1['product_stock']."</p>
                                                                                            </div>
                                                                                            <div class=\"col-xl-6\">
                                                                                                <p style=\"font-size:0.8rem;color:grey;\">Sold ".$row_1['product_sold']."</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class=\"row\">
                                                                                            <div class=\"col-xl-6\" style=\"padding:0;\">
                                                                                                <button class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" name=\"EditProduct\" value=\"".$row_1['product_id']."\" >Edit</button>
                                                                                            </div>
                                                                                            <div class=\"col-xl-6\" style=\"padding:0;\">
                                                                    ");
                                                                    if($row_1['product_status'] == 1)
                                                                    {
                                                                        echo("<button class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" name=\"UnpublishProduct\" value=\"".$row_1['product_id']."\" >Unpublish</button>");
                                                                    }
                                                                    else
                                                                    {
                                                                        echo("<button class=\"btn btn-outline-info\" style=\"border:none;width:100%;\" name=\"PublishProduct\" value=\"".$row_1['product_id']."\" >Publish</button>");
                                                                    }

                                                                    echo("
                                                                                                
                                                                                            </div>
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
                                                else
                                                {
                                                    //No result
                                                }
                                            }
                                            else
                                            {
                                                $sql = "SELECT DISTINCT A.product_id FROM product AS A";

                                                $result = mysqli_query($conn, $sql);
                                    
                                                if (mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_assoc($result)) {

                                                        //Fetch each product information
                                                        $id = $row['product_id'];
                                                        $sql_1 = "SELECT DISTINCT A.product_id, A.product_name,A.product_cover_picture,A.product_variation,A.product_price,A.product_stock,A.product_sold,A.product_status,
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
                                                                    <div class=\"col-xl-2 col-lg-3 col-sm-4 product-item\" style=\"padding-bottom: .625rem;\">
                                                                        <a data-sqe=\"link\" href=\"".$row_1['product_id']."\">
                                                                            <div class=\"card\">
                                                                                <div class=\"image-container\">
                                                                                    <img class=\"card-img-top img-thumbnail\" style=\"object-fit:contain;width:100%;height:100%\" src=\"/img/product/".$row_1['product_cover_picture']."\" alt=\"".$row_1['product_name']."\">
                                                                                </div>
                                                                                <div class=\"card-body\">
                                                                                    <div class=\"Name\">
                                                                                        <p class=\"card-text product-name\">".$row_1['product_name']."</p>
                                                                                    </div>
                                                                                    <div class=\"Price\">
                                                                ");

                                                                //If got variation
                                                                if($row_1['product_variation'] == 1)
                                                                {
                                                                    echo("<b><span style=\"font-size:1rem;\">RM ".$row_1['min_price']." - RM ".$row_1['max_price']." <span></b>");

                                                                    echo("
                                                                                    </div>
                                                                                        <div class=\"row\">
                                                                                            <div class=\"col-xl-6\">
                                                                                                <p style=\"font-size:0.8rem;color:grey;\">Stock ".$row_1['total_stock']."</p>
                                                                                            </div>
                                                                                            <div class=\"col-xl-6\">
                                                                                                <p style=\"font-size:0.8rem;color:grey;\">Sold ".$row_1['total_sold']."</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class=\"row\">
                                                                                            <div class=\"col-xl-6\" style=\"padding:0;\">
                                                                                                <button class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" name=\"EditProduct\" value=\"".$row_1['product_id']."\" >Edit</button>
                                                                                            </div>
                                                                                            <div class=\"col-xl-6\" style=\"padding:0;\">
                                                                    ");
                                                                    if($row_1['product_status'] == 1)
                                                                    {
                                                                        echo("<button class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" name=\"UnpublishProduct\" value=\"".$row_1['product_id']."\" >Unpublish</button>");
                                                                    }
                                                                    else
                                                                    {
                                                                        echo("<button class=\"btn btn-outline-info\" style=\"border:none;width:100%;\" name=\"PublishProduct\" value=\"".$row_1['product_id']."\" >Publish</button>");
                                                                    }

                                                                    echo("
                                                                                                
                                                                                            </div>
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
                                                                    echo("<b><span style=\"font-size:1rem;\">RM ".$row_1['product_price']." <span></b>");

                                                                    echo("
                                                                                    </div>
                                                                                        <div class=\"row\">
                                                                                            <div class=\"col-xl-6\">
                                                                                                <p style=\"font-size:0.8rem;color:grey;\">Stock ".$row_1['product_stock']."</p>
                                                                                            </div>
                                                                                            <div class=\"col-xl-6\">
                                                                                                <p style=\"font-size:0.8rem;color:grey;\">Sold ".$row_1['product_sold']."</p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class=\"row\">
                                                                                            <div class=\"col-xl-6\" style=\"padding:0;\">
                                                                                                <button class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" name=\"EditProduct\" value=\"".$row_1['product_id']."\" >Edit</button>
                                                                                            </div>
                                                                                            <div class=\"col-xl-6\" style=\"padding:0;\">
                                                                    ");
                                                                    if($row_1['product_status'] == 1)
                                                                    {
                                                                        echo("<button class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" name=\"UnpublishProduct\" value=\"".$row_1['product_id']."\" >Unpublish</button>");
                                                                    }
                                                                    else
                                                                    {
                                                                        echo("<button class=\"btn btn-outline-info\" style=\"border:none;width:100%;\" name=\"PublishProduct\" value=\"".$row_1['product_id']."\" >Publish</button>");
                                                                    }

                                                                    echo("
                                                                                                
                                                                                            </div>
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
                                            }
                                            
                                        ?>

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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<style>

    .nav-link{
        color:grey;
    }

    .nav-link.active{
        color:#a31f37;
        border-color: #fefeff #fff #a31f37;
    }

    .tab-pane.active {
    animation: slide-down 0.5s ease-out;
    }

    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }

    a:hover{
        text-decoration:none;
        color:#a31f37;
    }
</style>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    .card-content{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    margin: 30px;
    }

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
    width: 45px;
    cursor: pointer;
    }

    .pg-active{
    background: #0AB1CE;
    }

    .pg-disable{
    background: #ccc;
    }
        
</style>

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
        var numberOfItems = $(".card-content .card").length;
        var limitPerPage = 3; //How many card items visible per a page
        var totalPages = Math.ceil(numberOfItems / limitPerPage);
        var paginationSize = 7; //How many page elements visible in the pagination
        var currentPage;
    
        function showPage(whichPage){
        if(whichPage < 1 || whichPage > totalPages) return false;
    
        currentPage = whichPage;
    
        $(".card-content .card").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();
    
        $(".pagination li").slice(1, -1).remove();
    
        getPageList(totalPages, currentPage, paginationSize).forEach(item => {
            $("<li>").addClass("page-item").addClass(item ? "current-page" : "dots")
            .toggleClass("pg-active", item === currentPage).append($("<a>").addClass("page-link")
            .attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next-page");
        });
    
        $(".previous-page").toggleClass("pg-disable", currentPage === 1);
        $(".next-page").toggleClass("pg-disable", currentPage === totalPages);
        return true;
        }
    
        $(".pagination").append(
        $("<li>").addClass("page-item").addClass("previous-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Prev")),
        $("<li>").addClass("page-item").addClass("next-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Next"))
        );
    
        $(".card-content").show();
        showPage(1);
    
        $(document).on("click", ".pagination li.current-page:not(.pg-active)", function(){
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
    function clearSearch()
    {

    }

    function makeSubmenu(value) {
        if (value.length == 0) 
            document.getElementById("subCategory").innerHTML = "<option></option>";
        else {
            var subCategoryHTML = "<option value=\"All\">All</option>";
            var subCategory = <?php echo json_encode($subCategoryArray); ?>;

            for (counter in subCategory[value]) {
                subCategoryHTML += "<option value=\""+ subCategory[value][counter][0] +"\" >" + subCategory[value][counter][1] + "</option>";
            }
            document.getElementById("subCategory").innerHTML = subCategoryHTML;
        }
    }


</script>

<?php
    require __DIR__ . '/footer.php'
?>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

