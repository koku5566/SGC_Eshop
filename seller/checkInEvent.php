<?php
require __DIR__ . '/header.php'
?>

<?php
if(isset($_GET['eventCheckin']))
{
    $_SESSION['eventCheckin'] = $_GET['eventCheckin'];
}

?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">
    <!-- Above Template -->
    <title>Event Dashboard</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/CheckOutPage-V10.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Select datatable CSS-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

    <!-- Select datatable JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <div class="card">
        <div class="card-header">
            <h2 style="text-align: center;"><i class="fa fa-calendar-check-o"></i>Check in for eventName</h2>
        </div>
        <div class="card-body">
            <form>
                <div class="input-group"><input class="form-control" type="text">
                    <div class="input-group-append"><button class="btn btn-primary" type="button" style="background: rgb(163, 31, 55);"><i class="fa fa-search"></i></button></div>
                </div>
            </form>
        </div>
    </div>
    <div class="card" style="margin-top: 30px;">
        <div class="card-header">
            <h5 class="mb-0" style="text-align: center;">Participant Details</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Ticket Name</th>
                            <th>Ticket Generate Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cell 1</td>
                            <td>Cell 2</td>
                            <td>Cell 2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="text-align: center;"><button class="btn btn-primary" type="button" style="background: rgb(163, 31, 55);">Check in</button></div>
        </div>
    </div>




    <!-- Below Template -->
</div>
<!-- /.container-fluid -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../js/eventDetails.js"></script>

<?php
require __DIR__ . '/footer.php'
?>