<?php
    require dirname(__DIR__, 1) . '/seller/header.php';

    if(isset($_POST['addMain']) || isset($_POST['addSub'])){

        $addSub = isset($_POST['addSub']) ? 1 : 0;

        $mainCategoryId = isset($_POST['addSub']) ? $_POST['addSub'] : $_POST['addMain'];
        $subCategoryId = "";
        $categoryName = $_POST['categoryName'];
        $categoryPic = "";

        $fileNames = array_filter($_FILES['img']['name']); 

        // File upload configuration 
        $targetDir = dirname(__DIR__, 1)."/img/category/"; 
        $allowTypes = array('jpg','png','jpeg'); 

        if(!empty($fileNames)){ 
            foreach($_FILES['img']['name'] as $key=>$val){ 
                // File upload path 
                $fileName = basename($_FILES['img']['name'][$key]); 
                $targetFilePath = $targetDir.$fileName; 
                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                if(in_array($fileType, $allowTypes)){ 
                    if(move_uploaded_file($_FILES["img"]["tmp_name"][$key], $targetFilePath)){ 
                        $categoryPic = "$fileName";
                    }
                }
            } 
        }

        //Get The Combination ID
        $sql_getID = "SELECT AUTO_INCREMENT ";
        $sql_getID .="FROM information_schema.TABLES ";
        $sql_getID .="WHERE TABLE_SCHEMA = 'sgcprot1_SGC_ESHOP' ";
        $sql_getID .="AND TABLE_NAME = 'category' ";
        $result = mysqli_query($conn, $sql_getID);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {

                if($addSub == 1)
                {
                    $subCategoryId = $row['AUTO_INCREMENT'];
                }
                else
                {
                    $mainCategoryId = $row['AUTO_INCREMENT'];
                }
                
                $sql_insert  = "INSERT INTO category (";
                $sql_insert .= "category_name, category_pic, category_status";
                $sql_insert .= ") ";
                $sql_insert .= "VALUES ('$categoryName','$categoryPic','$categoryStatus')";
                if(mysqli_query($conn, $sql_insert))
                {
                    $sql_insert_cc  = "INSERT INTO categoryCombination (";
                    $sql_insert_cc .= "main_category, sub_category, sub_Yes";
                    $sql_insert_cc .= ") ";
                    $sql_insert_cc .= "VALUES ('$mainCategoryId','$subCategoryId','$addSub')";
                    if(mysqli_query($conn, $sql_insert_cc))
                    {
                        //This is for redirect
                        ?>
                            <script type="text/javascript">
                                window.location.href = window.location.origin + "/admin/category.php";
                            </script>
                        <?php
                    }
                }
            }
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Fail to Add Category")';
            echo '</script>';
        }
    } 
    else if(isset($_POST['editCategory']))
    {
        $categoryId = $_POST['editCategory'];
        $categoryName = "";

        $sql_update = "UPDATE category SET ";
        $sql_update .= "category_name = '$categoryName' ";

        $fileNames = array_filter($_FILES['img']['name']); 

        // File upload configuration 
        $targetDir = dirname(__DIR__, 1)."/img/category/"; 
        $allowTypes = array('jpg','png','jpeg'); 

        if(!empty($fileNames)){ 
            foreach($_FILES['img']['name'] as $key=>$val){ 
                // File upload path 
                $fileName = basename($_FILES['img']['name'][$key]); 
                $targetFilePath = $targetDir.$fileName; 
                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                if(in_array($fileType, $allowTypes)){ 
                    if(move_uploaded_file($_FILES["img"]["tmp_name"][$key], $targetFilePath)){ 
                        $sql_update .= ", category_pic = '$fileName' ";
                    }
                }
            } 
        }

        $sql_update .= " WHERE category_id = $categoryId ";

        if(mysqli_query($conn, $sql_update))
        {
            //This is for redirect
            ?>
                <script type="text/javascript">
                    window.location.href = window.location.origin + "/admin/category.php";
                </script>
            <?php
        }
    }
    else if(isset($_POST['deleteMain']) || isset($_POST['deleteSub']))
    {
        $mainCategoryId = "";
        $mainCategoryId = "";
        //If delete Sub
        if(isset($_POST['deleteSub'])) 
        {
            $categoryId = $_POST['deleteSub'];
            $sql = "SELECT product_id FROM product WHERE category_id = '$categoryId'";
        }
        //If delete Main / Only if all the cateogry don have sub or any product can be delete
        else if(isset($_POST['deleteMain']))
        {
            $categoryId = $_POST['deleteMain'];
            $sql = "SELECT product_id FROM product WHERE category_id = '$categoryId'";
        }
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<script language="javascript">';
            echo 'alert("Fail to Delete Category, Because there are product in this category or its sub category")';
            echo '</script>';
        }
        else
        {
            $sql = "SELECT main_category,sub_category FROM categoryCombination WHERE combination_id = '$categoryId' ";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    if(isset($_POST['deleteSub'])) 
                    {
                        $sql_delete = "DELETE FROM category WHERE category_id = '$categoryId'";
                        mysqli_query($conn, $sql_delete);
                    }
                    else if(isset($_POST['deleteMain']))
                    {
                        $sql_delete = "DELETE FROM category WHERE category_id = '$categoryId'";
                        mysqli_query($conn, $sql_delete);
                    }
                }
                $sql_delete = "DELETE FROM categoryCombination WHERE combination_id = '$categoryId'";
                mysqli_query($conn, $sql_delete);
            }
        } 
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%;">

    <form id="categoryForm" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <!-- Basic Infomation -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Category List</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

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
                                <p>Category Picture</p>
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
                        
                    </div>
                </div>
            </div>
        </div>

        <!--Category List -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Category List</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div id="categoryDiv">
                            <div class="row">
                                <div class="col">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Ending -->
        <div class="d-sm-flex align-items-center mb-4" style="justify-content: end;">
            <button type="submit" name="add" class="btn btn-outline-primary"></i>Add New Category</button>
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

    
    document.getElementById('productForm').addEventListener('submit', function(evt){
        evt.preventDefault();
        if(document.querySelectorAll('.warning').length == 0)
        {
            document.getElementById("productForm").submit(); 
        }
        else
        {
            alert("Please Enter Distinct Product Variation and Choices");
        }
    });
    

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
                                <input type="text" class="form-control variationName">
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
                                    <input type="text" class="form-control variationChoice">
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
            <input type="text" onfocusout="saveValue(this)" class="form-control variationChoice">
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
        refreshPriceTable();
    }

    function saveValue(event)
    {
        console.log(event);
    }

    function onlyNumberAllow(value)
    {
    	return value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');
    }

    

</script>

<?php
    require __DIR__ . '/footer.php'
?>