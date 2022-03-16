<?php
    require __DIR__ . '/header.php'
?>

<title>Create Event</title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="../css/event.css">


    <!-- Begin Page Content -->
    <div class="container-fluid" style="width:80%">
    <!-- Above template -->

    <h1 style="margin-top: 50px;">Create New Event</h1>
    <div class="d-lg-block d-xl-block d-xxl-block" style="margin-top: 30px;">
        
        <!-- Form for create new event -->
        <form>
            
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <h2>Cover Image<input class="form-control" type="file" id="coverImg" style="margin-top: 10px;" name="coverImage"></h2>
            </section>
            
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <h2>Event Details</h2>
                <h3 style="margin-top: 30px;">Event Title<input class="form-control" type="text" placeholder="Event Title" style="margin-top: 10px;" name="eventTitle"></h3>
                <div>
                    <div class="row">
                        <div class="col-sm-2">
                            <h3 style="margin-top: 30px;width: 100%;">Event Date</h3>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-check" style="width: 100%;margin-top: 44px;"><input class="form-check-input" type="checkbox" id="oneDayEvent_check"><label class="form-check-label" for="formCheck-1"><strong>One-Day Event</strong></label></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5"><input class="form-control" type="date" name="eDate_From" id="eStartDate"></div>
                        <div class="col-sm-2">
                            <h5 style="text-align: center;margin-top: 6px;">To</h5>
                        </div>
                        <div class="col-sm-5"><input class="form-control" type="date" name="eDate_To" id="eEndDate"></div>
                    </div>
                </div>
                <div>
                    <h3 style="margin-top: 30px;width: 100%;">Event Time</h3>
                    <div class="row">
                        <div class="col-sm-5"><input class="form-control" type="time" name="eTime_From"></div>
                        <div class="col-sm-2">
                            <h5 style="text-align: center;margin-top: 6px;">To</h5>
                        </div>
                        <div class="col-sm-5"><input class="form-control" type="time" name="eTime_To"></div>
                    </div>
                </div>
                <div style="margin-top: 30px;">
                    <h3>Description</h3>
                    <div>
                        <div id="toolbar_container" class="sun-editor"></div><textarea class="form-control" id="editor" placeholder="Edit your description here to make your event looks more fun" name="eDesc"></textarea>
                    </div>
                </div>
                <div style="margin-top: 30px;">
                    <h3>Category</h3><input class="form-control" type="text" name="eCategory">
                </div>
                <div>
                    <div class="row">
                        <div class="col-sm-2">
                            <h3 style="margin-top: 30px;width: 100%;">Location</h3>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-check" style="width: 100%;margin-top: 44px;"><input class="form-check-input" type="checkbox" id="onlineCheck"><label class="form-check-label" for="oneDayEvent_check-1"><strong>Online Event</strong></label></div>
                        </div>
                    </div><select class="form-select" name="eLocation" id="optionLocation">
                        <optgroup label="Northern Region">
                            <option value="Perlis">Perlis</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Pulau Pinang">Pulau Pinang</option>
                            <option value="Perak">Perak</option>
                        </optgroup>
                        <optgroup label="Central Region">
                            <option value="Selangor">Selangor</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Putrajaya">Putrajaya</option>
                        </optgroup>
                        <optgroup label="East Coast Region">
                            <option value="Kelantan">Kelantan</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="Pahang">Pahang</option>
                        </optgroup>
                        <optgroup label="Southern Region">
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Johor" selected="">Johor</option>
                        </optgroup>
                        <optgroup label="East Malaysia">
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Labuan">Labuan</option>
                        </optgroup>
                        <optgroup label="Virtual Event">
                            <option value="Online">Online</option>
                        </optgroup>
                    </select>
                </div>
            </section>
            
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <div>
                    <h2>Terms and Conditions</h2>
                    <div>
                        <div id="toolbar_container-1" class="sun-editor"></div><textarea class="form-control" id="editor-1" placeholder="Insert placeholder text in sunEditorInit.js" name="eTnC"></textarea>
                    </div>
                </div>
            </section>
            
            <div style="margin-top: 61px;text-align: center;margin-bottom: 61px;">
                <div class="btn-group" role="group"><button class="btn btn-secondary" type="button" style="margin-left: 5px;margin-right: 5px;">Back</button><button class="btn btn-outline-primary" type="submit" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);color: rgb(255,255,255);">Submit</button></div>
            </div>
        </form>
    </div>

    <!-- Below template -->
    </div>
    <!-- /.container-fluid -->

    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
    <script src="../js/Suneditor-WYSIWYG.js"></script>
    <script src="../js/createEventJS.js"></script>

<?php
    require __DIR__ . '/footer.php'
?>