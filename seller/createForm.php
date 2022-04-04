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

<?php
    //--------------Add new form element------------------------
    if(isset($_POST["addFormElementSubmit"])){
        $fieldName = mysqli_real_escape_string($conn, SanitizeString($_POST["fieldName"]));
        $fieldType = mysqli_real_escape_string($conn, SanitizeString($_POST["formElementSelect"]));
        $fieldOption = mysqli_real_escape_string($conn, SanitizeString($_POST["optionForList"]));
        $checkRequire = mysqli_real_escape_string($conn, $_POST['requiredCheck'] ? "required" : "optional");
        $eventID = 1;//$_SESSION['event']
        
        $sql = "INSERT INTO `formElement`(`event_id`, `field_name`, `element_type`, `selection`, `required`) VALUES (?,?,?,?,?)";
            if ($stmt = mysqli_prepare($conn,$sql)){
                if(false===$stmt){
                    die('Error with prepare: ') . htmlspecialchars($mysqli->error);
                }
                $bp = mysqli_stmt_bind_param($stmt,"issss",$eventID,$fieldName,$fieldType,$fieldOption,$checkRequire);
                if(false===$bp){
                    die('Error with bind_param: ') . htmlspecialchars($stmt->error);
                }
                $bp = mysqli_stmt_execute($stmt);
                if ( false===$bp ) {
                    die('Error with execute: ') . htmlspecialchars($stmt->error);
                }
                    if(mysqli_stmt_affected_rows($stmt) == 1){
                        echo "<script>alert('Success!!!!!');</script>";
                        //Add $_SESSION['eventID'] = "";
                        //Add Redirect to next page
                    }
                    else{
                        $error = mysqli_stmt_error($stmt);
                        echo "<script>alert($error);</script>";
                    }		
                    mysqli_stmt_close($stmt);
            }
          }
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

        <!-- Add New Form Element Modal -->
        <!-- <div class="modal fade" role="dialog" tabindex="-1" id="formElement_modal">
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
                                    <div class="col-sm-6"><select class="form-select" id="formElementSelection">
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
                                    <div class="col-sm-12"><input class="form-control" type="text" placeholder="Option (Separate selection with comma (,)" name="optionForList" id="optionInput"></div>
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
        </div> -->

        <!-- Update Field Modal -->
        <!-- <div class="modal fade" role="dialog" tabindex="-1" id="updateField_modal">
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
                                    <div class="col-sm-6"><select class="form-select" name="updateElementType" id="updateFormElementSelection">
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
                                    <div class="col-sm-12"><input class="form-control" type="text" placeholder="Option (Separate selection with comma (,)" name="updateOptionForList" id="updateOptionInput"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit" style="background: rgb(163, 31, 55);" name="updateFieldBtn">Update</button></div>
                </div>
            </div>
        </div> -->

        <!-- Edit Form Element Modal -->
        <!-- <div class="modal fade" role="dialog" tabindex="-1" id="editFormElement_modal">
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
                                    <div class="col-sm-6">
                                        <select class="form-select" name="newElementType" id="editFormElementSelection">
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
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" placeholder="Option (Separate selection with comma (,)" name="newOptionForList" id="editOptionInput">
                                    </div>
                                </div>
                                <button class="btn btn-outline-primary float-end" type="submit" style="margin-top: 13px;" name="newAddFormElement">Add Field</button>
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
                                        <?php
                                            $sql = "SELECT * FROM `registrationForm` WHERE `event_id` = {$_SESSION['eventID']}";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {

                                                    echo("
                                                       <tr>
                                                        <td>".$row['form_id']."</td>
                                                        <td>".$row['form_name']."</td>
                                                        <td><button class=\"btn btn-light btn-sm selectBtn\" type=\"button\" data-bs-toggle=\"modal\" data-bs-target=\"#editFormElement_modal\" title=\"Edit\" id=\"".$row['form_id']."\"><i class=\"fa fa-edit\"></i></button></td>
                                                        </tr>
                                                    ");
                                                }
                                            }

                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button" style="background: rgb(163, 31, 55);">Done</button></div>
                </div>
            </div>
        </div> -->


        <form>
        <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <div>
                    <div class="row">
                        <div class="col-sm-3">
                            <h2>Form</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6"><input class="form-control" type="text" placeholder="Field Name" name="fieldName"></div>
                    <div class="col-6"><select class="form-select" id="formElementSelection" name="formElementSelect">
                            <option value="text" selected="">text</option>
                            <option value="date">date</option>
                            <option value="tel">Phone Number</option>
                            <option value="number">number</option>
                            <option value="email">email</option>
                            <option value="select">Option</option>
                        </select></div>
                </div>
                <div class="form-check"><input class="form-check-input" type="checkbox" id="requireCheck" name="requiredCheck"><label class="form-check-label" for="formCheck-4">Required Field</label></div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-10"><input class="form-control" type="text" placeholder="Option (Separate selection with comma (,) )" name="optionForList" id="optionInput" style="display:none;"></div>
                    <div class="col-2"><button class="btn btn-primary" type="submit" name="addFormElementSubmit">Add Field</button></div>
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
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM `registrationForm` WHERE `event_id` = {$_SESSION['eventID']}";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {

                                    echo("
                                       <tr>
                                        <td>".$row['form_id']."</td>
                                        <td>".$row['form_name']."</td>
                                        <td><button class=\"btn btn-light btn-sm selectBtn\" type=\"button\" data-bs-toggle=\"modal\" data-bs-target=\"#editFormElement_modal\" title=\"Edit\" id=\"".$row['form_id']."\"><i class=\"fa fa-edit\"></i></button></td>
                                        </tr>
                                    ");
                                }
                            }

                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <div style="margin-top: 61px;text-align: center;margin-bottom: 61px;">
                <div class="btn-group" role="group"><button class="btn btn-secondary" type="button" style="margin-left: 5px;margin-right: 5px;">Back</button>
                <button class="btn btn-primary" type="button" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);">Submit</button></div>
            </div>
        </form>
    </div>

<!-- Below template -->
</div>
    <!-- /.container-fluid -->

    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/createForm.js"></script>
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