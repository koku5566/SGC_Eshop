<?php
    require __DIR__ . '/header.php';

    //Promotion Status in DB - Delete
    if(isset($_POST['DeletePromotion']))
    {
        $promotionId = $_POST['DeletePromotionID'];
        $sql_delete = "DELETE FROM promotion WHERE promotionID = '$promotionId'";
        if(mysqli_query($conn, $sql_delete))
        {
            ?>
                <script type="text/javascript">
                    alert("Promotion Deleted Successful");
                    window.location.href = window.location.origin + "/seller/promotion.php";
                </script>
            <?php
        }
        else{
            echo '<script>alert("Failed")</script>';
        }
    }
?>

    <!-- Begin Page Content -->
    <div class="container-fluid" id="mainContainer">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Current Promotion</h5>
                    </div>
                    <!-- View Section -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                <div class="row">
                                    <?php
                                        $sql = "SELECT promotionID, promotion_title, promotion_Date, promotionEnd_Date from promotion";
                                        $result = $conn->query($sql); 
                                        if($result-> num_rows > 0){
                                            echo"<table class=\"table table-hover\">
                                            <thead>
                                                <tr>
                                                <th scope=\"col\">Promotion Title</th>
                                                <th scope=\"col\">Date</th>
                                                <th scope=\"col\">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> ";
                                            while($row = $result->fetch_assoc()){
                                                echo"<tr><td>"
                                                .$row["promotion_title"]."</td><td>"."Start:  "
                                                .$row["promotion_Date"]."<br>"."End:   "
                                                .$row["promotionEnd_Date"]."</td>
                                                <td>
                                                <div class=\"col-xl-6\" style=\"padding:0;\">
                                                    <a class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" href=\"?edit=".$row['promotionID']."\" ><i class=\"fa fa-edit \" style=\"padding:0 10px;\" aria-hidden=\"true\"></i>Edit</a>
                                                    </div>
                                                <div class=\"col-xl-6\" style=\"padding:0;\">
                                                    <a class=\"btn btn-outline-danger\" style=\"border:none;width:100%;\" href=\"?delete=".$row['promotionID']."\" ><i class=\"fa fa-trash \" style=\"padding:0 10px;\" aria-hidden=\"true\"></i>Delete</a>
                                                    </div>
                                                </td></tr>";
                                                echo"</tbody></table>";
                                            }
                                        }
                                        else{
                                            echo"<div class=\"text-center\" style=\"flex:auto;\"><p class=\"p-title\">No Promotion.</p></div>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Promotion -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Create New Promotion</h5>
                    </div>
                    <div class="card-body">
                        <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                    <p class="p-title">Promotion Title</p>
                                </div>
                                <div class="col-xl-10 col-lg-10 col-sm-12">
                                    <div class="input-group mb-3">
                                        <input class="form-control" type="text" required placeholder="Enter ..." name="promotion_Title" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 10px">
                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                    <p class="p-title">Date</p>
                                </div>
                                <div class="col-xl-10 col-lg-10 col-sm-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Start</span>
                                                </div>
                                                <input class="form-control" type="date" name="pDate_From" id="promotion_Date" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">End</span>
                                                </div>
                                                <input class="form-control" type="date" name="pDate_To" id="promotionEnd_Date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                    <p class="p-title">Cover Image</p>
                                </div>
                                <div class="row">
                                    <div class="col-xl-10 col-lg-10 col-sm-12">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                                <div class="row" style="margin-right: 0.5rem;margin-left: 0.5rem;">
                                                    <div style="padding-bottom: .625rem;display:flex">
                                                        <div class="imageDiv">
                                                            <div class="image-container">
                                                                <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                                                <div class="image-layer">
                                                                </div>
                                                                <div class="image-tools-delete hide">
                                                                    <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="image-tools-add">
                                                                    <label class="custom-file-upload">
                                                                        <input type="file" accept=".png,.jpeg,.jpg" name="img[]" id="upload_file" class="imgInp" required>
                                                                        <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="text-muted m-2 text-center" style="flex:auto">
                                    <small>This image should be landscape. Recommended image size in ratio 16:9. (Example: 1920 x 1080)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Ending -->         
                    <div class="d-sm-flex align-items-center mb-4" style="justify-content: end;">
                        <button class="btn btn-outline-primary" type="submit" name="create_btn" >Submit</button>
                    </div>

                    <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST' ||isset($_POST['create_btn']))
                        {
                            $title = mysqli_real_escape_string($conn, SanitizeString($_POST['promotion_Title']));
                            $dateStart = mysqli_real_escape_string($conn, SanitizeString($_POST['pDate_From']));
                            $dateEnd = mysqli_real_escape_string($conn, SanitizeString($_POST['pDate_To']));
                            
                            //File upload configuration 
                            $fileNames = array_filter($_FILES['img']['name']); 
                            $targetDir = dirname(__DIR__, 1)."/img/promotion/"; 
                            $allowTypes = array('jpg','png','jpeg');

                            $fileName = basename($_FILES['img']['name'][0]); 
                            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                            $fileName = round(microtime(true) * 1000).".".$ext;
                            $targetFilePath = $targetDir.$fileName; 
                            // Check whether file type is valid 
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                            if(in_array($fileType, $allowTypes)){ 
                                if(move_uploaded_file($_FILES["img"]["tmp_name"][0], $targetFilePath)){ 
                                    $sql = "INSERT INTO `promotion` (`promotionID`,`promotion_title`,`promotion_image`, `promotion_Date`, `promotionEnd_Date`) 
                                            VALUES((SELECT CONCAT('PR',(SELECT LPAD((SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'sgcprot1_SGC_ESHOP' AND TABLE_NAME = 'promotion'), 6, 0))) AS newCombinationId), '$title','$fileName','$dateStart','$dateEnd')";
                                            
                                            $result = mysqli_query($conn,$sql);

                                            if($result)
                                            {
                                                echo '<script>alert("Add promotion successfully!")</script>';
                                                ?>
                                                    <script type="text/javascript">
                                                        window.location.href = window.location.origin + "/seller/promotion.php";
                                                    </script>
                                                <?php
                                            }
                                            else
                                            {
                                                echo '<script>alert("Failed")</script>';
                                            }
                                }
                            }
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Promotion Modal - deletePromotionModel -->
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal fade" id="deletePromotionModel" tabindex="-1" role="dialog" aria-labelledby="deletePromotionModel" <?php echo(isset($_GET['delete']) ? "" : "aria-hidden=\"true\"");?> >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Delete Promotion</h5>
                    <button type="button" class="close closeDeleteModel" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-sm-4">
                            <div class="image-container-2">
                                <?php
                                    $promotionId = $_GET['delete'];
                                    $sql = "SELECT promotion_image FROM promotion WHERE promotionID = '$promotionId'";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            
                                            $picture = $row["promotion_image"];
                                            $picName = "";

                                            if($row["promotion_image"] != "")
                                            {
                                                $picName = "/img/promotion/".$row["promotion_image"];
                                            }
                                            
                                            echo("<img class=\"card-img-top img-thumbnail\" style=\"object-fit:contain;width:100%;height:100%;min-height:10px;\" src=\"$picName\">");
                                        }
                                    }
                                    else
                                    {
                                        echo("<img class=\"card-img-top img-thumbnail\" style=\"object-fit:contain;width:100%;height:100%\">");
                                    }
                                ?>
                                
                                <div class="image-layer-2">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-sm-9">
                            <div class="form-group">
                                <label>Promotion Title</label>
                                <?php
                                $promotionId = $_GET['delete'];
                                $sql = "SELECT promotionID, promotion_title FROM promotion WHERE promotionID = '$promotionId'";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $promotionId = $row["promotionID"];
                                        $promotionTitle = $row["promotion_title"];

                                        echo("<input type=\"text\" class=\"form-control\" name=\"DeletePromotionID\" value=\"$promotionId\" hidden>");
                                        echo("<input type=\"text\" class=\"form-control\" name=\"DeletePromotionTitle\" value=\"$promotionTitle\" readonly>");
                                    }
                                }
                                ?>
                                <p style="color:#ce0000;">Caution</p>
                                <p style="color:#ce0000;">Once deleted, the promotion will not able to restore</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeDeleteModel" data-dismiss="modal">Close</button>
                    <button type="submit" name="DeletePromotion"  class="btn btn-danger" value="1">Delete</button>
                </div>
            </div>
        </div>
    </form>
