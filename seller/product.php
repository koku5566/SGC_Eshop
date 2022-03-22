<?php
    require __DIR__ . '/header.php';

    if(isset($_POST['add']) || isset($_POST['publish'])){ 

        $publish = 1;
        if(isset($_POST['add']))
        {
            $publish = 0;
        }


        // File upload configuration 
        $targetDir = "img/product/"; 
        $allowTypes = array('jpg','png','jpeg'); 
         
        $statusMsg = $errorMsg = $errorUpload = $errorUploadType = ''; 

        $sql_insert = "INSERT INTO `product`(`product_sku`, `product_name`, `product_description`, 
        `product_brand`, `product_cover_video`, `product_cover_picture`, `product_pic_1`, `product_pic_2`, `product_pic_3`, 
        `product_pic_4`, `product_pic_5`, `product_pic_6`, `product_pic_7`, `product_pic_8`, `product_weight`, 
        `product_length`, `product_width`, `product_height`, `product_danger`, `product_self_collect`, 
        `product_standard_delivery`, `product_preorder`, `product_variation`, `product_price`, `product_stock`, 
        `product_sold`, `product_status`, `product_banned`, `category_id`, `shop_id`) 
        VALUES ('".$_POST['sku']."','".$_POST['productName']."','".$_POST['description']."',
        '".$_POST['brand']."','".$_POST['coverVideo']."',";
        $fileNames = array_filter($_FILES['files']['name']); 

        $imgInpCounter = 0;
        if(!empty($fileNames)){ 
            
            foreach($_FILES['files']['name'] as $key=>$val){ 
                // File upload path 
                $fileName = basename($_FILES['files']['name'][$key]); 
                $targetFilePath = $targetDir . $fileName; 
                 
                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to server 
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                        // Image db insert sql 
                        $sql_insert .= "'".$fileName."',";
                        $imgInpCounter++;
                    }
                }
            } 
        }

        while($imgInpCounter < 9)
        {
            $insertValuesSQL .= "'".$fileName."',";
            $imgInpCounter++;
        }

        $sql_insert .= "'".$_POST['weight']."',
        '".$_POST['length']."','".$_POST['width']."','".$_POST['height']."','".$_POST['danger']."','".$_POST['selfCollect']."',
        '".$_POST['standardDelivery']."','".$_POST['preorder']."','".$_POST['variation']."','".$_POST['mainPrice']."','".$_POST['mainStock']."',
        '".$_POST['mainSold']."','".$publish."','".$_POST['banned']."','".$_POST['categoryId']."','".$_POST['shopId']."')";

        if(mysqli_query($conn, $sql_insert)){
            $sql_UpdateId = "UPDATE product AS A, (SELECT id FROM product ORDER BY id DESC LIMIT 1) AS B SET A.product_id=CONCAT('P',B.id) WHERE A.id = B.id";
            mysqli_query($conn, $sql_UpdateId);
        }
        else
        {
            echo("Error Insert Fail");
        }
    } 

    $subCategoryArray = array();

    //Main Category
    $sql = "SELECT * FROM mainCategory";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $maincategoryid = $row["main_category_id"];
            
            $sql_1 = "SELECT * FROM subCategory WHERE main_category_id = '$maincategoryid'";
            $result_1 = mysqli_query($conn, $sql_1);

            if (mysqli_num_rows($result_1) > 0) {
                $tempArray = array();

                while($row_1 = mysqli_fetch_assoc($result_1)) {
                    $categoryId = $row_1["sub_category_id"];
                    $categoryName = $row_1["sub_category_name"];

                    array_push($tempArray,array($categoryId,$categoryName));
                }
                $tempCategoryArray = array($maincategoryid => $tempArray);
            }
            $subCategoryArray = array_merge($subCategoryArray,$tempCategoryArray);
        }
    }                             
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%;">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i>Update</a>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
                                                                    <input accept="image/*" name="img[]" type="file" class="imgInp" multiple/>
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
                                                                    <input accept="image/*" name="img[]" type="file" class="imgInp" multiple/>
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
                                                                    <input accept="image/*" name="img[]" type="file" class="imgInp" multiple/>
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
                                                                    <input accept="image/*" name="img[]" type="file" class="imgInp" multiple/>
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
                                                                    <input accept="image/*" name="img[]" type="file" class="imgInp" multiple/>
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
                                                                    <input accept="image/*" name="img[]" type="file" class="imgInp" multiple/>
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
                                                                    <input accept="image/*" name="img[]" type="file" class="imgInp" multiple/>
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
                                                                    <input accept="image/*" name="img[]" type="file" class="imgInp" multiple/>
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
                                                                    <input accept="image/*" name="img[]" type="file" class="imgInp" multiple/>
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
                                <input type="text" value="<?php echo(isset($_POST['productName']) ? $_POST['productName'] : "sad");?>" class="form-control" name="productName" placeholder="Enter ..." aria-label="SearchKeyword" required>
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
                                            $sql = "SELECT * FROM mainCategory";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $categoryId = $row["main_category_id"];
                                                    $categoryName = $row["main_category_name"];

                                                    echo("<option value=\"$categoryId\">$categoryName</option>");
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
                                    <textarea class="form-control" name="productDescription" maxlength="3000" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Product Brand</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="productBrand" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-sm-12">
                                <p class="p-title">Main Category</p>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12">
                                <div class="input-group mb-3">
                                    <select class="form-control" onchange='ToggleShippingDiv(this.value)' name="productType" required>
                                        <option value="1">Normal Product with Shipment</option>
                                        <option value="2">Virtual Product without Shipment</option>
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
                                    <input type="text" class="form-control" name="productSKU">
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
                                        <input type="number" min="0" value="0" class="form-control" name="productPrice" required>
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

                        <div id="subPricing" class="<?php print ($_POST['variationType'] == "1") ? "" : "hide"; ?>">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-outline-primary btnAddVariation" style="width:100%">Enable Variation 2</button>
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
                                    <input type="number" min="0" value="0" class="form-control" name="productWeight" required>
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
                                            <input type="number" class="form-control" name="productLength"  placeholder="Length" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="productWidth"  placeholder="Width" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="productHeight"  placeholder="Height" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
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
</style>

