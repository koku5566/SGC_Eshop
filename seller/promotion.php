<?php
    require __DIR__ . '/header.php'
?>

    <!-- Begin Page Content -->
    <div class="container-fluid" style="width: 80%;">
        <h1 style="margin-top: 50px;">Promotion Banner</h1>
        <div class="d-lg-block d-xl-block d-xxl-block" style="margin-top: 30px;">

        <!--<section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                    <div>
                        <h2>Terms and Conditions</h2>
                        <textarea class="form-control" id="eTncEditor" placeholder="Edit your TnC here..." name="eTnC"></textarea>
                    </div>
                </section>-->

            <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" enctype="multipart/form-data">
                
                <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                    <h2>Cover Image<input class="form-control" type="file" id="coverImg" style="margin-top: 10px;" name="coverImage"></h2>
                </section>
                
                <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                    <h2>Promotion Details</h2>
                    <h3 style="margin-top: 30px;">Promotion Title<input class="form-control" type="text" required placeholder="Event Title" style="margin-top: 10px;" name="eventTitle"></h3>
                    <div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h3 style="margin-top: 30px;width: 100%;">Promotion Date</h3>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check" style="width: 100%;margin-top: 44px;"><input class="form-check-input" type="checkbox" id="oneDayEvent_check"><label class="form-check-label" for="formCheck-1"><strong>One-Day Event</strong></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5"><input class="form-control" type="date" name="eDate_From" id="eStartDate" required></div>

                            <div class="col-sm-5"><input class="form-control" type="date" name="eDate_To" id="eEndDate" required></div>
                        </div>
                    </div>
                    <div>
                        <h3 style="margin-top: 30px;width: 100%;">Promotion Time</h3>
                        <div class="row">
                            <div class="col-sm-5"><input class="form-control" type="time" name="eTime_From" required></div>

                            <div class="col-sm-5"><input class="form-control" type="time" name="eTime_To" required></div>
                        </div>
                    </div>
                </section>
                
                
                <div style="margin-top: 61px;text-align: center;margin-bottom: 61px;">
                    <div class="btn-group" role="group"><button class="btn btn-secondary" type="button" style="margin-left: 5px;margin-right: 5px;">Back</button>
                    <button class="btn btn-outline-primary" type="submit" name="eRegister" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);color: rgb(255,255,255);">Submit</button></div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>