<!-- /.container-fluid -->

<style>
    .image-container-2{
        width: 80px;
        height: 80px;
        background-color: white;
    }

    .image-container{
        width: 368px; 
        height: 207px; 
        background-color: white;
    }

    .image-layer:hover ~ .image-tools-delete{
        display:block;
    }

    .image-layer{
        width: 368px;
        height: 207px;
        opacity:0.5;
        position:absolute;
        margin-top: -200px;
    }

    .image-tools-delete:hover{
        display:block;
    }

    .image-tools-delete{
        width: 368px;
        height: 50px;
        background:grey;
        position:absolute;
        margin-top: -50px;
        opacity: 0.5;
    }

    .image-tools-delete-icon{
        color: white;
        justify-content: center;
        display: grid;
        margin-top: 5px;
        font-size: 40px;
    }


    .image-tools-add{
        width: 368px;
        height: 207px;
        background:white;
        opacity:0.5;
        position:absolute;
        margin-top: -200px;
        z-index:100;
    }

    .image-tools-add-icon{
        color: black;
        justify-content: center;
        display: grid;
        margin-top: 80px;
        font-size: 40px;
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

    initImages();

    function initImages()
    {
        const deleteImg = document.querySelectorAll('.image-tools-delete-icon');

        deleteImg.forEach(img => {
            img.addEventListener('click', function handleClick(event) {
                img.parentElement.previousElementSibling.previousElementSibling.src="";
                img.parentElement.nextElementSibling.classList.remove("hide");
                img.parentElement.nextElementSibling.firstElementChild.firstElementChild.value=null;
                img.parentElement.classList.add("hide");
            });
        });

        const imgInp = document.querySelectorAll('.imgInp');
        imgInp.forEach(img => {
            img.addEventListener('change', function handleChange(event) {
                const [file] = img.files;
                var ext = img.files[0].name.split('.').pop();
                var extArr = ["jpg", "jpeg", "png"];
                if(img.files && img.files[0])
                {
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

    window.addEventListener('load', function () {
        if(<?php echo(isset($_GET['delete']) ? "1" : "0") ?> == 1)
        {
            $("#deletePromotionModel").modal('show');
        }
    });

    const closeDeleteModel = document.querySelectorAll('.closeDeleteModel');

    closeDeleteModel.forEach(btn => {
        btn.addEventListener('click', function handleClick(event) {
            $("#deletePromotionModel").modal('hide');
        });
    });
</script>

<script src="../js/checkFileType.js"></script>

<?php
    require __DIR__ . '/footer.php'
?>