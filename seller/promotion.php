<?php
    require __DIR__ . '/header.php';

    if ($_SESSION['login'] == "" || $_SESSION['uid'] == ""){
        ?>
            <script type="text/javascript">
                window.location.href = window.location.origin + "/seller/sellerLogin.php";
            </script>
        <?php
        exit;
	}

    //Promotion Status in DB - Approve Section
    if(isset($_POST['Approve']))
    {
        $promotionId = $_POST['Approve'];
        
        $sql_approve = "UPDATE promotion SET `status` = 1 WHERE promotionID = '$promotionId'"; 
        $result = mysqli_query($conn, $sql_approve);
        if($result)
        {
            ?>
                <script type="text/javascript">
                    alert("Promotion Approve Successful");
                    window.location.href = window.location.origin + "/seller/promotion.php";
                </script>
            <?php
        }
        else{
            echo '<script>alert("Failed")</script>';
        }
    }

    //Promotion Status in DB - Reject Section
    if(isset($_POST['Reject']))
    {
        $promotionId = $_POST['Reject'];
        $sql_reject = "DELETE FROM promotion WHERE promotionID = '$promotionId'";
        if(mysqli_query($conn, $sql_reject))
        {
            ?>
                <script type="text/javascript">
                    alert("Promotion Reject Successful");
                    window.location.href = window.location.origin + "/seller/promotion.php";
                </script>
            <?php
        }
        else{
            echo '<script>alert("Failed")</script>';
        }
    }

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

    //Promotion Status in DB - Edit
    if(isset($_POST['EditPromotion']))
    {
        $promotionId = $_POST['EditPromotionID'];
        $promotion_title = $_POST['EditPromotionTitle'];
        $promotion_Date = date('Y-m-d', strtotime($_POST['EditPromotionDate']));
        $promotionEnd_Date = date('Y-m-d', strtotime($_POST['EditPromotionEndDate']));
        $promotion_image = "";
        
        $fileNames = array_filter($_FILES['imgEdit']['name']); 
        $defaultFile = $_POST['imgDefaultEdit'];

        // File upload configuration 
        $targetDir = dirname(__DIR__, 1)."/img/promotion/"; 
        $allowTypes = array('jpg','png','jpeg'); 

        foreach($_FILES['imgEdit']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['imgEdit']['name'][$key]); 
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileName = round(microtime(true) * 1000).".".$ext;
            $targetFilePath = $targetDir.$fileName; 
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                if(move_uploaded_file($_FILES["imgEdit"]["tmp_name"][$key], $targetFilePath)){ 
                    $promotion_image = $fileName;
                }
            }
            else if($defaultFile[$key] != "") //Get the default picture name
            {
                $promotion_image = $defaultFile[$key];
            }
            else
            {
                $promotion_image = "";
            }
        } 
        $sql_edit = "UPDATE promotion SET promotion_image='$promotion_image', promotion_title='$promotion_title', promotion_Date='$promotion_Date', promotionEnd_Date='$promotionEnd_Date' WHERE promotionID = '$promotionId'";

        if(mysqli_query($conn, $sql_edit))
        {
            ?>
                <script type="text/javascript">
                    alert("Promotion Edited Successful");
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
                            <div class="col-xl-12">
                                <div class="row">
                                    <?php
                                        $userId = $_SESSION['userid'];
                                        if($_SESSION['role']=="SELLER")
                                        {
                                            $sql = "SELECT * FROM promotion AS A LEFT JOIN user AS B ON A.user_id = B.userID WHERE B.userID = '$userId' AND `status` = 0";
                                        }
                                        else //if($_SESSION['role']=="ADMIN")
                                        {
                                            $sql = "SELECT * FROM promotion AS A LEFT JOIN user AS B ON A.user_id = B.userID WHERE B.userID = '$userId' AND `status` = 1";
                                        }

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
                                            }
                                            echo"</tbody></table>";
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

        <!-- Approved Section-->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Approve Section</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                    <?php
                                        if ($_SESSION['role'] == "SELLER")
                                        { 
                                            echo ("
                                                <div class=\"col-xl-2 col-lg-2 col-sm-12\">
                                                    <p class=\"p-title\">Banner display at:</p>
                                                </div>
                                                <div class=\"col-xl-10 col-lg-10 col-sm-12\">
                                                    <div class=\"input-group mb-3\">
                                                        <select class=\"form-control\" id=\"status\" name=\"status\" required>
                                                            <option name=\"sellerPage\" value=\"0\">Seller Page</option>
                                                            <option name=\"homePage\" value=\"1\">Home Page</option>
                                                        </select>
                                                    </div>
                                                </div>");
                                                
                                        }
                                    ?>
                                    <!-- Approve - View/Approve/Reject Section -->
                                        <?php
                                            if ($_SESSION['role'] == "ADMIN")
                                            { 
                                                
                                                $sql = "SELECT * FROM promotion AS A LEFT JOIN user AS B ON A.user_id = B.userID WHERE `status` = 2";
                                                $result = $conn->query($sql);
                                                if($result-> num_rows > 0){ 
                                                    while($row = $result->fetch_assoc()){
                                                    echo ("
                                                    <div class=\"row\">
                                                        <div class=\"col-xl-2 col-lg-2 col-sm-12\">
                                                            <p class=\"p-title\">Promotion Title</p>
                                                        </div>
                                                        <div class=\"col-xl-10 col-lg-10 col-sm-12\">
                                                            <a class=\"btn btn-outline-primary\" style=\"border:none;width:100%;\" href=\"?approveSection=".$row['promotionID']."\" ><i class=\"fa fa-eye \" style=\"padding:0 10px;\" aria-hidden=\"true\"></i>View</a>
                                                        </div>
                                                    </div>");
                                                    }
                                                }
                                                else{
                                                    echo"<div class=\"text-center\" style=\"flex:auto;\"><p class=\"p-title\">No pending request.</p></div>";
                                                }
                                            }
                                        ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Approve - View/Approve/Reject Section -->
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal fade" id="approveSectionModel" tabindex="-1" role="dialog" aria-labelledby="approveSectionModel" <?php echo(isset($_GET['approveSection']) ? "" : "aria-hidden=\"true\"");?> >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Approve Section</h5>
                        <button type="button" class="close approveSectionModel" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                <div class="image-container">
                                    <?php
                                        $promotionId = $_GET['approveSection'];
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
                                    
                                    <div class="image-layer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <label>Promotion Title</label>
                                    <?php
                                    $promotionId = $_GET['approveSection'];
                                    $sql = "SELECT promotionID, promotion_title, promotion_Date, promotionEnd_Date FROM promotion WHERE promotionID = '$promotionId'";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $promotionId = $row["promotionID"];
                                            $promotionTitle = $row["promotion_title"];
                                            $promotionDate = $row["promotion_Date"];
                                            $promotionEnd_Date = $row["promotionEnd_Date"];

                                            echo("<br><input type=\"text\" class=\"form-control\" name=\"approveSectionID\" value=\"$promotionId\" hidden>");
                                            echo("<input type=\"text\" class=\"form-control\" name=\"approveSectionTitle\" value=\"$promotionTitle\" readonly>");
                                            echo("<br>Start Date: <input type=\"text\" class=\"form-control\" name=\"approveSectionTitle\" value=\"$promotionDate\" readonly>");
                                            echo("<br>End Date: <input type=\"text\" class=\"form-control\" name=\"approveSectionTitle\" value=\"$promotionEnd_Date\" readonly>");
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary approveSectionModel" data-dismiss="modal">Close</button>
                        <button type="submit" name="Approve"  class="btn btn-success" value="<?php echo $_GET['approveSection']; ?>">Approve</button>
                        <button type="submit" name="Reject"  class="btn btn-danger" value="<?php echo $_GET['approveSection']; ?>">Reject</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
                                                <input class="form-control" type="date" min="<?php echo date("Y-m-d", strtotime("-1 month")); ?>" name="startDate" id="promotion_Date" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">End</span>
                                                </div>
                                                <input class="form-control" type="date" min="<?php echo date("Y-m-d",  strtotime("-1 month")); ?>" name="endDate" id="promotionEnd_Date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">
                                    <p class="p-title">Cover Image</p>
                                </div>
                            </div>

                            <div class="row" style="margin-right: 0.5rem;margin-left: 0.5rem;">
                                <div style="padding-bottom: .625rem;width:100%">
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

                            <div class="text-muted m-2 text-center" style="flex:auto">
                                <small>The image size only that smaller than 2MB. This image should be landscape. Recommended image size in ratio 16:9. (Example: 1920 x 1080)</small>
                            </div>
                            <?php
                                if ($_SESSION['role'] == "SELLER")
                                { echo ("
                                    <div class=\"row\">
                                        <div class=\"col-xl-2 col-lg-2 col-sm-12\">
                                            <p class=\"p-title\">Banner display at:</p>
                                        </div>
                                        <div class=\"col-xl-10 col-lg-10 col-sm-12\">
                                            <div class=\"input-group mb-3\">
                                                <select class=\"form-control\" id=\"status\" name=\"status\" required>
                                                    <option name=\"sellerPage\" value=\"0\">Seller Page</option>
                                                    <option name=\"requestHomePage\" value=\"2\">Home Page</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>");
                                }
                            ?>
                            <?php
                                if ($_SESSION['role'] == "ADMIN")
                                { echo ("
                                    <div class=\"row\">
                                        <div class=\"col-xl-2 col-lg-2 col-sm-12\">
                                            <p class=\"p-title\">Banner display at:</p>
                                        </div>
                                        <div class=\"col-xl-10 col-lg-10 col-sm-12\">
                                            <div class=\"input-group mb-3\">
                                                <select class=\"form-control\" id=\"status\" name=\"status\" required>
                                                    <option name=\"homePage\" value=\"1\">Home Page</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>");
                                }
                            ?>
                        </div>
                    </div>

                    <!-- Page Ending -->         
                    <div class="d-sm-flex align-items-center mb-4" style="justify-content: end;">
                        <button class="btn btn-outline-primary" type="button" onclick="submitAddForm()">Submit</button>
                        <button class="btn btn-outline-primary" type="submit" id="create_btn" name="create_btn" hidden>Submit</button>
                    </div>

                    <!-- Create Function -->
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST' ||isset($_POST['create_btn']))
                        {
                            $title = $_POST['promotion_Title'];
                            $dateStart = date('Y-m-d', strtotime($_POST['startDate']));
                            $dateEnd = date('Y-m-d', strtotime($_POST['endDate']));
                            $status = $_POST['status'];
                            $userId = $_SESSION['userid'];

                            //if date valid
                            if( $dateEnd < $dateStart)
                            {
                                echo"<script>alert('The start date and end date is invalid.')</script>";
                            }
                            
                            else
                            {
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
                                        $sql = "INSERT INTO `promotion` (`promotionID`,`promotion_title`,`promotion_image`, `promotion_Date`, `promotionEnd_Date`, `status`, `user_id`) 
                                                VALUES((SELECT CONCAT('PR',(SELECT LPAD((SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'sgcprot1_SGC_ESHOP' AND TABLE_NAME = 'promotion'), 6, 0))) AS newCombinationId), '$title','$fileName','$dateStart','$dateEnd','$status', '$userId')";
                                                
                                                $result = mysqli_query($conn,$sql);

                                                if($result)
                                                {
                                                    if($status == 0)
                                                    {
                                                        echo '<script>alert("Add promotion successfully!")</script>';
                                                        ?>
                                                            <script type="text/javascript">
                                                                window.location.href = window.location.origin + "/seller/promotion.php";
                                                            </script>
                                                        <?php
                                                    }
                                                    else if ($status == 1)
                                                    {
                                                        echo '<script>alert("Promotion is pending to added, need to be approved by admin.")</script>';
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<script>alert("Failed")</script>';
                                                }
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
                            <div class="col-xl-12 col-lg-12 col-sm-12">
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
                            <div class="col-xl-12 col-lg-12 col-sm-12">
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

                                            echo("<br><input type=\"text\" class=\"form-control\" name=\"DeletePromotionID\" value=\"$promotionId\" hidden>");
                                            echo("<input type=\"text\" class=\"form-control\" name=\"DeletePromotionTitle\" value=\"$promotionTitle\" readonly>");
                                        }
                                    }
                                    ?>
                                    <br>
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
        </div>
    </form>

    <!-- Edit Promotion Modal - editPromotionModel -->
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal fade" id="editPromotionModel" tabindex="-1" role="dialog" aria-labelledby="editPromotionModel" <?php echo(isset($_GET['edit']) ? "" : "aria-hidden=\"true\"");?> >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Edit Promotion</h5>
                        <button type="button" class="close closeEditModel" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                <div class="image-container">
                                    <?php
                                        $promotionId = $_GET['edit'];
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
                                                
                                                echo("<img class=\"card-img-top img-thumbnail editImage\" style=\"object-fit:contain;width:100%;height:100%\" src=\"$picName\">");
                                            }
                                        }
                                        else
                                        {
                                            echo("<img class=\"card-img-top img-thumbnail editImage\" style=\"object-fit:contain;width:100%;height:100%\">");
                                        }
                                    ?>
                                    
                                    <div class="image-layer">
                                    </div>
                                    <div class="image-tools-delete hide">
                                        <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                    </div>
                                    <div class="image-tools-add <?php echo($picName != "" ? "hide" : "");?>">
                                        <label class="custom-file-upload">
                                            <input accept=".png,.jpeg,.jpg" id="img_Edit" name="imgEdit[]" type="file" class="imgInp" />
                                            <input name="imgDefaultEdit[]" id="img_Edit_Default" type="text" value="<?php echo($picture) ?>" hidden/>
                                            <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <label>Promotion Title</label>
                                    <?php
                                    $promotionId = $_GET['edit'];
                                    $sql = "SELECT promotionID, promotion_title, promotion_Date, promotionEnd_Date FROM promotion WHERE promotionID = '$promotionId'";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $promotionId = $row["promotionID"];
                                            $promotionTitle = $row["promotion_title"];
                                            $promotionDate = $row["promotion_Date"];
                                            $promotionEnd_Date = $row["promotionEnd_Date"];

                                            echo("<br><input type=\"text\" class=\"form-control\" name=\"EditPromotionID\" value=\"$promotionId\" hidden>");
                                            echo("<input type=\"text\" class=\"form-control\" name=\"EditPromotionTitle\" value=\"$promotionTitle\">");
                                            echo("<br><label>Date</label>");
                                            echo("<div class=\"input-group mb-2\"><div class=\"input-group-prepend\"><span class=\"input-group-text\" id=\"basic-addon1\">Start</span></div><input type=\"date\" class=\"form-control\" min=\"". date("Y-m-d",  strtotime("-1 month"))."\"name=\"EditPromotionDate\" value=\"$promotionDate\"></div>");
                                            echo("<div class=\"input-group mb-2\"><div class=\"input-group-prepend\"><span class=\"input-group-text\" id=\"basic-addon1\">End</span></div><input type=\"date\" class=\"form-control\" min=\"". date("Y-m-d",  strtotime("-1 month"))."\" name=\"EditPromotionEndDate\" value=\"$promotionEnd_Date\"></div>");
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary closeEditModel" data-dismiss="modal">Close</button>
                        <button type="button" onclick="submitEditForm()" class="btn btn-danger" value="1">Edit</button>
                        <button type="submit" name="EditPromotion" id="edit_btn" class="btn btn-danger" value="1" hidden>Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