<script>

    function makeSubmenu(value) {
        console.log(value)
        if (value.length == 0) 
            document.getElementById("subCategory").innerHTML = "<option></option>";
        else {
            var subCategoryHTML = "";
            var subCategory = <?php echo json_encode($subCategoryArray); ?>;

            console.log(subCategory);

            for (counter in subCategory[value]) {
                subCategoryHTML += "<option value=\""+ subCategory[value][counter][0] +"\" >" + subCategory[value][counter][1] + "</option>";
            }
            document.getElementById("subCategory").innerHTML = subCategoryHTML;
        }
    }

    function ToggleShippingDiv(value){
        var ShippingDiv = document.getElementById('ShippingDiv');
        if(value == 1)
        {
            if(ShippingDiv.classList.contains("hide"))
            {
                ShippingDiv.getElementsByTagName('input').forEach(item => {
                    item.required = true;
                });
                ShippingDiv.classList.remove("hide");
            }
        }
        else if(value == 2)
        {
            if(!ShippingDiv.classList.contains("hide"))
            {
                ShippingDiv.getElementsByTagName('input').forEach(item => {
                    item.required = false;
                });
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

    initImages()
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

                if (img.files && img.files[0] && img.files.length > 1) {
                    for (var j = 0,i = 0; i < this.files.length; i++) {
                        while(imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.getAttribute('src') != "" && j < 9)
                        {
                            j++;
                        }

                        if(j < 9)
                        {
                            imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(img.files[i])
                            imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                            imgInp[j].parentElement.parentElement.classList.add("hide");
                        }
                        else
                        {
                            exit;
                        }
                        
                    }
                }
                else if(img.files && img.files[0])
                {
                    img.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(file)
                    img.parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                    img.parentElement.parentElement.classList.add("hide");
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
                                <input type="text" class="form-control" name="variationName[][name]">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-sm-12">
                            <p class="p-title">Choices</p>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-sm-12">
                            <div class="drag-list-choices">
                                <div class="input-group mb-3 drag-item-choices" draggable="true">
                                    <input type="text" class="form-control" name="variationName[][name][choices][]">
                                    <div class="input-group-append">
                                        <span class="input-group-text "><i class="fa fa-arrows" aria-hidden="true"></i></span>
                                    </div>
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

    function RefreshPriceTable()
    {
        var PriceTableHTML = `<table class="table table-hover">`;
            //Header Row
            PriceTableHTML += `<thead>`;
                PriceTableHTML += `<tr>`;
                PriceTableHTML += `<th scope="col">#</th>`;
                PriceTableHTML += `<th scope="col">Price</th>`;
                PriceTableHTML += `<th scope="col">Stock</th>`;
                PriceTableHTML += `<th scope="col">SKU</th>`;
                PriceTableHTML += `</tr>`;
            PriceTableHTML += `</thead>`;

            //Body Content
            PriceTableHTML += `<tbody>`;
                //Row 2
                PriceTableHTML += `<tr>`;
                PriceTableHTML += `<th scope="row">2</th>`;
                PriceTableHTML += `<td><input type="text" placeholder="2016" required></td>`;
                PriceTableHTML += `<td>123</td>`;
                PriceTableHTML += `<td>123</td>`;
                PriceTableHTML += `</tr>`;

            PriceTableHTML += `</tbody>`;
        PriceTableHTML += `</table>`;

        var priceListTable = document.getElementById("priceList");
        priceListTable.innerHTML = "";
        priceListTable.insertAdjacentHTML( 'beforeend', PriceTableHTML );
    }

    

    function initVariation()
    {
        const btnAddVariations = document.querySelectorAll('.btnAddVariation');
        const divVariations = document.querySelectorAll('.variation');

        btnAddVariations.forEach(item => {
            item.removeEventListener('click', addVariationHandleClick);
            item.addEventListener('click', addVariationHandleClick);
        });
    }

    function addVariationHandleClick(event) 
    {
        var divVariations = document.querySelectorAll('.variation');

        var main = document.getElementById('mainPricing');
        var sub = document.getElementById('subPricing');

        if(sub.classList.contains("hide"))
        {
            mainPricingInput = main.getElementsByTagName('input');
            for(var i = 0; i < mainPricingInput.length; i++)
            {
                item.required = false;
            }

            subPricingInput = sub.getElementsByTagName('input');
            for(var i = 0; i < subPricingInput.length; i++)
            {
                item.required = true;
            }

            sub.classList.remove("hide");
            main.classList.add("hide");
            document.getElementById('txtVariationType').value = "1";
            sub.insertAdjacentHTML( 'beforeend', VariationHTML );
            initVariation();
            initChoice();
        }
        else if(divVariations.length < 2)
        {
            sub.insertAdjacentHTML( 'beforeend', VariationHTML );
            initVariation();
            initChoice();
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

        if(divVariations.length == 2)
        {
            event.target.parentElement.parentElement.parentElement.remove();
        }
        else if(divVariations.length == 1)
        {
            event.target.parentElement.parentElement.parentElement.remove();
            sub.classList.add("hide");
            main.classList.remove("hide");
            document.getElementById('txtVariationType').value = "0";
            main.getElementsByTagName('input').forEach(item => {
                item.required = true;
            });
            sub.getElementsByTagName('input').forEach(item => {
                item.required = false;
            });
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
    }

    function initChoice()
    {
        const btnAddChoices = document.querySelectorAll('.btnAddChoice');

        btnAddChoices.forEach(item => {
            item.removeEventListener('click', addChoiceHandleClick);
            item.addEventListener('click',addChoiceHandleClick);
        });
    }

    function addChoiceHandleClick(event) {
        var str = "<div class=\"input-group mb-3 drag-item-choices\" draggable=\"true\"><input type=\"text\" class=\"form-control\" name=\"choices[]\"><div class=\"input-group-append\"><span class=\"input-group-text\"><i class=\"fa fa-arrows\" aria-hidden=\"true\"></i></span></div><div class=\"input-group-append btnDeleteChoices\"><span class=\"input-group-text\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span></div></div>";
        event.target.parentElement.previousElementSibling.insertAdjacentHTML( 'beforeend', str );
        // Instantiate Choices Drag
        var draggableChoices = new DragNSort({
            container: document.querySelector('.drag-list-choices'),
            itemClass: 'drag-item-choices',
            dragStartClass: 'drag-start',
            dragEnterClass: 'drag-enter'
        });
        draggableChoices.init();

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
                event.target.parentElement.parentElement.parentElement.remove();
            }
        }
        else if(event.target.parentElement.classList.contains("btnDeleteChoices"))
        {
            if(event.target.parentElement.parentElement.parentElement.children.length > 1)
            {
                event.target.parentElement.parentElement.remove();
            }
        }
        
    }

    

</script>

<?php
    require __DIR__ . '/footer.php'
?>