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
                                                            <input type=\"text\" value=\"$categoryName\" style=\"background-color:white;border-radius:0;\" class=\"form-control\" disabled>
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
                                                            <input type=\"text\" value=\"$categoryName\" style=\"background-color:white;border-radius:0;\" class=\"form-control\" disabled>
                                                            <div class=\"input-group-append\">
                                                                <a href=\"?edit=$categoryId\"><span style=\"height:100%;background-color:white;border-radius:0;\" class=\"input-group-text\"><i class=\"fa fa-edit\" aria-hidden=\"true\"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ");
                                            }
                                            
                                        }
                                        echo("
                                        <div>
                                            <div class=\"input-group\">
                                                <button type=\"button\" data-toggle=\"modal\" data-target=\"#addMainModel\" class=\"btn btn-outline-primary\" style=\"width:100%\">Add New Category</button>
                                            </div>
                                        </div>
                                        ");
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
                                                $toggle = "toggle=".$mainCategoryId."&";
                                                echo("
                                                    <div>
                                                        <div class=\"input-group\">
                                                            <input type=\"text\" value=\"$categoryName\" style=\"background-color:white;border-radius:0;\" class=\"form-control\" disabled>
                                                            <div class=\"input-group-append\">
                                                                <a href=\"?{$toggle}edit=$categoryId\"><span style=\"height:100%;background-color:white;border-radius:0;\" class=\"input-group-text\"><i class=\"fa fa-edit\" aria-hidden=\"true\"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ");
                                            }
                                            echo("
                                            <div>
                                                <div class=\"input-group\">
                                                    <button type=\"button\" data-toggle=\"modal\" data-target=\"#addSubModel\" class=\"btn btn-outline-primary\" id=\"btnAddSubCategory\" style=\"width:100%\">Add New Sub Category</button>
                                                </div>
                                            </div>
                                        ");
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

        <!-- Modal -->
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="modal fade" id="addMainModel" tabindex="-1" role="dialog" aria-labelledby="addMainModel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-sm-4"></div>
                            <div class="image-container">
                                <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                <div class="image-layer">
                                </div>
                                <div class="image-tools-delete hide">
                                    <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                </div>
                                <div class="image-tools-add">
                                    <label class="custom-file-upload">
                                        <input accept="image/*" name="img[]" type="file" class="imgInp"/>
                                        <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            <p>Category Picture</p>
                        </div>
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-sm-8">
                                <div class="row">
                                    <div class="col-xl-2 col-lg-2 col-sm-12">
                                        <p class="p-title">Category Name</p>
                                    </div>
                                    <div class="col-xl-10 col-lg-10 col-sm-12">
                                        <div class="input-group mb-3">
                                        <input type="text" name="AddCategoryName" class="form-control" placeholder="Category Name ..." required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>

</div>
<!-- /.container-fluid -->

<style>
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

    .warning, .warning:focus{
        border:1px red solid;
    }

    .warning-message{
        color:red;
        font-weight:bold;
    }

</style>

<script>

</script>

<?php
    require __DIR__ . '/footer.php'
?>