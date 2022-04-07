<?php
    require __DIR__ . '/header.php'
?>

    <!-- Begin Page Content -->
    <div class="container-fluid" style="width: 80%;">
        <h1 style="margin-top: 50px;">Promotion Banner</h1>
        <div class="d-lg-block d-xl-block d-xxl-block" style="margin-top: 30px;">

        <!-- View Section -->
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                    <div>
                        <h2>View</h2>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">Promotion Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT promotion_title, promotion_Date, promotionEnd_Date from promotion";
                                    $result = $conn->query($sql); 
                                    if($result-> num_rows > 0){
                                         while($row = $result->fetch_assoc()){
                                             echo"<tr><td>"
                                             .$row["promotion_title"]."</td><td>"."Start:  ".$row["promotion_Date"]."<br>"."End:   ".$row["promotionEnd_Date"]."</td><td><button class='edit_btn' type='submit' name='edit'></button></td></tr>";
                                         }
                                         echo"</table>";
                                     }
                                     else{
                                         echo"No Promotion.";
                                     }
                                ?>
                            </tbody>
                            </table>
                    </div>
                </section>

            <!-- Create Promotion -->
            <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" enctype="multipart/form-data">
                <!--
                <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                    
                </section>-->
                
                <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                    <h2>Promotion Details</h2>
                    <h4 style="margin-top: 30px;">Title<input class="form-control" type="text" required placeholder="Promotion Title" style="margin-top: 10px;" name="promotion_Title"></h4>
                    <h4 style="margin-top: 30px;width: 100%;">Cover Image</h4>
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
                                                            <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp">
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

                    <div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h4 style="margin-top: 30px;width: 100%;">Date</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5"><input class="form-control" type="date" name="pDate_From" id="promotion_Date" required></div>
                            <div class="col-sm-2">
                                <h5 style="text-align: center;margin-top: 6px;">To</h5>
                            </div>
                            <div class="col-sm-5"><input class="form-control" type="date" name="pDate_To" id="promotionEnd_Date" required></div>
                        </div>
                    </div>
                </section>
                
                
                <div style="margin-top: 61px;text-align: center;margin-bottom: 61px;">
                    <div class="btn-group" role="group"><button class="btn btn-secondary" type="button" style="margin-left: 5px;margin-right: 5px;">Back</button>
                    <button class="btn btn-outline-primary" type="submit" name="create_btn" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);color: rgb(255,255,255);">Submit</button></div>
                </div>
                <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' ||isset($_POST['create_btn']))
                {
                    $title = mysqli_real_escape_string($conn, SanitizeString($_POST['promotion_Title']));
                    //$image = $_POST['promotion_image']; 
                    $dateStart = mysqli_real_escape_string($conn, SanitizeString($_POST['pDate_From']));
                    $dateEnd = mysqli_real_escape_string($conn, SanitizeString($_POST['pDate_To']));
                    
                    $sql = "INSERT INTO `promotion` (`promotion_title`, `promotion_Date`, `promotionEnd_Date`) 
                    VALUES('$title','$dateStart','$dateEnd')";
                    echo '<script>alert("hihi 2")</script>';
                    $result = mysqli_query($conn,$sql);
                    
                    // File upload configuration 
                    //$targetDir = dirname(__DIR__, 1)."/img/promotion/"; 
                    //$allowTypes = array('jpg','png','jpeg'); 

                    //if(!empty($fileNames)){ 
                        //foreach($_FILES['img']['name'] as $key=>$val){ 
                            // File upload path 
                            
                            //$fileName = basename($_FILES['img']['name'][$key]); 
                            //$ext = pathinfo($fileName, PATHINFO_EXTENSION);
                            //$fileName = round(microtime(true) * 1000).".".$ext;
                            //$targetFilePath = $targetDir.$fileName; 
                            // Check whether file type is valid 
                            //$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                            //if(in_array($fileType, $allowTypes)){ 
                                //if(move_uploaded_file($_FILES["img"]["tmp_name"][$key], $targetFilePath)){ 
                                  //  $sql_insert .= "'$fileName', ";
                                   // $imgInpCounter++;
                              //  }
                           // }
                        //} 
                   // }

                    if($result)
                    {
                        echo '<script>alert("Add promotion successfully!")</script>';
                    }
                    else
                    {
                        echo '<script>alert("Failed")</script>';
                    }
                }
                ?>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
<style>
    .image-container{
        width: 344px;
        height: 200px;
        background-color: white;
    }

    .image-layer:hover ~ .image-tools-delete{
        display:block;
    }

    .image-layer{
        width: 344px;
        height: 200px;
        opacity:0.5;
        position:absolute;
        margin-top: -200px;
    }

    .image-tools-delete:hover{
        display:block;
    }

    .image-tools-delete{
        width: 344px;
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
        width: 344px;
        height: 200px;
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
</script>
<?php
    require __DIR__ . '/footer.php'
?>