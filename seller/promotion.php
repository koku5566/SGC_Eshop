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
                                <th scope="col">Date/Time</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT promotion_title, promotion_period from promotion";
                                    $result = $conn->query($sql); 
                                    if($result-> num_rows > 0){
                                         while($row = $result->fetch_assoc()){
                                             echo"<tr><td>"
                                             .$row["promotion_title"]."</td><td>".$row["promotion_period"]."</td><td>";
                                         }
                                         echo"</table>";
                                     }
                                     else{
                                         echo"No Promotion.";
                                     }
                                     echo"</td><td>
                                     <button type=\"submit\" name=\"delete\" value=\"".$row['product_id']."\">Delete</button>
                                     <button type=\"sumbit\" name=\"edit_btn\" value= \"".$row['product_id']."\">Edit</button></td></tr>;
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
                                                                <input accept="image/*" name="img[]" type="file" class="imgInp" />
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
                            <div class="col-sm-5"><input class="form-control" type="date" name="pDate_From" id="pStartDate" required></div>

                            <div class="col-sm-5"><input class="form-control" type="date" name="pDate_To" id="pEndDate" required></div>
                        </div>
                    </div>
                    <div>
                        <h4 style="margin-top: 30px;width: 100%;">Time</h4>
                        <div class="row">
                            <div class="col-sm-5"><input class="form-control" type="time" name="pTime_From" required></div>

                            <div class="col-sm-5"><input class="form-control" type="time" name="pTime_To" required></div>
                        </div>
                    </div>
                </section>
                
                
                <div style="margin-top: 61px;text-align: center;margin-bottom: 61px;">
                    <div class="btn-group" role="group"><button class="btn btn-secondary" type="button" style="margin-left: 5px;margin-right: 5px;">Back</button>
                    <button class="btn btn-outline-primary" type="submit" name="pCreate" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);color: rgb(255,255,255);">Submit</button></div>
                </div>
            </form>
        </div>
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
</style>
<script>
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
                const [file] = img.files
                if (file) {
                    img.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(file)
                    img.parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                    img.parentElement.parentElement.classList.add("hide");
                }
            });
        });
    }
</script>
<?php
    require __DIR__ . '/footer.php'
?>