<!-- /.container-fluid -->

<style>
  .editIcon{
        color: #a31f37;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        height:100%;
        background-color:white;
        border-radius:0;
        border:none;
    }

    .editIcon:hover{
        color: white;
        background-color:#a31f37;
    }

    .p-title{
        color: #a31f37;
    }

    .image-container{
        width: 100%;
        height: 200px;
        background-color: white;
    }

    .image-layer:hover ~ .image-tools-delete{
        display:block;
    }

    .image-layer{
        width: 95%;
        height: 200px;
        opacity: 0.5;
        position: absolute;
        margin-top: -200px;
    }

    .image-tools-delete:hover{
        display:block;
    }

    .image-tools-delete{
        width: 95%;
        height: 30px;
        background: grey;
        position: absolute;
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
        width: 95%;
        height: 200px;
        background: white;
        opacity: 0.5;
        position: absolute;
        margin-top: -200px;
        z-index: 100;
    }

    .image-tools-add-icon{
        color: black;
        justify-content: center;
        display: grid;
        margin-top: 75px;
        font-size: 50px;
    }

    .custom-file-upload{
        width:100%;
        height:100%;
    }

    .imgInp{
        display:none;
    }

    .img-thumbnail{
        min-height: 0;
        border: 1px solid #e3e3e3;
        border-radius: 10px;
    }
    
    .hide{
        display:none;
    }
