<?php
    require __DIR__ . '/header.php'
?>
                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">

                    <!-- Content Row - Slidebar and SlideShow -->
                    <div class="row">
                        <div class="col-xl-2 col-lg-12 col-12">
                            <div class="browse-menus">
                                <div class="browse-menu active">
                                    <ul class="main-menu">
                                        <!-- PHP Loop here - Category -->
                                        <?php
                                            //Main Category
                                            $sql = "SELECT DISTINCT(B.category_id),B.category_name,B.category_pic FROM categoryCombination AS A LEFT JOIN  category AS B ON A.main_category = B.category_id";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $maincategoryid = $row["category_id"];
                                                    $categoryName = $row["category_name"];
                                                    $picName = "";
                                                    if($row["category_pic"] != "")
                                                    {
                                                        $picName = "/img/category/".$row["category_pic"];
                                                    }

                                                    $sql_1 = "SELECT B.category_id AS subCategoryId,B.category_name AS subCategoryName FROM categoryCombination AS A LEFT JOIN  category AS B ON A.sub_category = B.category_id WHERE main_category = '$maincategoryid' AND sub_Yes = '1'";
                                                    $result_1 = mysqli_query($conn, $sql_1);

                                                    if (mysqli_num_rows($result_1) > 0) {
                                                        
                                                        echo("
                                                            <li class=\"menu-item menu-item-has-children\" style=\"display: list-item;\">
                                                                <a href=\"{$domain_link}/category.php?id=$maincategoryid\" class=\"nav-link\">
                                                                <img src=\"$picName\" style=\"width:25px;margin-right:5px;\">
                                                                $categoryName
                                                                <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>

                                                                </a>
                                                                    <ul class=\"dropdown-menu\">
                                                        ");
                                                        while($row_1 = mysqli_fetch_assoc($result_1)) {

                                                            $subCategoryId = $row_1["subCategoryId"];
                                                            $subCategoryName = $row_1["subCategoryName"];
                                                            $subPicName = "";
                                                            echo("
                                                                <li class=\"menu-item\">
                                                                    <a href=\"{$domain_link}/category.php?id=$subCategoryId\" class=\"dropdown-item\">$subCategoryName</a>
                                                                </li>
                                                            ");
                                                        }
                                                        echo("
                                                                    </ul>
                                                                </li>
                                                            ");
                                                    }
                                                    else
                                                    {
                                                        //If no sub category, display as normal
                                                        echo("
                                                        <li class=\"menu-item\" style=\"display: list-item;\">
                                                        <a href=\"{$domain_link}/category.php?id=$maincategoryid\" class=\"nav-link\">
                                                        <img src=\"$picName\" style=\"width:25px;margin-right:5px;\">
                                                        $categoryName
                                                        </a>
                                                        </li>
                                                        ");
                                                    }
                                                }
                                            }   
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Slideshow -->
                        <div class="col-xl-10">
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

                    <br>

                    <!-- List All Product - Demo Product  -->
                    <div class="row">
                        <!--Product List -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Daily Discover</h5>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <!-- Product List -->
                                    <div class="card-content row mb-3" style="display: none">
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
                                            }
                                            
                                        ?>
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

<script type="text/javascript">
    $(document).ready(function(){

        // Load more data
        $('.load-more').click(function(){
            var row = Number($('#row').val());
            var allcount = Number($('#all').val());
            var rowperpage = 3;
            row = row + rowperpage;

            if(row <= allcount){
                $("#row").val(row);

                $.ajax({
                    url: 'getData.php',
                    type: 'post',
                    data: {row:row},
                    beforeSend:function(){
                        $(".load-more").text("Loading...");
                    },
                    success: function(response){

                        // Setting little delay while displaying new content
                        setTimeout(function() {
                            // appending posts after last post with class="post"
                            $(".post:last").after(response).show().fadeIn("slow");

                            var rowno = row + rowperpage;

                            // checking row value is greater than allcount or not
                            if(rowno > allcount){

                                // Change the text and background
                                $('.load-more').text("Hide");
                                $('.load-more').css("background","darkorchid");
                            }else{
                                $(".load-more").text("Load more");
                            }
                        }, 2000);

                    }
                });
            }else{
                $('.load-more').text("Loading...");

                // Setting little delay while removing contents
                setTimeout(function() {

                    // When row is greater than allcount then remove all class='post' element after 3 element
                    $('.post:nth-child(3)').nextAll('.post').remove();

                    // Reset the value of row
                    $("#row").val(0);

                    // Change the text and background
                    $('.load-more').text("Load more");
                    $('.load-more').css("background","#15a9ce");
                    
                }, 2000);


            }

        });

    });
</script>
