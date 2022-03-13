<?php
    require __DIR__ . '/header.php'
?>

<!-- Content Row - Slidebar and SlideShow -->
<div class="row">
   <div class="col-xl-2 col-lg-2 col-0">
       <div class="browse-menus">
           <div class="browse-menu active">
               <ul class="main-menu">
                   <!-- PHP Loop here - Category -->
                   <?php
                    //Check for Main Category
                    $sql = "SELECT * FROM mainCategory";
                    $result = mysqli_query($conn, $sql);
                             
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {

                        $verifier = 0;
                        //Check For Sub Category
                        $sql_1 = "SELECT * FROM subCategory WHERE main_category_id = \"".$row['main_category_id']."\"";
                        $result_1 = mysqli_query($conn, $sql_1);
                                          
                        if (mysqli_num_rows($result_1) > 0) {
                              $verifier = 1;
                              echo("
                                 <li class=\"menu-item menu-item-has-children\" style=\"display: list-item;\">
                                    <a href=\"{$domain_link}/category.php?id=".$row['main_category_name']."\" class=\"nav-link\">
                                    <img src=\"".$row['main_category_pic']."\" style=\"width:25px;margin-right:5px;\">
                                    ".$row['main_category_name']."
                                    <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>
                                    </a>
                                          <ul class=\"dropdown-menu\">
                              ");

                           while($row_1 = mysqli_fetch_assoc($result_1)) {
                                 echo("
                                             <li class=\"menu-item\">
                                                   <a href=\"{$domain_link}/category.php?id=".$row_1['sub_category_name']."\" class=\"dropdown-item\">".$row_1['sub_category_name']."</a>
                                             </li>
                                 ");
                              }
                              echo("
                                       </li>
                                 </ul>
                              ");
                           }

                            if($verifier == 0)
                            {
                                //If no sub category, display as normal
                                echo("
                                <li class=\"menu-item\" style=\"display: list-item;\">
                                <a href=\"{$domain_link}/category.php?id=".$row['main_category_name']."\" class=\"nav-link\">
                                <img src=\"".$row['main_category_pic']."\" style=\"width:25px;margin-right:5px;\">
                                ".$row['main_category_name']."
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


<?php
    require __DIR__ . '/footer.php'
?>