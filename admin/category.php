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
                        <div class="row">
                            <!-- Main Category -->
                            <div class="col-xl-3 col-lg-3 col-sm-6">
                                <p class="p-title">Main Category</p>
                                <?php
                                    //Main Category
                                    $sql = "SELECT DISTINCT(B.category_id),B.category_name, A.combination_id FROM categoryCombination AS A LEFT JOIN  category AS B ON A.main_category = B.category_id WHERE A.sub_Yes = '0'";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $categoryId = $row["combination_id"];
                                            $mainCategoryId = $row["category_id"];
                                            $categoryName = $row["category_name"];

                                            $sql_1 = "SELECT B.category_id FROM categoryCombination AS A LEFT JOIN  category AS B ON A.main_category = B.category_id WHERE A.sub_Yes = '1' AND A.main_category =  '$mainCategoryId' ";
                                            $result_1 = mysqli_query($conn, $sql_1);
        
                                            if (mysqli_num_rows($result_1) > 0) 
                                            {
                                                echo("
                                                    <div>
                                                        <div class=\"input-group\">
                                                            <input type=\"text\" value=\"$categoryName\" style=\"background-color:white;border-radius:0;\" class=\"form-control variationChoice\" disabled>
                                                            <div class=\"input-group-append\">
                                                                <a href=\"?toggle=$categoryId\"><span style=\"height:100%;background-color:white;border-radius:0;\" class=\"input-group-text\"><i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i></span></a>
                                                            </div>
                                                            <div class=\"input-group-append\">
                                                                <a href=\"?edit=$categoryId\"><span style=\"height:100%;background-color:white;border-radius:0;\" class=\"input-group-text\"><i class=\"fa fa-edit\" aria-hidden=\"true\"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ");
                                            }
                                            else
                                            {
                                                echo("
                                                    <div>
                                                        <div class=\"input-group\">
                                                            <input type=\"text\" value=\"$categoryName\" style=\"background-color:white;border-radius:0;\" class=\"form-control variationChoice\" disabled>
                                                            <div class=\"input-group-append\">
                                                                <a href=\"?edit=$categoryId\"><span style=\"height:100%;background-color:white;border-radius:0;\" class=\"input-group-text\"><i class=\"fa fa-edit\" aria-hidden=\"true\"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ");
                                            }
                                            
                                        }
                                    }
                                ?>
                                
                            </div>
                            <!-- Sub Category -->
                            <div class="col-xl-3 col-lg-3 col-sm-6">
                                <p class="p-title">Sub Category</p>
                                <?php
                                    //Sub Category
                                    if(isset($_GET['toggle']))
                                    {
                                        $mainCategoryId = $_GET['toggle'];
                                        $sql = "SELECT B.category_id,B.category_name, A.combination_id FROM categoryCombination AS A LEFT JOIN  category AS B ON A.sub_category = B.category_id WHERE A.sub_Yes = '1' AND main_category = (SELECT main_category FROM categoryCombination WHERE combination_id = '$mainCategoryId') ORDER BY sub_category ASC";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                $categoryId = $row["combination_id"];
                                                $categoryName = $row["category_name"];

                                                echo("
                                                    <div>
                                                        <div class=\"input-group\">
                                                            <input type=\"text\" value=\"$categoryName\" style=\"background-color:white;border-radius:0;\" class=\"form-control\" disabled>
                                                            <div class=\"input-group-append\">
                                                                <a href=\"?edit=$categoryId\"><span style=\"height:100%;background-color:white;border-radius:0;\" class=\"input-group-text\"><i class=\"fa fa-edit\" aria-hidden=\"true\"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ");
                                            }
                                        }
                                    }
                                    
                                ?>
                            </div>
                            <!-- Edit Category Form -->
                            <div class="col-xl-6 col-lg-6 col-sm-12">
                                <p class="p-title">Edit Category</p>
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

</script>

<?php
    require __DIR__ . '/footer.php'
?>