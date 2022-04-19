<?php
    require __DIR__ . '/header.php';
?>

<?php
    if($_SESSION['login'] == true && $_SESSION['role'] == "SELLER")
	{
		?><script>window.location = '<?php echo("$domain/seller/dashboard.php");?>'</script><?php
		exit;
    }
    //Fetch each promotion image information
    $promotion_title = array();
    $promotion_image = array();

    $sql_promotion = "SELECT * FROM promotion AS A LEFT JOIN user AS B ON A.user_id = B.userID WHERE B.role = 'ADMIN' AND promotionEnd_Date >= now()";

    $result_promotion = mysqli_query($conn, $sql_promotion);
    
    if (mysqli_num_rows($result_promotion) > 0) {
        while($row_promotion = mysqli_fetch_assoc($result_promotion)) {
            array_push($promotion_title,$row_promotion['promotion_title']);
        array_push($promotion_image,$row_promotion['promotion_image']);
        }
    }   
    else{
        ?>
            <script type="text/javascript">
                //window.location.href = window.location.origin + "/index.php";
            </script>
        <?php
    }
?>
                <!-- Begin Page Content -->
                <div class="container-fluid" id="mainContainer">

                    <!-- Content Row - Slidebar and SlideShow -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-12 col-12">
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
                                                                <a href=\"category.php?mainCategory=$maincategoryid\" class=\"nav-link\">
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
                                                                    <a href=\"category.php?mainCategory=$maincategoryid&subCategory=$subCategoryId\" class=\"dropdown-item\">$subCategoryName</a>
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
                                                        <a href=\"category.php?mainCategory=$maincategoryid\" class=\"nav-link\">
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
                        <div class="col-xl-9">
                            <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                                <div class="carousel-inner">
                                <?php
										for($i = 0; $i < count($promotion_image); $i++)
										{
											if($promotion_image[$i] != "")
											{
												$picName = "/img/promotion/".$promotion_image[$i];
												if($i == 0)
												{
													echo("<div class=\"carousel-item active\"> <img src=\"$picName\" alt=\"".$promotion_title[$i]."\"> </div>");
												}
												else
												{
													echo("<div class=\"carousel-item\"> <img src=\"$picName\" alt=\"".$promotion_title[$i]."\"> </div>");
												}
											}
										}

									?>
                                </div>

                               <!-- Left right --> 
								<a class="carousel-control-prev" style="bottom: 10%;" href="#custCarousel" data-slide="prev"> <span class="border bg-secondary rounded carousel-control-prev-icon"></span> </a> 
								<a class="carousel-control-next" style="bottom: 10%;" href="#custCarousel" data-slide="next"> <span class="border bg-secondary rounded carousel-control-next-icon"></span> </a> 
                                
                            </div>
                        </div>
                    </div>

                    <br>

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
                                            $sql = "SELECT product_id FROM product WHERE product_status = 'A'";

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
                                                                    echo("<p style=\"font-size:0.8rem;color:grey;margin-bottom: 0px;height: 23px;\">No Rating Yet</p>");
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

    /*Slide show*/

    .image-container{
        width:100%;
        height: 25vh;
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
        background-color:transparent;
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

    #custCarousel .carousel-indicators li.active img {
        opacity: 1
    }

    #custCarousel .carousel-indicators li:hover img {
        opacity: 0.75
    }

    .firstThumbnail{
		margin-left: 100px !important;
	}

	@media only screen and (min-width: 600px) {
		.firstThumbnail{
			margin-left:0 !important;;
		}
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

