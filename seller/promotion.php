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
                    <h4 style="margin-top: 30px;width: 100%;">Cover Image<input class="form-control" type="file" id="coverImg" style="margin-top: 10px;" name="coverImage"></h4>
                    
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
                                                        <p>Cover Picture</p>
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

<?php
    require __DIR__ . '/footer.php'
?>