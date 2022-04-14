<?php
    require __DIR__ . '/header.php';

    if(isset($_GET['Panel']))
    {
        $_SESSION['AdminPanel'] = $_GET['AdminPanel'];
    }
    else
    {
        $_SESSION['AdminPanel'] = "All";
    }

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

    //Product Status in DB - Active, Inactive, Banned, Suspended, Deleted
    if(isset($_POST['BanProduct']))
    {
        $productId = $_POST['BanProduct'];
        $sql = "UPDATE `product` SET product_status= 'B' WHERE product_id = '$productId'";
        if(mysqli_query($conn, $sql))
        {
            $Panel = $_SESSION['AdminPanel'];
            ?>
                <script type="text/javascript">
                    alert("Ban Successful");
                    window.location.href = window.location.origin + "/seller/adminManage.php?Panel=<?php echo($Panel)?>";
                </script>
            <?php
        }
    }
    else if(isset($_POST['UnbanProduct']))
    {
        $productId = $_POST['UnbanProduct'];
        $sql = "UPDATE `product` SET product_status= 'I' WHERE product_id = '$productId'";
        if(mysqli_query($conn, $sql))
        {
            $Panel = $_SESSION['AdminPanel'];
            ?>
                <script type="text/javascript">
                    alert("Approve Successful");
                    window.location.href = window.location.origin + "/seller/adminManage.php?Panel=<?php echo($Panel)?>";
                </script>
            <?php
        }
    }
    else if(isset($_POST['DeleteProduct']))
    {
        $productId = $_POST['DeleteProductID'];
        $sql_delete = "DELETE FROM product WHERE product_id = '$productId'";
        if(mysqli_query($conn, $sql_delete))
        {
            $sql_deleteVar = "DELETE FROM variation WHERE product_id = '$productId'";
            if(mysqli_query($conn, $sql_deleteVar))
            {
                $Panel = $_SESSION['AdminPanel'];
                ?>
                    <script type="text/javascript">
                        alert("Product Deleted Successful");
                        window.location.href = window.location.origin + "/seller/myProduct.php?Panel=<?php echo($Panel)?>";
                    </script>
                <?php
            }
        }
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid" id="mainContainer">
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
                                <a class="nav-item nav-link <?php echo($_GET['Panel'] == "All" ? "active" : "" ); ?>" id="nav-all-tab" href="?Panel=All" aria-selected="<?php echo($_GET['Panel'] == "All" ? "true" : "false"); ?>">All</a>
                                <a class="nav-item nav-link <?php echo($_GET['Panel'] == "Publish" ? "active" : ""); ?>" id="nav-published-tab" href="?Panel=Publish" aria-selected="<?php echo($_GET['Panel'] == "Publish" ? "true" : "false"); ?>">Published</a>
                                <a class="nav-item nav-link <?php echo($_GET['Panel'] == "OutOfStock" ? "active" : ""); ?>" id="nav-sold-tab" href="?Panel=OutOfStock" aria-selected="<?php echo($_GET['Panel'] == "OutOfStock" ? "true" : "false"); ?>">Out of Stock</a>
                                <a class="nav-item nav-link <?php echo($_GET['Panel'] == "Violation" ? "active" : ""); ?>" id="nav-violation-tab" href="?Panel=Violation" aria-selected="<?php echo($_GET['Panel'] == "Violation" ? "true" : "false"); ?>">Banned</a>
                                <a class="nav-item nav-link <?php echo($_GET['Panel'] == "Unpublish" ? "active" : ""); ?>" id="nav-unpublish-tab" href="?Panel=Unpublish" aria-selected="<?php echo($_GET['Panel'] == "Delisted" ? "true" : "false"); ?>">Delisted</a>
                            </nav>

                            <br>

                            <div class="tab-content" id="nav-tabContent">
                                    <!-- All Product Tab -->
                                <div class="tab-pane active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                                    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                        <!-- Pagination Loop Start From here -->
                                        <!-- Product List -->
                                        <div class="card-content row mb-3" style="display: none">
                                            <!--PHP Loop Product List by Search Result-->
                                            <?php
                                                if($_POST['keyword'] != "" || $_POST['category'] != "")
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

                                                    if($_POST['keyword'] != "" && $_POST['category'] != "")
                                                    {
                                                        $keyword = $_POST['keyword'];
                                                        $category = $_POST['category'];
                                                        $sql = "SELECT DISTINCT A.product_id FROM product AS A LEFT JOIN variation AS B ON A.product_id = B.product_id LEFT JOIN category AS C ON A.category_id = C.category_id WHERE $searchBy LIKE '%$keyword%' AND category_id = '$category' ";
                                                    }
                                                    else if($_POST['keyword'] != "")
                                                    {
                                                        $keyword = $_POST['keyword'];
                                                        $sql = "SELECT DISTINCT A.product_id FROM product AS A LEFT JOIN variation AS B ON A.product_id = B.product_id LEFT JOIN category AS C ON A.category_id = C.category_id WHERE $searchBy LIKE '%$keyword%'";
                                                    }
                                                    else if($_POST['category'] != "")
                                                    {
                                                        $category = $_POST['category'];
                                                        $sql = "SELECT DISTINCT A.product_id FROM product AS A LEFT JOIN category AS C ON A.category_id = C.category_id WHERE category_id = '$category' ";
                                                    }

                                                    if(isset($_GET['Panel']))
                                                    {
                                                        switch($_GET['Panel'])
                                                        {
                                                            case "Publish":
                                                                $sql .= " AND A.product_status = 'A'";
                                                                break;
                                                            case "Unpublish":
                                                                $sql .= " AND A.product_status = 'I'";
                                                                break;
                                                            case "Violation":
                                                                $sql .= " AND A.product_status = 'B'";
                                                                break;
                                                            case "OutOfStock":
                                                                $sql .= " AND A.product_status = 'O'";
                                                                break;
                                                        }
                                                    }

                                                    $shopId = $_SESSION['userId'];
                                                    $sql .= " AND A.shop_id = '$shopId'";

                                                    $result = mysqli_query($conn, $sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        while($row = mysqli_fetch_assoc($result)) {

                                                            //Fetch each product information
                                                            $id = $row['product_id'];
                                                            $sql_1 = "SELECT A.product_id, A.product_name,A.product_cover_picture,A.product_variation,A.product_price,A.product_stock,A.product_sold,
                                                            C.max_price,D.min_price,F.total_stock FROM `product` AS A 
                                                            LEFT JOIN variation AS B ON A.product_id = B.product_id 
                                                            LEFT JOIN (SELECT product_id,product_price AS max_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price DESC LIMIT 1) AS C ON A.product_id = C.product_id 
                                                            LEFT JOIN (SELECT product_id,product_price AS min_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price ASC LIMIT 1) AS D ON A.product_id = D.product_id 
                                                            LEFT JOIN (SELECT product_id, SUM(product_stock) AS total_stock FROM `variation` WHERE product_id = '$id' GROUP BY product_id) AS F ON A.product_id = F.product_id
                                                            WHERE A.product_id = '$id' 
                                                            LIMIT 1";
                                                            $result_1 = mysqli_query($conn, $sql_1);
                                                
                                                            if (mysqli_num_rows($result_1) > 0) {
                                                                while($row_1 = mysqli_fetch_assoc($result_1)) {
                                                                    
                                                                    echo("
                                                                        <div class=\"col-xl-2 col-lg-4 col-sm-6 product-item\" style=\"padding-bottom: .625rem;\">
                                                                            <a data-sqe=\"link\" href=\"editProduct.php?id=".$row_1['product_id']."\">
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
                                                                        

                                                                        echo("
                                                                                        </div>
                                                                                            <div class=\"row\" style=\"height: 40px;\">
                                                                                                <div class=\"col-xl-6\">
                                                                                                    <p style=\"font-size:0.8rem;color:grey;\">Stock ".$row_1['total_stock']."</p>
                                                                                                </div>
                                                                                                <div class=\"col-xl-6\">
                                                                                                    <p style=\"font-size:0.8rem;color:grey;\">Sold ".$row_1['product_sold']."</p>
                                                                                                </div>
                                                                                            </div>
                                                                        ");
                                                                    }
                                                                    //If no variation
                                                                    else
                                                                    {
                                                                        echo("<b><span style=\"font-size:1rem;\">RM ".$row_1['product_price']." <span></b>");

                                                                        echo("
                                                                                        </div>
                                                                                            <div class=\"row\" style=\"height: 40px;\">
                                                                                                <div class=\"col-xl-6\">
                                                                                                    <p style=\"font-size:0.8rem;color:grey;\">Stock ".$row_1['product_stock']."</p>
                                                                                                </div>
                                                                                                <div class=\"col-xl-6\">
                                                                                                    <p style=\"font-size:0.8rem;color:grey;\">Sold ".$row_1['product_sold']."</p>
                                                                                                </div>
                                                                                            </div>
                                                                        ");
                                                                    }

                                                                    echo("
                                                                    <div class=\"row\">
                                                                    <div class=\"col-xl-12\" style=\"padding:0;\">
                                                                        <a class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" href=\"editProduct.php?id=".$row_1['product_id']."\" ><i class=\"fa fa-edit \" style=\"padding:0 10px;\" aria-hidden=\"true\"></i>Edit</a>
                                                                    </div>
                                                                    <div class=\"col-xl-6\" style=\"padding:0;\">
                                                                    ");

                                                                    if($row_1['product_status'] == "A")
                                                                    {
                                                                        echo("<button class=\"btn btn-outline-secondary\" style=\"border:none;width:100%;\" name=\"UnpublishProduct\" value=\"".$row_1['product_id']."\" >Delist</button>");
                                                                    }
                                                                    else if($row_1['product_status'] == "I")
                                                                    {
                                                                        echo("<button class=\"btn btn-outline-info\" style=\"border:none;width:100%;\" name=\"PublishProduct\" value=\"".$row_1['product_id']."\" >Publish</button>");
                                                                    }

                                                                    echo("
                                                                    </div>
                                                                        <div class=\"col-xl-6\" style=\"padding:0;\">
                                                                            <a class=\"btn btn-outline-danger\" style=\"border:none;width:100%;\" href=\"?delete=".$row_1['product_id']."\" ><i class=\"fa fa-trash \" aria-hidden=\"true\"></i></a>
                                                                        </div>
                                                                    ");
                                                                    
                                                                    echo("
                                                                                                
                                                                                            
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
                                                    else
                                                    {
                                                        //No result
                                                    }
                                                }
                                                else
                                                {
                                                    $sql = "SELECT DISTINCT A.product_id FROM product AS A";

                                                    if(isset($_GET['Panel']))
                                                    {
                                                        switch($_GET['Panel'])
                                                        {
                                                            case "Publish":
                                                                $sql .= " WHERE A.product_status = 'A'";
                                                                break;
                                                            case "Unpublish":
                                                                $sql .= " WHERE A.product_status = 'I'";
                                                                break;
                                                            case "Violation":
                                                                $sql .= " WHERE A.product_status = 'B'";
                                                                break;
                                                            case "OutOfStock":
                                                                $sql .= " WHERE A.product_status = 'O'";
                                                                break;
                                                        }
                                                    }

                                                    $result = mysqli_query($conn, $sql);
                                        
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while($row = mysqli_fetch_assoc($result)) {

                                                            //Fetch each product information
                                                            $id = $row['product_id'];
                                                            $sql_1 = "SELECT A.product_id, A.product_name,A.product_cover_picture,A.product_variation,A.product_price,A.product_stock,A.product_sold,A.product_status,
                                                            C.max_price,D.min_price,F.total_stock,G.shop_name FROM `product` AS A 
                                                            LEFT JOIN variation AS B ON A.product_id = B.product_id 
                                                            LEFT JOIN (SELECT product_id,product_price AS max_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price DESC LIMIT 1) AS C ON A.product_id = C.product_id 
                                                            LEFT JOIN (SELECT product_id,product_price AS min_price FROM `variation` WHERE product_id = '$id' ORDER BY product_price ASC LIMIT 1) AS D ON A.product_id = D.product_id 
                                                            LEFT JOIN (SELECT product_id, SUM(product_stock) AS total_stock FROM `variation` WHERE product_id = '$id' GROUP BY product_id) AS F ON A.product_id = F.product_id
                                                            LEFT JOIN shopProfile AS G ON A.shop_id = G.shop_id
                                                            WHERE A.product_id = '$id' 
                                                            LIMIT 1";
                                                            $result_1 = mysqli_query($conn, $sql_1);
                                                
                                                            if (mysqli_num_rows($result_1) > 0) {
                                                                while($row_1 = mysqli_fetch_assoc($result_1)) {
                                                                    
                                                                    echo("
                                                                        <div class=\"col-xl-2 col-lg-4 col-sm-6 product-item\" style=\"padding-bottom: .625rem;\">
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
                                                                    }
                                                                    //If no variation
                                                                    else
                                                                    {
                                                                        echo("<b><span style=\"font-size:1rem;\">RM ".$row_1['product_price']." <span></b>");

                                                                        echo("</div>");
                                                                    }

                                                                    echo("
                                                                    <div class=\"row\" style=\"height: 40px;\">
                                                                        <div class=\"col-xl-12\">
                                                                            <p style=\"font-size:0.8rem;color:grey;\">".$row_1['shop_name']."</p>
                                                                        </div>
                                                                    </div>
                                                                    ");

                                                                    

                                                                    if($row_1['product_status'] == "A")
                                                                    {
                                                                        echo("
                                                                            <div class=\"row\">
                                                                                <div class=\"col-xl-12\" style=\"padding:0;\">
                                                                                    <button class=\"btn btn-outline-secondary\" style=\"border:none;width:100%;\" name=\"BanProduct\" value=\"".$row_1['product_id']."\" >Ban</button>
                                                                                </div>
                                                                            </div>
                                                                        ");
                                                                    }
                                                                    else if($row_1['product_status'] == "B")
                                                                    {
                                                                        echo("
                                                                            <div class=\"row\">
                                                                                <div class=\"col-xl-12\" style=\"padding:0;\">
                                                                                    <button class=\"btn btn-outline-info\" style=\"border:none;width:100%;\" name=\"UnbanProduct\" value=\"".$row_1['product_id']."\" >Approve</button>
                                                                                </div>
                                                                            </div>
                                                                        ");
                                                                    }

                                                                    echo("
                                                                                    </div>       
                                                                                </div>   
                                                                        </div>
                                                                    ");
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                
                                            ?>
                                        </div>
                                    </form>
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
                                    <!-- Pagination Loop End From here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

     <!-- Delete Product Modal - deleteProductModel -->
     <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal fade" id="deleteProductModel" tabindex="-1" role="dialog" aria-labelledby="deleteProductModel" <?php echo(isset($_GET['delete']) ? "" : "aria-hidden=\"true\"");?> >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Delete Product</h5>
                    <button type="button" class="close closeDeleteModel" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-sm-4">
                            <div class="image-container">
                                <?php
                                    $productId = $_GET['delete'];
                                    $sql = "SELECT product_cover_picture FROM product WHERE product_id = '$productId'";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            
                                            $picture = $row["product_cover_picture"];
                                            $picName = "";

                                            if($row["product_cover_picture"] != "")
                                            {
                                                $picName = "/img/product/".$row["product_cover_picture"];
                                            }
                                            
                                            echo("<img class=\"card-img-top img-thumbnail\" style=\"object-fit:contain;width:100%;height:100%;min-height:10px;\" src=\"$picName\">");
                                        }
                                    }
                                    else
                                    {
                                        echo("<img class=\"card-img-top img-thumbnail\" style=\"object-fit:contain;width:100%;height:100%\">");
                                    }
                                ?>
                                
                                <div class="image-layer">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-sm-9">
                            <div class="form-group">
                                <label>Product Name</label>
                                <?php
                                $productId = $_GET['delete'];
                                $sql = "SELECT product_id,product_name FROM product WHERE product_id = '$productId'";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $productId = $row["product_id"];
                                        $productName = $row["product_name"];

                                        echo("<input type=\"text\" class=\"form-control\" name=\"DeleteProductID\" value=\"$productId\" hidden>");
                                        echo("<input type=\"text\" class=\"form-control\" name=\"DeleteProductName\" value=\"$productName\" readonly>");
                                    }
                                }
                                ?>
                                <p style="color:#ce0000;">Caution</p>
                                <p style="color:#ce0000;">Once deleted, the product will not able to restore</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeDeleteModel" data-dismiss="modal">Close</button>
                    <button type="submit" name="DeleteProduct"  class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </form>
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

    .Name,.Tag{
        height: 50px;
        overflow: hidden;
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
    window.addEventListener('load', function () {
        if(<?php echo(isset($_GET['delete']) ? "1" : "0") ?> == 1)
        {
            $("#deleteProductModel").modal('show');
        }
    });

    const closeDeleteModel = document.querySelectorAll('.closeDeleteModel');

    closeDeleteModel.forEach(btn => {
        btn.addEventListener('click', function handleClick(event) {
            $("#deleteProductModel").modal('hide');
        });
    });

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

