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

    <h1 style="margin-right: 80px;margin-left: 80px;margin-top: 50px;">Create New Event</h1>
    <div style="margin-left: 80px;margin-right: 80px;margin-top: 30px;">
        <div class="modal fade modal-dialog-scrollable" role="dialog" tabindex="-1" id="variationForm_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Ticket Type</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div style="margin-bottom: 20px;">
                                <h5>Ticket Name</h5><input class="form-control" type="text" placeholder="Ticket Name">
                            </div>
                            <div style="margin-bottom: 20px;">
                                <h5>Capacity</h5><input class="form-control" type="text" placeholder="Number of ticket can be sold">
                            </div>
                            <div style="margin-bottom: 20px;height: 132px;">
                                <h5>Variation</h5>
                                <div class="row">
                                    <div class="col-sm-4"><input class="form-control" type="text" placeholder="Variation Name"></div>
                                    <div class="col-sm-4"><input class="form-control" type="number" placeholder="Quantity"></div>
                                    <div class="col-sm-4"><input class="form-control" type="number" placeholder="Price"></div>
                                </div><button class="btn btn-primary float-end" type="button" style="margin-top: 13px;">Add Variation</button>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qtt</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Cell 1</td>
                                                <td>Text</td>
                                                <td>Cell 2</td>
                                            </tr>
                                            <tr>
                                                <td>Cell 3</td>
                                                <td>Cell 4</td>
                                                <td>Text</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="margin-bottom: 20px;height: 179px;">
                                <h5>Form</h5>
                                <div class="row">
                                    <div class="col-sm-6"><input class="form-control" type="text" placeholder="Field Name"></div>
                                    <div class="col-sm-6"><select class="form-select">
                                            <optgroup label="This is a group">
                                                <option value="12" selected="">This is item 1</option>
                                                <option value="13">This is item 2</option>
                                                <option value="14">This is item 3</option>
                                            </optgroup>
                                        </select></div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-sm-12"><input class="form-control" type="text" placeholder="Option (Separate selection with comma (,)"></div>
                                </div><button class="btn btn-primary float-end" type="button" style="margin-top: 13px;">Add Field</button>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Field</th>
                                                <th>Type</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Cell 1</td>
                                                <td>Text</td>
                                                <td>Cell 2</td>
                                            </tr>
                                            <tr>
                                                <td>Cell 3</td>
                                                <td>Cell 4</td>
                                                <td>Text</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button" style="background: rgb(163, 31, 55);">Save</button></div>
                </div>
            </div>
        </div>
        <form>
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <h2>Cover Image<input class="form-control" type="file" id="coverImg" style="margin-top: 10px;"></h2>
            </section>
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <h2>Event Details</h2>
                <h3 style="margin-top: 30px;">Event Title<input class="form-control" type="text" placeholder="Event Title" style="margin-top: 10px;"></h3>
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
                        <div class="col-sm-5"><input class="form-control" type="date"></div>
                        <div class="col-sm-2">
                            <h5 style="text-align: center;margin-top: 6px;">To</h5>
                        </div>
                        <div class="col-sm-5"><input class="form-control" type="date"></div>
                    </div>
                </div>
                <div>
                    <h3 style="margin-top: 30px;width: 100%;">Event Time</h3>
                    <div class="row">
                        <div class="col-sm-5"><input class="form-control" type="time"></div>
                        <div class="col-sm-2">
                            <h5 style="text-align: center;margin-top: 6px;">To</h5>
                        </div>
                        <div class="col-sm-5"><input class="form-control" type="time"></div>
                    </div>
                </div>
                <div style="margin-top: 30px;">
                    <h3>Description</h3>
                    <div>
                        <div id="toolbar_container" class="sun-editor"></div><textarea class="form-control" id="editor" placeholder="Edit your description here to make your event looks more fun"></textarea>
                    </div>
                </div>
                <div style="margin-top: 30px;">
                    <h3>Category</h3><input class="form-control" type="text">
                </div>
                <div>
                    <div class="row">
                        <div class="col-sm-2">
                            <h3 style="margin-top: 30px;width: 100%;">Location</h3>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-check" style="width: 100%;margin-top: 44px;"><input class="form-check-input" type="checkbox" id="oneDayEvent_check-1"><label class="form-check-label" for="oneDayEvent_check-1"><strong>Online Event</strong></label></div>
                        </div>
                    </div><input class="form-control" type="text">
                </div>
            </section>
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <div>
                    <h2>Terms and Conditions</h2>
                    <div>
                        <div id="toolbar_container-1" class="sun-editor"></div><textarea class="form-control" id="editor-1" placeholder="Insert placeholder text in sunEditorInit.js"></textarea>
                    </div>
                </div>
            </section>
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <div>
                    <div class="row">
                        <div class="col-sm-3">
                            <h2>Payment and Ticket</h2>
                        </div>
                        <div class="col-sm-2"><button class="btn btn-primary" id="addTicketBtn" type="button" style="background: rgb(163, 31, 55);width: 128.938px;height: 44px;" data-bs-toggle="modal" data-bs-target="#variationForm_modal">Add Ticket</button></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ticket Type</th>
                                <th>Capacity</th>
                                <th>Variant</th>
                                <th>Price</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Text</td>
                                <td>Text</td>
                                <td>Cell 1</td>
                                <td>Cell 2</td>
                            </tr>
                            <tr>
                                <td>Cell 3</td>
                                <td>Cell 4</td>
                                <td>Text</td>
                                <td>Text</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <div style="margin-top: 61px;text-align: center; margin-bottom: 61px;">
                <div class="btn-group" role="group"><button class="btn btn-secondary" type="button" style="margin-left: 5px;margin-right: 5px;">Back</button><button class="btn btn-primary" type="submit" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);">Submit</button></div>
            </div>
        </form>
    </div>

    <!-- Below template -->
    </div>
    <!-- /.container-fluid -->

    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
    <script src="../js/Suneditor-WYSIWYG.js"></script>

<?php
    require __DIR__ . '/footer.php'
?>