</style>

<script>

    function submitEditForm(){
        if(document.getElementById("img_Edit").value != "" || document.getElementById("img_Edit_Default").value != "")
        {
            document.getElementById("edit_btn").click();
        }
        else
        {
            alert("Please Select a Cover Picture");
        }
    }

    function submitAddForm(){
        if(document.getElementById("upload_file").value != "")
        {
            document.getElementById("create_btn").click();
        }
        else
        {
            alert("Please Select a Cover Picture");
        }
    }

    initImages();

    function initImages()
    {
        const deleteImg = document.querySelectorAll('.image-tools-delete-icon');

        deleteImg.forEach(img => {
            img.addEventListener('click', function handleClick(event) {
                img.parentElement.previousElementSibling.previousElementSibling.src="";
                img.parentElement.nextElementSibling.classList.remove("hide");
                img.parentElement.nextElementSibling.firstElementChild.firstElementChild.value=null;
                img.parentElement.nextElementSibling.firstElementChild.firstElementChild.nextElementSibling.value=null;
                img.parentElement.classList.add("hide");
            });
        });

        const imgInp = document.querySelectorAll('.imgInp');
        imgInp.forEach(img => {
            img.addEventListener('change', function handleChange(event) {
                const [file] = img.files;
                var maxsize = 2000000;
                var extArr = ["jpg", "jpeg", "png"];
                var imageValid = true;
                for (var a = 0; a < this.files.length; a++)
                {
                    var ext = img.files[a].name.split('.').pop();
                    if(img.files[a].size >= maxsize || !extArr.includes(ext))
                    {
                        imageValid = false;
                    }
                }

                if(imageValid)
                {
                    if(img.files && img.files[0])
                    {
                        if(img.files[0].size < maxsize)
                        {
                            img.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(img.files[0]);
                            img.parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                            img.parentElement.parentElement.classList.add("hide");
                        }
                    }
                }
                else
                {
                    alert("This Image is not a valid format, only image that smaller than 2MB and with .jpg, .jpeg and .png extension are allowed");
                    img.value = "";
                }
            });
        });
    }

    window.addEventListener('load', function () {
        if(<?php echo(isset($_GET['approveSection']) ? "1" : "0") ?> == 1)
        {
            $("#approveSectionModel").modal('show');
        }
    });

    const approveSectionModel = document.querySelectorAll('.approveSectionModel');

    approveSectionModel.forEach(btn => {
        btn.addEventListener('click', function handleClick(event) {
            $("#approveSectionModel").modal('hide');
        });
    });

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

    window.addEventListener('load', function () {
        if(<?php echo(isset($_GET['edit']) ? "1" : "0") ?> == 1)
        {
            $("#editPromotionModel").modal('show');
        }
    });

    const closeEditModel = document.querySelectorAll('.closeEditModel');

    closeEditModel.forEach(btn => {
        btn.addEventListener('click', function handleClick(event) {
            $("#editPromotionModel").modal('hide');
        });
    });
</script>

<script src="../js/checkFileType.js"></script>

<?php
    require __DIR__ . '/footer.php'
?>