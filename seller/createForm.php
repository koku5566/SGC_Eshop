<?php
    require __DIR__ . '/header.php'
?>

<?php
	// if($_SESSION['login'] == false)
	// {
	// 	echo "<script>alert('Login to Continue');
	// 		window.location.href='login.php';</script>";
    // }

    // if($_SESSION['eventID'] == null)
    // {
    //     echo "<script>
 	// 	window.location.href='https://eshop.sgcprototype2.com/seller/createEvent.php';</script>";
    // }
?>

<title>Create Form</title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/event.css">

<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<!-- Select datatable CSS-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

<!-- Select datatable JS-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
    <!-- Above template -->

    <h1 style="margin-top: 50px;">Form Creation for Participants</h1>
    <div class="d-lg-block d-xl-block d-xxl-block" style="margin-top: 30px;">
        <div class="modal fade" role="dialog" tabindex="-1" id="formElement_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Element</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div style="margin-bottom: 20px;height: 179px;" name="elementType">
                                <h5 id="formHeading">Form</h5>
                                <div class="row">
                                    <div class="col-sm-6"><input class="form-control" type="text" placeholder="Field Name" name="fieldName"></div>
                                    <div class="col-sm-6"><select class="form-select">
                                            <option value="text" selected="">text</option>
                                            <option value="date">date</option>
                                            <option value="tel">Phone Number</option>
                                            <option value="number">number</option>
                                            <option value="email">email</option>
                                            <option value="select">Option</option>
                                        </select></div>
                                </div>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1" name="requiredCheck"><label class="form-check-label" for="formCheck-1">Required Field</label></div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-sm-12"><input class="form-control" type="text" placeholder="Option (Separate selection with comma (,)" name="optionForList"></div>
                                </div><button class="btn btn-outline-primary float-end" type="submit" style="margin-top: 13px;" name="addFormElement">Add Field</button>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Field</th>
                                                <th>Type</th>
                                                <th>Required</th>
                                                <th>Option</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Cell 1</td>
                                                <td>Text</td>
                                                <td>Cell 2</td>
                                                <td>Cell 2</td>
                                            </tr>
                                            <tr>
                                                <td>Cell 3</td>
                                                <td>Cell 4</td>
                                                <td>Text</td>
                                                <td>Cell 2</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button" style="background: rgb(163, 31, 55);">Done</button></div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="updateField_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Element</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div style="margin-bottom: 20px;height: 179px;" name="elementType">
                                <h5 id="updateformHeading">Form</h5>
                                <div class="row">
                                    <div class="col-sm-6"><input class="form-control" type="text" placeholder="Field Name" name="updateFieldName"></div>
                                    <div class="col-sm-6"><select class="form-select" name="updateElementType">
                                            <option value="text" selected="">text</option>
                                            <option value="date">date</option>
                                            <option value="tel">Phone Number</option>
                                            <option value="number">number</option>
                                            <option value="email">email</option>
                                            <option value="select">Option</option>
                                        </select></div>
                                </div>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2" name="updateRequiredCheck"><label class="form-check-label" for="formCheck-2">Required Field</label></div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-sm-12"><input class="form-control" type="text" placeholder="Option (Separate selection with comma (,)" name="updateOptionForList"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit" style="background: rgb(163, 31, 55);" name="updateFieldBtn">Update</button></div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="editFormElement_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Form Element</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div style="margin-bottom: 20px;height: 179px;" name="elementType">
                                <h5 id="EditFormHeading">Form</h5>
                                <div class="row">
                                    <div class="col-sm-6"><input class="form-control" type="text" placeholder="Field Name" name="newFieldName"></div>
                                    <div class="col-sm-6"><select class="form-select" name="newElementType">
                                            <option value="text" selected="">text</option>
                                            <option value="date">date</option>
                                            <option value="tel">Phone Number</option>
                                            <option value="number">number</option>
                                            <option value="email">email</option>
                                            <option value="select">Option</option>
                                        </select></div>
                                </div>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-3" name="newRequiredCheck"><label class="form-check-label" for="formCheck-3">Required Field</label></div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-sm-12"><input class="form-control" type="text" placeholder="Option (Separate selection with comma (,)" name="newOptionForList"></div>
                                </div><button class="btn btn-outline-primary float-end" type="submit" style="margin-top: 13px;" name="newAddFormElement">Add Field</button>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Field</th>
                                                <th>Type</th>
                                                <th>Required</th>
                                                <th>Option</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Cell 1</td>
                                                <td>Text</td>
                                                <td>Cell 2</td>
                                                <td>Cell 2</td>
                                            </tr>
                                            <tr>
                                                <td>Cell 3</td>
                                                <td>Cell 4</td>
                                                <td>Text</td>
                                                <td>Cell 2</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button" style="background: rgb(163, 31, 55);">Done</button></div>
                </div>
            </div>
        </div>
        <form>
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <div>
                    <div class="row">
                        <div class="col-sm-3">
                            <h2>Form</h2>
                        </div>
                        <div class="col-sm-2"><button class="btn btn-primary" id="addFormBtn" type="button" style="background: rgb(163, 31, 55);width: 128.938px;height: 44px;" data-bs-toggle="modal" data-bs-target="#formElement_modal">Add Form</button></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Form ID</th>
                                <th>Form Name</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Text</td>
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
            </section>
            <div style="margin-top: 61px;text-align: center;margin-bottom: 61px;">
                <div class="btn-group" role="group"><button class="btn btn-secondary" type="button" style="margin-left: 5px;margin-right: 5px;">Back</button><button class="btn btn-primary" type="submit" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);">Submit</button></div>
            </div>
        </form>
    </div>

<!-- Below template -->
</div>
    <!-- /.container-fluid -->

    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/addTicketType.js"></script>
    <script src='../tinymce/js/tinymce/tinymce.min.js'></script>
    <!-- <script>
        tinymce.init({
        selector: '#eTncEditor'
        });
        tinymce.init({
        selector: '#eDesceditor'
        });
    </script> -->

<?php
    require __DIR__ . '/footer.php'
?>