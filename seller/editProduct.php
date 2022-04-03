<?php
    require __DIR__ . '/header.php';

    
    if(isset($_POST['edit'])){
        $statusMsg = $errorMsg = $errorUpload = $errorUploadType = ''; 

        //Basic Details
        $shopId = $_SESSION['userid']; // Temporary only, after that need link with session userid 

        $productId = "";
        $productSKU = $_POST['productSKU'];
        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $productBrand = $_POST['productBrand'];

        $productType = $_POST['productType'];
        $variationType = $_POST['variationType'];

        $productPrice = $variationType == 0 ? $_POST['productPrice'] : 0;
        $productStock = $variationType == 0 ? $_POST['productStock'] : 0;

        //Category
        $mainCategoryId = $_POST['mainCategoryId'];
        $subCategoryId = isset($_POST['subCategoryId']) ? $_POST['subCategoryId'] : 0;
        $categoryCombinationId = "";
        
        $productVideo ="";


        $sql = "SELECT combination_id FROM categoryCombination WHERE main_category = '$mainCategoryId' AND sub_category = '$subCategoryId'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {

                $categoryCombinationId = $row['combination_id'];
            }
        }

        if($productType == 0)
        {
            //Shipping
            $productWeight = isset($_POST['productWeight']) ? $_POST['productWeight'] : 0;
            $productLength = isset($_POST['productLength']) ? $_POST['productLength'] : 0;
            $productWidth = isset($_POST['productWidth']) ? $_POST['productWidth'] : 0;
            $productHeight = isset($_POST['productHeight']) ? $_POST['productHeight'] : 0;
            $productSelfCollect = isset($_POST['chkSelfCollection']) ? 1 : 0;
            $productStandardDelivery = isset($_POST['chkStandardDelivery']) ? 1 : 0;
        }
        else
        {
            $productWeight = 0;
            $productLength = 0;
            $productWidth = 0;
            $productHeight = 0;
            $productSelfCollect = 0;
            $productStandardDelivery = 0;
        }
        
        
        //Product Status in DB - Active, Inactive, Banned, Suspended, Deleted

        $sql_insert  = "INSERT INTO product (";
        $sql_insert .= "product_id, product_sku, product_name, product_description, product_brand, ";
        $sql_insert .= "product_cover_video, product_cover_picture, product_pic_1, product_pic_2, product_pic_3, ";
        $sql_insert .= "product_pic_4, product_pic_5, product_pic_6, product_pic_7, product_pic_8, ";
        $sql_insert .= "product_weight, product_length, product_width, product_height, ";
        $sql_insert .= "product_virtual, product_self_collect, product_standard_delivery, ";
        $sql_insert .= "product_variation, product_price, product_stock, product_sold, product_status, ";
        $sql_insert .= "category_id, shop_id";
        $sql_insert .= ") ";
        $sql_insert .= "VALUES ((SELECT CONCAT('P',(SELECT LPAD((SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'sgcprot1_SGC_ESHOP' AND TABLE_NAME = 'product'), 6, 0))) AS newCombinationId),'$productSKU','$productName','$productDescription','$productBrand', ";
        $sql_insert .= "'$productVideo', ";

        $fileNames = array_filter($_FILES['img']['name']); 
        $imgInpCounter = 0;
        // File upload configuration 
        $targetDir = dirname(__DIR__, 1)."/img/product/"; 
        $allowTypes = array('jpg','png','jpeg'); 

        if(!empty($fileNames)){ 
            foreach($_FILES['img']['name'] as $key=>$val){ 
                // File upload path 
                
                $fileName = basename($_FILES['img']['name'][$key]); 
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $fileName = round(microtime(true) * 1000).".".$ext;
                $targetFilePath = $targetDir.$fileName; 
                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                if(in_array($fileType, $allowTypes)){ 
                    if(move_uploaded_file($_FILES["img"]["tmp_name"][$key], $targetFilePath)){ 
                        $sql_insert .= "'$fileName', ";
                        $imgInpCounter++;
                    }
                }
            } 
        }

        //Enter empty for picture col that did not use
        while($imgInpCounter < 9)
        {
            $sql_insert .= "'', ";
            $imgInpCounter++;
        }

        $sql_insert .= "'$productWeight','$productLength','$productWidth','$productHeight', ";
        $sql_insert .= "'$productType','$productSelfCollect','$productStandardDelivery', ";
        $sql_insert .= "'$variationType', '$productPrice', '$productStock', '0', 'I', ";
        $sql_insert .= "'$categoryCombinationId', '$shopId'";
        $sql_insert .= ") ";

        if(mysqli_query($conn, $sql_insert)){
            //Got Variation
            if($variationType == 1)
            {
                
                if(isset($_POST['variation1Name'],$_POST['variation2Name']))
                {
                    $variation1Name = $_POST['variation1Name'];
                    $variation2Name = $_POST['variation2Name'];

                    $variation1NameCol = $_POST['variation1NameCol'];
                    $variation2NameCol = $_POST['variation2NameCol'];
                    $variationPrice = $_POST['variationPrice'];
                    $variationStock = $_POST['variationStock'];
                    $variationSKU = $_POST['variationSKU'];
                }
                else if(isset($_POST['variation1Name']))
                {
                    $variation1Name = $_POST['variation1Name'];

                    $variation1NameCol = $_POST['variation1NameCol'];
                    $variationPrice = $_POST['variationPrice'];
                    $variationStock = $_POST['variationStock'];
                    $variationSKU = $_POST['variationSKU'];
                }

                $sql_getID = "SELECT product_id FROM product ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $sql_getID);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $productId = $row['product_id'];
                    }
                }

                for($i = 0; $i < count($variation1NameCol); $i++)
                {
                    $sql_insertVar  = "INSERT INTO variation (";
                    $sql_insertVar .= "product_id, variation_1_name, variation_1_choice, variation_1_pic, ";
                    $sql_insertVar .= "variation_2_name, variation_2_choice, product_price, product_stock, ";
                    $sql_insertVar .= "product_sold, product_sku";
                    $sql_insertVar .= ") ";
                    $sql_insertVar .= "VALUES ('$productId','".$variation1Name."','".$variation1NameCol[$i]."','', ";
                    $sql_insertVar .= "'".$variation2Name."', '".$variation2NameCol[$i]."', '".$variationPrice[$i]."', '".$variationStock[$i]."', ";
                    $sql_insertVar .= "'0', '".$variationSKU[$i]."')";

                    mysqli_query($conn, $sql_insertVar);
                }
            }
            ?>
                <script type="text/javascript">
                    window.location.href = window.location.origin + "/seller/myProduct.php";
                </script>
            <?php
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Fail to Add Product")';
            echo '</script>';
        }
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
    
    $productId = $_GET['id'];
    $shopId = $_SESSION['user_id'];

    $sql_product = "SELECT * FROM product WHERE product_id = '$productId' AND shop_id = '$shopId'";
    $result_product = mysqli_query($conn, $sql_product);

    if (mysqli_num_rows($result_product) > 0) {
        while($row_product = mysqli_fetch_assoc($result_product)) {
            $i_product_name = $row_product['product_name'];
            $i_product_sku = $row_product['product_sku'];
            $i_product_description = $row_product['product_description'];
            $i_product_brand = $row_product['product_brand'];
            $i_product_cover_video = $row_product['product_cover_video'];
            $i_product_cover_picture = $row_product['product_cover_picture'];
            $i_product_pic_1 = $row_product['product_pic_1'];
            $i_product_pic_2 = $row_product['product_pic_2'];
            $i_product_pic_3 = $row_product['product_pic_3'];
            $i_product_pic_4 = $row_product['product_pic_4'];
            $i_product_pic_5 = $row_product['product_pic_5'];
            $i_product_pic_6 = $row_product['product_pic_6'];
            $i_product_pic_7 = $row_product['product_pic_7'];
            $i_product_pic_8 = $row_product['product_pic_8'];
            $i_product_weight = $row_product['product_weight'];
            $i_product_length = $row_product['product_length'];
            $i_product_width = $row_product['product_width'];
            $i_product_height = $row_product['product_height'];
            $i_product_virtual = $row_product['product_virtual'];
            $i_product_self_collect = $row_product['product_self_collect'];
            $i_product_standard_delivery = $row_product['product_standard_delivery'];
            $i_product_variation = $row_product['product_variation'];
            $i_product_price = $row_product['product_price'];
            $i_product_stock = $row_product['product_stock'];
            $i_product_sold = $row_product['product_sold'];
            $i_product_status = $row_product['product_status'];
            $i_category_id = $row_product['category_id'];

            if($i_product_self_collect == 1 && $i_product_standard_delivery == 1)
            {
                $i_product_type = 1;
            }
            else
            {
                $i_product_type = 0;
            }
        }
    }   
    else{
        ?>
            <script type="text/javascript">
                window.location.href = window.location.origin + "/seller/myProduct.php";
            </script>
        <?php
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%;">

    <form id="productForm" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <!-- Basic Infomation -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Basic Information</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Product Images</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                        <div class="drag-list">
                                            <div class="row" style="margin-right: 0.5rem;margin-left: 0.5rem;">
                                                <div style="padding-bottom: .625rem;display:flex">
                                                    <div class="drag-item" draggable="true">
                                                        <div class="image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                                            <div class="image-layer">
                                                                
                                                            </div>
                                                            <div class="image-tools-delete hide">
                                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="image-tools-add">
                                                                <label class="custom-file-upload">
                                                                    <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                                    <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p>Cover Picture</p>
                                                    </div>
                                                </div>
                                                <div style="padding-bottom: .625rem;display:flex">
                                                    <div class="drag-item" draggable="true">
                                                        <div class="image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                                            <div class="image-layer">
                                                                
                                                            </div>
                                                            <div class="image-tools-delete hide">
                                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="image-tools-add">
                                                                <label class="custom-file-upload">
                                                                    <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                                    <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p>Picture 1</p>
                                                    </div>
                                                    <div class="drag-item" draggable="true">
                                                        <div class="image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                                            <div class="image-layer">
                                                                
                                                            </div>
                                                            <div class="image-tools-delete hide">
                                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="image-tools-add">
                                                                <label class="custom-file-upload">
                                                                    <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                                    <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p>Picture 2</p>
                                                    </div>
                                                    <div class="drag-item" draggable="true">
                                                        <div class="image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                                            <div class="image-layer">
                                                                
                                                            </div>
                                                            <div class="image-tools-delete hide">
                                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="image-tools-add">
                                                                <label class="custom-file-upload">
                                                                    <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                                    <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p>Picture 3</p>
                                                    </div>
                                                    <div class="drag-item" draggable="true">
                                                        <div class="image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                                            <div class="image-layer">
                                                                
                                                            </div>
                                                            <div class="image-tools-delete hide">
                                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="image-tools-add">
                                                                <label class="custom-file-upload">
                                                                    <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                                    <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p>Picture 4</p>
                                                    </div>
                                                </div>
                                                <div style="padding-bottom: .625rem;display:flex">
                                                    <div class="drag-item" draggable="true">
                                                        <div class="image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                                            <div class="image-layer">
                                                                
                                                            </div>
                                                            <div class="image-tools-delete hide">
                                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="image-tools-add">
                                                                <label class="custom-file-upload">
                                                                    <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                                    <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p>Picture 5</p>
                                                    </div>
                                                    <div class="drag-item" draggable="true">
                                                        <div class="image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                                            <div class="image-layer">
                                                                
                                                            </div>
                                                            <div class="image-tools-delete hide">
                                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="image-tools-add">
                                                                <label class="custom-file-upload">
                                                                    <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                                    <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p>Picture 6</p>
                                                    </div>
                                                    <div class="drag-item" draggable="true">
                                                        <div class="image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                                            <div class="image-layer">
                                                                
                                                            </div>
                                                            <div class="image-tools-delete hide">
                                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="image-tools-add">
                                                                <label class="custom-file-upload">
                                                                    <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                                    <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p>Picture 7</p>
                                                    </div>
                                                    <div class="drag-item" draggable="true">
                                                        <div class="image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                                            <div class="image-layer">
                                                                
                                                            </div>
                                                            <div class="image-tools-delete hide">
                                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="image-tools-add">
                                                                <label class="custom-file-upload">
                                                                    <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                                    <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p>Picture 8</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Product Name</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="input-group mb-3">
                                <input type="text" value="<?php echo($i_product_name); ?>" class="form-control" name="productName" placeholder="Enter ..." aria-label="SearchKeyword" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Main Category</p>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-sm-12">
                                <div class="input-group mb-3">
                                    <select class="form-control" id="mainCategory" onchange='makeSubmenu(this.value)' name="mainCategoryId" required>
                                        <option value="">Please Select a Category</option>
                                            <?php

                                            //Main Category
                                            $sql_selectMainId = "SELECT main_category FROM categoryCombination WHERE combination_id = '$i_category_id'";
                                            $result_selectMainId = mysqli_query($conn, $sql_selectMainId);

                                            if (mysqli_num_rows($result_selectMainId) > 0) {
                                                while($row_selectMainId = mysqli_fetch_assoc($result_selectMainId)) {
                                                    $mainCategoryId = $row_selectMainId["main_category"];
                                                }
                                            }

                                            $sql = "SELECT DISTINCT(B.category_id),B.category_name FROM categoryCombination AS A LEFT JOIN  category AS B ON A.main_category = B.category_id";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $categoryId = $row["category_id"];
                                                    $categoryName = $row["category_name"];

                                                    if($mainCategoryId == $categoryId)
                                                    {
                                                        echo("<option selected value=\"$categoryId\">$categoryName</option>");
                                                    }
                                                    else
                                                    {
                                                        echo("<option value=\"$categoryId\">$categoryName</option>");
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Sub Category</p>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-sm-12">
                                <div class="input-group mb-3">
                                    <select class="form-control" id="subCategory" name="subCategoryId">
                                        <?php
                                            //Sub Category
                                            $sql_selectSubId = "SELECT sub_category FROM categoryCombination WHERE combination_id = '$i_category_id'";
                                            $result_selectSubId = mysqli_query($conn, $sql_selectSubId);

                                            if (mysqli_num_rows($result_selectSubId) > 0) {
                                                while($row_selectSubId = mysqli_fetch_assoc($result_selectSubId)) {
                                                    $subCategoryId = $row_selectSubId["sub_category"];
                                                }
                                            }

                                            $sql_1 = "SELECT B.category_id,B.category_name FROM categoryCombination AS A LEFT JOIN  category AS B ON A.sub_category = B.category_id WHERE main_category = '$maincategoryid' AND sub_Yes = '1'";
                                            $result_1 = mysqli_query($conn, $sql_1);
                                
                                            if (mysqli_num_rows($result_1) > 0) {
                                                $tempArray = array();
                                
                                                while($row_1 = mysqli_fetch_assoc($result_1)) {
                                                    $categoryId = $row_1["category_id"];
                                                    $categoryName = $row_1["category_name"];
                                
                                                    if($subCategoryId == $categoryId)
                                                    {
                                                        echo("<option selected value=\"$categoryId\">$categoryName</option>");
                                                    }
                                                    else
                                                    {
                                                        echo("<option value=\"$categoryId\">$categoryName</option>");
                                                    }
                                                    
                                                }   
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Product Description</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="input-group mb-3">
                                    <textarea class="form-control" value="<?php echo($i_product_description); ?>" name="productDescription" maxlength="3000" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Product Brand</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="<?php echo($i_product_brand); ?>" name="productBrand" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Product Type</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="input-group mb-3">
                                    <select class="form-control" onchange='ToggleShippingDiv(this.value)' name="productType" required>
                                        <option <?php echo($i_product_type == 0 ? "selected" : ""); ?> value="0">Normal Product with Shipment</option>
                                        <option <?php echo($i_product_type == 1 ? "selected" : ""); ?> value="1">Virtual Product without Shipment</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Main SKU</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"value="<?php echo($i_product_sku); ?>" name="productSKU">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Sales Information -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Sales Information</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <input type="text" value="<?php print (isset($_POST['variationType'])) ? $_POST['variationType'] : "0"; ?>" name="variationType" id="txtVariationType" class="form-control" hidden> 

                        <div id="mainPricing" class="<?php print ($_POST['variationType'] == "1") ? "hide" : ""; ?>">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-outline-primary btnAddVariation" style="width:100%">Enable Variation</button>
                            </div>

                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                    <p class="p-title">Price</p>
                                </div>
                                <div class="col-xl-10 col-lg-10 col-sm-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">RM</span>
                                        </div>
                                        <input type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control" name="productPrice" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                    <p class="p-title">Stock</p>
                                </div>
                                <div class="col-xl-10 col-lg-10 col-sm-12">
                                    <div class="input-group mb-3">
                                        <input type="number"min="0" value="0" class="form-control" name="productStock" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="subPricing" class="mb-3 <?php print ($_POST['variationType'] == "1") ? "" : "hide"; ?>">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-outline-primary btnAddVariation" style="width:100%">Enable Variation 2</button>
                            </div>
                        </div>

                        <div id="priceToAll" class="mb-3 <?php print ($_POST['variationType'] == "1") ? "" : "hide"; ?>">
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                    <p class="p-title">Variation Info</p>
                                </div>
                                <div class="col-xl-10 col-lg-10 col-sm-12">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3">
                                            <div class="input-group mb-3">
                                                <input type="number" id="AttrPrice" oninput="this.value = onlyNumberAllow(this.value)" class="form-control" placeholder="Price">
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3">
                                            <div class="input-group mb-3">
                                                <input type="number" id="AttrStock" oninput="this.value = onlyNumberAllow(this.value)" class="form-control" placeholder="Stock">
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3">
                                            <div class="input-group mb-3">
                                                <input type="text" id="AttrSKU" class="form-control" placeholder="SKU">
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3">
                                            <div class="input-group mb-3">
                                                <button type="button" onclick="UpdatePriceTableAttribute()" class="btn btn-outline-primary" style="width:100%">Apply to All</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="priceList">
 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Shipping -->
        <div class="row" id="ShippingDiv">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Shipping</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Weight</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="input-group mb-3">
                                    <input type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control" name="productWeight" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Package Size</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="input-group mb-3">
                                            <input type="number" oninput="this.value = onlyNumberAllow(this.value)" class="form-control" name="productLength"  placeholder="Length" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="input-group mb-3">
                                            <input type="number" oninput="this.value = onlyNumberAllow(this.value)" class="form-control" name="productWidth"  placeholder="Width" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="input-group mb-3">
                                            <input type="number" oninput="this.value = onlyNumberAllow(this.value)" class="form-control" name="productHeight"  placeholder="Height" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Delivery Option</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="SelfCollection" name="chkSelfCollection"  id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Self Collection
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="StandardDelivery" name="chkStandardDelivery" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Standard Delivery
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Ending -->
        <div class="d-sm-flex align-items-center mb-4" style="justify-content: end;">
            <button type="button"  onclick="submitForm()" class="btn btn-outline-primary"></i>Add New Product</button>
            <button type="submit" id="AddProduct" name="add" class="btn btn-outline-primary" hidden></i>Add New Product</button>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

<style>

    @import "nib";

    [draggable] {
    user-select: none;
    }
    .drag-list {
        margin: 10px auto;
        flex-basis: 770px;
        display:flex;
    }
    .drag-item {
    transition: 0.25s;
    -webkit-box-flex: 0;
    -ms-flex: 0 0 80px;
    flex: 0 0 80px;
    width: 80px;
    max-width: 80px;
    min-height: 80px;
    max-height: 80px;
    margin: 0 16px 40px 0;
    }
    .drag-start {
    opacity: 0.8;
    }
    .drag-enter {
    opacity: 0.5;
    transform: scale(0.9);
    }

    .image-container{
        width: 80px;
        height: 80px;
        background-color: white;
    }

    .image-layer:hover ~ .image-tools-delete{
        display:block;
    }

    .image-layer{
        width: 80px;
        height: 80px;
        opacity:0.5;
        position:absolute;
        margin-top: -80px;
    }

    .image-tools-delete:hover{
        display:block;
    }

    .image-tools-delete{
        width: 80px;
        height: 30px;
        background:grey;
        position:absolute;
        margin-top: -30px;
    }

    .image-tools-delete-icon{
        color: white;
        justify-content: center;
        display: grid;
        margin-top: 5px;
        font-size: 20px;
    }


    .image-tools-add{
        width: 80px;
        height: 80px;
        background:white;
        opacity:0.5;
        position:absolute;
        margin-top: -80px;
        z-index:100;
    }

    .image-tools-add-icon{
        color: black;
        justify-content: center;
        display: grid;
        margin-top: 30px;
        font-size: 20px;
    }

    .custom-file-upload{
        width:100%;
        height:100%;
    }

    .imgInp{
        display:none;
    }

    .hide{
        display:none;
    }

    .td-var1{
        border: none;
        padding: 0;
        margin: 0;
        font-weight: bold;
        color: #858796;
    }

    .td-var2{
        border: none;
        padding: 0;
        margin: 0;
        font-weight: bold;
        color: #858796;
    }

    .thInp{
        border: none;
        padding: 0;
        margin: 0;
        font-weight: bold;
        color: #858796;
    }

    .td-var1:focus,.td-var2:focus,.thInp:focus,.thInp:focus-visible
    {
        border: none;
        padding: 0;
        margin: 0;
        font-weight: bold;
        color: #858796;
        box-shadow: none;
    }

    .warning, .warning:focus{
        border:1px red solid;
    }

    .warning-message{
        color:red;
        font-weight:bold;
    }

</style>

<script>

    var priceTableArray = [];

    function submitForm(){
        if(document.querySelectorAll('.warning').length == 0)
        {
            document.getElementById("AddProduct").click();
        }
        else
        {
            alert("Please Enter Distinct Product Variation and Choices");
        }
    }

    function hasDuplicates(array) {
        var valuesSoFar = Object.create(null);
        for (var i = 0; i < array.length; ++i) {
            var value = array[i];
            if (value in valuesSoFar) {
                return true;
            }
            valuesSoFar[value] = true;
        }
        return false;
    }

    function UpdatePriceTableAttribute()
    {
        var AttrPrice = document.getElementById("AttrPrice");
        var AttrStock = document.getElementById("AttrStock");
        var AttrSKU = document.getElementById("AttrSKU");

        refreshPriceTableWithParameter(AttrPrice.value,AttrStock.value,AttrSKU.value);
    }

    function makeSubmenu(value) {
        if (value.length == 0) 
            document.getElementById("subCategory").innerHTML = "<option></option>";
        else {
            var subCategoryHTML = "";
            var subCategory = <?php echo json_encode($subCategoryArray); ?>;

            for (counter in subCategory[value]) {
                subCategoryHTML += "<option value=\""+ subCategory[value][counter][0] +"\" >" + subCategory[value][counter][1] + "</option>";
            }
            document.getElementById("subCategory").innerHTML = subCategoryHTML;
        }
    }

    function ToggleShippingDiv(value){
        var ShippingDiv = document.getElementById('ShippingDiv');
        var ShippingDivInp = ShippingDiv.getElementsByTagName('input');
        if(value == 0)
        {
            if(ShippingDiv.classList.contains("hide"))
            {
                for(var i = 0; i < ShippingDivInp.length; i++)
                {
                    ShippingDivInp[i].required = true;
                }
                ShippingDiv.classList.remove("hide");
            }
        }
        else if(value == 1)
        {
            if(!ShippingDiv.classList.contains("hide"))
            {
                for(var i = 0; i < ShippingDivInp.length; i++)
                {
                    ShippingDivInp[i].required = false;
                }
                ShippingDiv.classList.add("hide");
            }
        }
    }

    function DragNSort (config) {
        this.$activeItem = null;
        this.$container = config.container;
        this.$items = this.$container.querySelectorAll('.' + config.itemClass);
        this.dragStartClass = config.dragStartClass;
        this.dragEnterClass = config.dragEnterClass;
    }

    //#region Drag and Drop Classess
        DragNSort.prototype.removeClasses = function () {
            [].forEach.call(this.$items, function ($item) {
                $item.classList.remove(this.dragStartClass, this.dragEnterClass);
        }.bind(this));
        };

        DragNSort.prototype.on = function (elements, eventType, handler) {
            [].forEach.call(elements, function (element) {
            element.addEventListener(eventType, handler.bind(element, this), false);
        }.bind(this));
        };

        DragNSort.prototype.onDragStart = function (_this, event) {
            _this.$activeItem = this;

            this.classList.add(_this.dragStartClass);
            event.dataTransfer.effectAllowed = 'move';
            event.dataTransfer.setData('text/html', this.innerHTML);
        };

        DragNSort.prototype.onDragEnd = function (_this) {
            this.classList.remove(_this.dragStartClass);
        };

        DragNSort.prototype.onDragEnter = function (_this) {
            this.classList.add(_this.dragEnterClass);
        };

        DragNSort.prototype.onDragLeave = function (_this) {
            this.classList.remove(_this.dragEnterClass);
        };

        DragNSort.prototype.onDragOver = function (_this, event) {
            if (event.preventDefault) {
                event.preventDefault();
            }

            event.dataTransfer.dropEffect = 'move';
            return false;
        };

        DragNSort.prototype.onDrop = function (_this, event) {
            if (event.stopPropagation) {
                event.stopPropagation();
            }

            if (_this.$activeItem !== this) {
                _this.$activeItem.innerHTML = this.innerHTML;
                this.innerHTML = event.dataTransfer.getData('text/html');
            }

            _this.removeClasses();
            rearrangeLabel();

            return false;
        };

        DragNSort.prototype.bind = function () {
            this.on(this.$items, 'dragstart', this.onDragStart);
            this.on(this.$items, 'dragend', this.onDragEnd);
            this.on(this.$items, 'dragover', this.onDragOver);
            this.on(this.$items, 'dragenter', this.onDragEnter);
            this.on(this.$items, 'dragleave', this.onDragLeave);
            this.on(this.$items, 'drop', this.onDrop);
        };

        DragNSort.prototype.init = function () {
            this.bind();
        };
    //#endregion

    // Instantiate Picture Drag
    var draggable = new DragNSort({
        container: document.querySelector('.drag-list'),
        itemClass: 'drag-item',
        dragStartClass: 'drag-start',
        dragEnterClass: 'drag-enter'
    });
    draggable.init();

    initImages();
    initVariation();


    function rearrangeLabel(){
        var draggableItem = document.querySelectorAll('.drag-item');
        var counter=1;
        var text = "";
        draggableItem.forEach(item => {

            switch(counter)
            {
                case 1:
                    text = "Cover Picture"
                    break;
                case 2:
                    text = "Picture 1"
                    break;
                case 3:
                    text = "Picture 2"
                    break;
                case 4:
                    text = "Picture 3"
                    break;
                case 5:
                    text = "Picture 4"
                    break;
                case 6:
                    text = "Picture 5"
                    break;
                case 7:
                    text = "Picture 6"
                    break;
                case 8:
                    text = "Picture 7"
                    break;
                case 9:
                    text = "Picture 8"
                    break;
            }

            item.getElementsByTagName('p')[0].innerHTML = text;
            counter++;
        });

        const deleteImg = document.querySelectorAll('.image-tools-delete-icon');

        deleteImg.forEach(img => {
            img.addEventListener('click', function handleClick(event) {
                img.parentElement.previousElementSibling.previousElementSibling.src="";
                img.parentElement.nextElementSibling.classList.remove("hide");
                img.parentElement.classList.add("hide");
            });
        });

        const imgInp = document.querySelectorAll('.imgInp');
        imgInp.forEach(img => {
            img.addEventListener('change', function handleChange(event) {
                const [file] = img.files
                if (file) {
                    img.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(file)
                    img.parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                    img.parentElement.parentElement.classList.add("hide");
                }
            });
        });
    }

    function initImages()
    {
        const deleteImg = document.querySelectorAll('.image-tools-delete-icon');

        deleteImg.forEach(img => {
            img.addEventListener('click', function handleClick(event) {
                img.parentElement.previousElementSibling.previousElementSibling.src="";
                img.parentElement.nextElementSibling.classList.remove("hide");
                img.parentElement.classList.add("hide");
            });
        });

        const imgInp = document.querySelectorAll('.imgInp');
        imgInp.forEach(img => {
            img.addEventListener('change', function handleChange(event) {
                const [file] = img.files;

                var extArr = ["jpg", "jpeg", "png"];

                if (img.files && img.files[0] && img.files.length > 1) {
                    for (var j = 0,i = 0; i < this.files.length; i++) {
                        while(imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.getAttribute('src') != "" && j < 9)
                        {
                            j++;
                        }

                        var ext = img.files[i].name.split('.').pop();
                        if(j < 9 && extArr.includes(ext))
                        {
                            imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(img.files[i])
                            imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                            imgInp[j].parentElement.parentElement.classList.add("hide");
                        }
                        else
                        {
                            alert("This Image is not a valid format");
                            img.value = "";
                            break;
                        }
                    }
                }
                else if(img.files && img.files[0])
                {
                    var ext = img.files[0].name.split('.').pop();
                    if(extArr.includes(ext))
                    {
                        img.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(file)
                        img.parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                        img.parentElement.parentElement.classList.add("hide");
                    }
                    else{
                        alert("This Image is not a valid format");
                        img.value = "";
                    }
                }
            });
        });
    }

    var VariationHTML = `
        <div class="variation">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Variation</h5><i style="float:right; margin-top:-20px" class="fa fa-times btnDeleteVariation" aria-hidden="true"></i>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-sm-12">
                            <p class="p-title">Variation Name</p>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-sm-12">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control variationName ">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-sm-12">
                            <p class="p-title">Choices</p>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-sm-12">
                            <div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control variationChoice" required>
                                    <div class="input-group-append btnDeleteChoices">
                                        <span class="input-group-text"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-outline-primary btnAddChoice" style="width:100%">Add Choices</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    function arrayRemoveVariation1(arr, variation1) { 
        return arr.filter(function(ele){ 
            return ele.variation1 != variation1;
        });
    }

    function arrayRemoveVariation2(arr, variation1, variation2) { 
        return arr.filter(function(ele){ 
            return ele.variation1 != variation1 && ele.variation2 != variation2; 
        });
    }

    function updatePriceListArray()
    {
        var td_col_variation1 = document.querySelectorAll('.td-var1');
        var td_col_variation2 = document.querySelectorAll('.td-var2');
        var td_col_price = document.querySelectorAll('.td-price');
        var td_col_stock = document.querySelectorAll('.td-stock');
        var td_col_sku = document.querySelectorAll('.td-sku');

        priceTableArray = [];
        var td = "";
        
        for(var i = 0; i < td_col_variation1.length; i++)
        {
            if(td_col_variation2.length != 0)
            {
                td = {variation1:td_col_variation1[i].value, variation2:td_col_variation2[i].value, price:td_col_price[i].value, stock:td_col_stock[i].value, sku:td_col_sku[i].value};
            }
            else if(td_col_price.length != 0){
                td = {variation1:td_col_variation1[i].value, variation2:"", price:td_col_price[i].value, stock:td_col_stock[i].value, sku:td_col_sku[i].value};
            }
            priceTableArray.push(td);
        }
    }

    function refreshPriceTable()
    {
        updatePriceListArray();

        var PriceTableHTML = `<table class="table table-hover">`;
        //Header Row
        PriceTableHTML += `<thead>`;
        PriceTableHTML += `<tr>`;

        var variationList = document.querySelectorAll('.variation');
        var variationNameList = document.querySelectorAll('.variationName');

        if(variationList.length == 2)
        {
            variationInpList1 = variationList[0].querySelectorAll('.variationChoice');
            variationInpList2 = variationList[1].querySelectorAll('.variationChoice');

            PriceTableHTML += `<th scope="col" style="min-width: 50px;max-width: 100px;"><input style="background: transparent;" value="` + variationNameList[0].value + `" class="thInp" name="variation1Name" readonly ></th>`;
            PriceTableHTML += `<th scope="col" style="min-width: 50px;max-width: 100px;"><input style="background: transparent;" value="` + variationNameList[1].value + `" class="thInp" name="variation2Name" readonly ></th>`;
            PriceTableHTML += `<th scope="col">Price</th>`;
            PriceTableHTML += `<th scope="col">Stock</th>`;
            PriceTableHTML += `<th scope="col">SKU</th>`;

            PriceTableHTML += `</tr>`;
            PriceTableHTML += `</thead>`;

            PriceTableHTML += `<tbody>`;

            for(var i = 0; i < variationInpList1.length; i++)
            {
                for(var j = 0; j < variationInpList2.length; j++)
                {
                    PriceTableHTML += `<tr>`;
                    PriceTableHTML += `<td scope="row"><input style="background: transparent;" value="` + variationInpList1[i].value + `" class="form-control td-var1" name="variation1NameCol[]" readonly ></td>`;
                    PriceTableHTML += `<td scope="row"><input style="background: transparent;" value="` + variationInpList2[j].value + `" class="form-control td-var2" name="variation2NameCol[]" readonly ></td>`;
                   
                    var defaultHTML = true;

                    for(var k = 0; k < priceTableArray.length; k++)
                    {
                        if((priceTableArray[k].variation1 == variationInpList1[i].value && priceTableArray[k].variation2 == variationInpList2[j].value) || (k==i && priceTableArray.length == variationInpList1.length))
                        {
                            PriceTableHTML += `<td scope="row"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">RM</span></div><input value="` + priceTableArray[k].price + `" type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-price" name="variationPrice[]" required></div></td>`;
                            PriceTableHTML += `<td scope="row"><input value="` + priceTableArray[k].stock + `" type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-stock" name="variationStock[]" required></td>`;
                            PriceTableHTML += `<td scope="row"><input value="` + priceTableArray[k].sku + `" type="text" class="form-control td-sku" name="variationSKU[]" required></td>`;
                            PriceTableHTML += `</tr>`;

                            //priceTableArray = arrayRemoveVariation2(priceTableArray, priceTableArray[k].variation1, priceTableArray[k].variation2);
                            defaultHTML = false;
                            break;
                        }
                    }
                    
                    if(defaultHTML)
                    {
                        PriceTableHTML += `<td scope="row"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">RM</span></div><input type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-price" name="variationPrice[]" required></div></td>`;
                        PriceTableHTML += `<td scope="row"><input  type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-stock" name="variationStock[]" required></td>`;
                        PriceTableHTML += `<td scope="row"><input  type="text" class="form-control td-sku" name="variationSKU[]" required></td>`;
                        PriceTableHTML += `</tr>`;
                    }
                }
            }
            PriceTableHTML += `</tbody>`;
            PriceTableHTML += `</table>`;
        }
        else if(variationList.length == 1)
        {
            variationInpList1 = variationList[0].querySelectorAll('.variationChoice');

            PriceTableHTML += `<th scope="col" style="min-width: 50px;max-width: 100px;"><input style="background: transparent;" value="` + variationNameList[0].value + `" class="thInp" name="variation1Name" readonly ></th>`;
            PriceTableHTML += `<th scope="col">Price</th>`;
            PriceTableHTML += `<th scope="col">Stock</th>`;
            PriceTableHTML += `<th scope="col">SKU</th>`;

            PriceTableHTML += `</tr>`;
            PriceTableHTML += `</thead>`;

            PriceTableHTML += `<tbody>`;
            console.log(variationInpList1.length);
            for(var i = 0; i < variationInpList1.length; i++)
            {
                PriceTableHTML += `<tr>`;
                PriceTableHTML += `<td scope="row"><input style="background: transparent;" value="` + variationInpList1[i].value + `" class="form-control td-var1" name="variation1NameCol[]" readonly ></td>`;

                var defaultHTML = true;

                for(var k = 0; k < priceTableArray.length; k++)
                {
                    if(priceTableArray[k].variation1 == variationInpList1[i].value || (k==i && priceTableArray.length == variationInpList1.length))
                    {
                        PriceTableHTML += `<td scope="row"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">RM</span></div><input value="` + priceTableArray[k].price + `" type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-price" name="variationPrice[]" required></div></td>`;
                        PriceTableHTML += `<td scope="row"><input value="` + priceTableArray[k].stock + `" type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-stock" name="variationStock[]" required></td>`;
                        PriceTableHTML += `<td scope="row"><input value="` + priceTableArray[k].sku + `" type="text" class="form-control td-sku" name="variationSKU[]" required></td>`;
                        PriceTableHTML += `</tr>`;

                        //priceTableArray = arrayRemoveVariation1(priceTableArray, priceTableArray[k].variation1);
                        defaultHTML = false;
                        break;
                    }
                }

                if(defaultHTML)
                {
                    PriceTableHTML += `<td scope="row"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">RM</span></div><input type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-price" name="variationPrice[]" required></div></td>`;
                    PriceTableHTML += `<td scope="row"><input  type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-stock" name="variationStock[]" required></td>`;
                    PriceTableHTML += `<td scope="row"><input  type="text" class="form-control td-sku" name="variationSKU[]" required></td>`;
                    PriceTableHTML += `</tr>`;
                }
            }
            PriceTableHTML += `</tbody>`;
            PriceTableHTML += `</table>`;
        }

        var priceListTable = document.getElementById("priceList");
        priceListTable.innerHTML = "";
        priceListTable.insertAdjacentHTML( 'beforeend', PriceTableHTML );
    }

    function refreshPriceTableWithParameter(price,stock,sku)
    {
        var PriceTableHTML = `<table class="table table-hover">`;
        //Header Row
        PriceTableHTML += `<thead>`;
        PriceTableHTML += `<tr>`;

        var variationList = document.querySelectorAll('.variation');
        var variationNameList = document.querySelectorAll('.variationName');

        if(variationList.length == 2)
        {
            variationInpList1 = variationList[0].querySelectorAll('.variationChoice');
            variationInpList2 = variationList[1].querySelectorAll('.variationChoice');

            PriceTableHTML += `<th scope="col" style="min-width: 50px;max-width: 100px;"><input style="background: transparent;" value="` + variationNameList[0].value + `" class="thInp" name="variation1Name" readonly ></th>`;
            PriceTableHTML += `<th scope="col" style="min-width: 50px;max-width: 100px;"><input style="background: transparent;" value="` + variationNameList[1].value + `" class="thInp" name="variation2Name" readonly ></th>`;
            PriceTableHTML += `<th scope="col">Price</th>`;
            PriceTableHTML += `<th scope="col">Stock</th>`;
            PriceTableHTML += `<th scope="col">SKU</th>`;

            PriceTableHTML += `</tr>`;
            PriceTableHTML += `</thead>`;

            PriceTableHTML += `<tbody>`;

            for(var i = 0; i < variationInpList1.length; i++)
            {
                for(var j = 0; j < variationInpList2.length; j++)
                {
                    PriceTableHTML += `<tr>`;
                    PriceTableHTML += `<td scope="row"><input style="background: transparent;" value="` + variationInpList1[i].value + `" class="form-control td-var1" name="variation1NameCol[]" readonly ></td>`;
                    PriceTableHTML += `<td scope="row"><input style="background: transparent;" value="` + variationInpList2[j].value + `" class="form-control td-var2" name="variation2NameCol[]" readonly ></td>`;
                    PriceTableHTML += `<td scope="row"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">RM</span></div><input value="`+price+`" type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-price" name="variationPrice[]" required></div></td>`;
                    PriceTableHTML += `<td scope="row"><input value="`+stock+`" type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-stock" name="variationStock[]" required></td>`;
                    PriceTableHTML += `<td scope="row"><input value="`+sku+`"   type="text" class="form-control td-sku" name="variationSKU[]" required></td>`;
                    PriceTableHTML += `</tr>`;
                }
            }
            PriceTableHTML += `</tbody>`;
            PriceTableHTML += `</table>`;
        }
        else if(variationList.length == 1)
        {
            variationInpList1 = variationList[0].querySelectorAll('.variationChoice');

            PriceTableHTML += `<th scope="col" style="min-width: 50px;max-width: 100px;"><input style="background: transparent;" value="` + variationNameList[0].value + `" class="form-control td-var1" name="variation1Name" readonly ></th>`;
            PriceTableHTML += `<th scope="col">Price</th>`;
            PriceTableHTML += `<th scope="col">Stock</th>`;
            PriceTableHTML += `<th scope="col">SKU</th>`;

            PriceTableHTML += `</tr>`;
            PriceTableHTML += `</thead>`;

            PriceTableHTML += `<tbody>`;

            for(var i = 0; i < variationInpList1.length; i++)
            {
                PriceTableHTML += `<tr>`;
                PriceTableHTML += `<td scope="row"><input style="background: transparent;" value="` + variationInpList1[i].value + `" class="form-control td-var1" name="variation1NameCol[]" readonly ></td>`;
                PriceTableHTML += `<td scope="row"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">RM</span></div><input value="`+price+`" type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-price" name="variationPrice[]" required></div></td>`;
                PriceTableHTML += `<td scope="row"><input value="`+stock+`" type="number" oninput="this.value = onlyNumberAllow(this.value)" min="0" value="0" class="form-control td-stock" name="variationStock[]" required></td>`;
                PriceTableHTML += `<td scope="row"><input value="`+sku+`"   type="text" class="form-control td-sku" name="variationSKU[]" required></td>`;
                PriceTableHTML += `</tr>`;
            }
            PriceTableHTML += `</tbody>`;
            PriceTableHTML += `</table>`;
        }

        var priceListTable = document.getElementById("priceList");
        priceListTable.innerHTML = "";
        priceListTable.insertAdjacentHTML( 'beforeend', PriceTableHTML );
    }

    function initVariation()
    {
        const btnAddVariations = document.querySelectorAll('.btnAddVariation');
        const divVariations = document.querySelectorAll('.variation');

        var variationName = document.querySelectorAll('.variationName');
        for(var i = 0; i < variationName.length; i++)
        {
            variationName[i].removeEventListener('change',addVariationHandleChange);
            variationName[i].addEventListener('change',addVariationHandleChange);
        }

        btnAddVariations.forEach(item => {
            item.removeEventListener('click', addVariationHandleClick);
            item.addEventListener('click', addVariationHandleClick);
        });
    }

    function addVariationHandleChange(event) 
    {
        const valueList = [];
        const errorMessage = `<p class="warning-message">Variation Name is Redundant</p>`;

        var variationName = document.querySelectorAll('.variationName');
        for(var i = 0; i < variationName.length; i++)
        {
            if(variationName[i].classList.contains('warning'))
            {
                variationName[i].classList.remove('warning');
                
                if(variationName[i].parentElement.parentElement.querySelectorAll('.warning-message'))
                {
                    var errorMessageList = variationName[i].parentElement.parentElement.querySelectorAll('.warning-message');
                    for(var j = 0; j < errorMessageList.length; j++)
                    {
                        errorMessageList[j].remove();
                    }
                }
                
                /*
                event.target.removeAttribute("data-toggle");
                event.target.removeAttribute("data-placement");
                event.target.removeAttribute("title");
                */
            }
            valueList.push(variationName[i].value);
        }
        if(hasDuplicates(valueList))
        {
            event.target.classList.add('warning');
            event.target.parentElement.parentElement.insertAdjacentHTML( 'beforeend', errorMessage );
            /*
            event.target.setAttribute("data-toggle", "tooltip");
            event.target.setAttribute("data-placement", "bottom");
            event.target.setAttribute("title", "Variation Name is redundant");
            */
        }
        refreshPriceTable();
    }

    function addVariationHandleClick(event) 
    {
        var divVariations = document.querySelectorAll('.variation');

        var main = document.getElementById('mainPricing');
        var sub = document.getElementById('subPricing');
        var priceTable = document.getElementById('priceToAll');

        if(sub.classList.contains("hide"))
        {
            sub.classList.remove("hide");
            priceTable.classList.remove("hide");
            main.classList.add("hide");
            document.getElementById('txtVariationType').value = "1";
            sub.insertAdjacentHTML( 'beforeend', VariationHTML );

            mainPricingInput = main.getElementsByTagName('input');
            for(var i = 0; i < mainPricingInput.length; i++)
            {
                mainPricingInput[i].required = false;
            }

            subPricingInput = sub.getElementsByTagName('input');
            for(var i = 0; i < subPricingInput.length; i++)
            {
                subPricingInput[i].required = true;
            }

            initVariation();
            initChoice();
        }
        else if(divVariations.length < 2)
        {
            sub.insertAdjacentHTML( 'beforeend', VariationHTML );

            subPricingInput = sub.getElementsByTagName('input');
            for(var i = 0; i < subPricingInput.length; i++)
            {
                subPricingInput[i].required = true;
            }

            initVariation();
            initChoice();
        }

        refreshPriceTable();

        var variationName = document.querySelectorAll('.variationName');
        for(var i = 0; i < variationName.length; i++)
        {
            variationName[i].removeEventListener('change',addVariationHandleChange);
            variationName[i].addEventListener('change',addVariationHandleChange);
        }

        divVariations = document.querySelectorAll('.variation');

        const btnAddVariations = document.querySelectorAll('.btnAddVariation');

        btnAddVariations.forEach(item => {
            if(divVariations.length == 2)
            {
                item.parentElement.classList.add("hide");
            }   
            else if(divVariations.length == 1)
            {
                item.parentElement.classList.remove("hide");
            }
        });

        //Delete Variation
        const btnDeleteVariations = document.querySelectorAll('.btnDeleteVariation');
        btnDeleteVariations.forEach(item => {
            item.removeEventListener('click',deleteVariationHandleClick);
            item.addEventListener('click',deleteVariationHandleClick);
        });
    }

    function deleteVariationHandleClick(event) 
    {
        var divVariations = document.querySelectorAll('.variation');
        var main = document.getElementById('mainPricing');
        var sub = document.getElementById('subPricing');
        var priceTable = document.getElementById('priceToAll');

        if(divVariations.length == 2)
        {
            event.target.parentElement.parentElement.parentElement.remove();
        }
        else if(divVariations.length == 1)
        {
            event.target.parentElement.parentElement.parentElement.remove();
            sub.classList.add("hide");
            priceTable.classList.add("hide");
            main.classList.remove("hide");
            document.getElementById('txtVariationType').value = "0";

            mainPricingInput = main.getElementsByTagName('input');
            for(var i = 0; i < mainPricingInput.length; i++)
            {
                mainPricingInput[i].required = true;
            }
        }

        refreshPriceTable();
        divVariations = document.querySelectorAll('.variation');

        const btnAddVariations = document.querySelectorAll('.btnAddVariation');

        btnAddVariations.forEach(item => {
            if(divVariations.length == 2)
            {
                item.parentElement.classList.add("hide");
            }   
            else if(divVariations.length == 1)
            {
                item.parentElement.classList.remove("hide");
            }
            else
            {
                item.parentElement.classList.remove("hide");
            }
        });
    }

    function initChoice()
    {
        const btnAddChoices = document.querySelectorAll('.btnAddChoice');

        var variationChoice = document.querySelectorAll('.variationChoice');
        for(var i = 0; i < variationChoice.length; i++)
        {
            variationChoice[i].removeEventListener('change',addChoiceHandleChange);
            variationChoice[i].addEventListener('change',addChoiceHandleChange);
        }
        
        btnAddChoices.forEach(item => {
            item.removeEventListener('click', addChoiceHandleClick);
            item.addEventListener('click',addChoiceHandleClick);
        });
    }

    function addChoiceHandleChange(event) {

        const valueList = [];
        const errorMessage = `<p class="warning-message">Choice Name is Redundant</p>`;

        var variationChoice = event.target.parentElement.parentElement.querySelectorAll('.variationChoice');
        for(var i = 0; i < variationChoice.length; i++)
        {
            if(variationChoice[i].classList.contains('warning'))
            {
                variationChoice[i].classList.remove('warning');
                
                if(variationChoice[i].parentElement.nextElementSibling.classList.contains('warning-message'))
                {
                    var errorMessageList = variationChoice[i].parentElement.nextElementSibling;
                    errorMessageList.remove();
                }
                
                /*
                event.target.removeAttribute("data-toggle");
                event.target.removeAttribute("data-placement");
                event.target.removeAttribute("title");
                */
            }
            valueList.push(variationChoice[i].value);
        }
        if(hasDuplicates(valueList))
        {
            var doubleCheckValueList = [];
            var variationChoice = event.target.parentElement.parentElement.querySelectorAll('.variationChoice');
            for(var i = 0; i < variationChoice.length; i++)
            {
                doubleCheckValueList.push(variationChoice[i].value);
                if(hasDuplicates(doubleCheckValueList))
                {
                    variationChoice[i].parentElement.insertAdjacentHTML( 'afterend', errorMessage );
                    variationChoice[i].classList.add('warning');
                    break;
                }
            }
            /*
            event.target.setAttribute("data-toggle", "tooltip");
            event.target.setAttribute("data-placement", "bottom");
            event.target.setAttribute("title", "Variation Name is redundant");
            */
        }
        refreshPriceTable();
    }

    function addChoiceHandleClick(event) {
        var str =  `
        <div class="input-group mb-3">
            <input type="text" class="form-control variationChoice" required>
            <div class="input-group-append btnDeleteChoices">
                <span class="input-group-text"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
        </div>
        `;
        event.target.parentElement.previousElementSibling.insertAdjacentHTML( 'beforeend', str );

        refreshPriceTable();

        var variationChoice = document.querySelectorAll('.variationChoice');
        for(var i = 0; i < variationChoice.length; i++)
        {
            variationChoice[i].removeEventListener('change',addChoiceHandleChange);
            variationChoice[i].addEventListener('change',addChoiceHandleChange);
        }

        const btnDeleteChoices = document.querySelectorAll('.btnDeleteChoices');
        btnDeleteChoices.forEach(item => {
            item.removeEventListener('click', deleteChoiceHandleClick);
            item.addEventListener('click', deleteChoiceHandleClick);
        });
    }

    function deleteChoiceHandleClick(event) {
        
        if(event.target.parentElement.parentElement.classList.contains("btnDeleteChoices"))
        {
            if(event.target.parentElement.parentElement.parentElement.parentElement.children.length > 1)
            {
                if(event.target.parentElement.parentElement.previousElementSibling.classList.contains("warning"))
                {
                    if(event.target.parentElement.parentElement.previousElementSibling.parentElement.nextElementSibling.classList.contains("warning-message"))
                    {
                        event.target.parentElement.parentElement.previousElementSibling.parentElement.nextElementSibling.remove();
                    }
                }
                event.target.parentElement.parentElement.parentElement.remove();
            }
        }
        else if(event.target.parentElement.classList.contains("btnDeleteChoices"))
        {
            if(event.target.parentElement.parentElement.children.length > 1)
            {
                if(event.target.parentElement.previousElementSibling.classList.contains("warning"))
                {
                    if(event.target.parentElement.previousElementSibling.parentElement.nextElementSibling.classList.contains("warning-message"))
                    {
                        event.target.parentElement.previousElementSibling.parentElement.nextElementSibling.remove();
                    }
                }
                event.target.parentElement.parentElement.remove();
            }
        }
        refreshPriceTable();
    }

    function onlyNumberAllow(value)
    {
    	return value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');
    }

    

</script>

<?php
    require __DIR__ . '/footer.php'
?>