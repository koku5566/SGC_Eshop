<?php
    require __DIR__ . '/header.php'
?>

    <!-- Begin Page Content -->
    <div class="container-fluid" style="width:100%;">
    <!-- Above Template -->
    <title>Event Dashboard</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/CheckOutPage-V10.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    
    <div style="margin-left: 80px;margin-right: 80px;height: 181.8px;">
        <div class="text-end" style="margin-top: 20px;"><button class="btn btn-primary" id="createEventBtn" type="button" style="background: rgb(163, 31, 55);width: 121.75px;height: 47px;">Create Event</button></div>
        <h4>Search</h4><input type="search" style="width: 100%;">
        <div>
            <div class="btn-group float-end" role="group" style="margin-top: 7px;"><button class="btn btn-primary" type="button" style="margin-right: 0px;margin-left: 10px;">Reset</button><button class="btn btn-primary" type="button" style="margin-right: 0px;margin-left: 10px;background: rgb(163, 31, 55);">Search</button></div>
        </div>
    </div>
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1">All</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">Up Coming</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-3">Past</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="tab-1">
                <div style="margin-left: 80px;margin-right: 80px;">
                    <div class="card" style="margin-top: 20px;">
                        <div class="card-body shadow">
                            <h4 class="card-title">Move IT! Malaysia Calories Burn Challenge</h4>
                            <h6 class="text-muted card-subtitle mb-2">Approved</h6>
                            <h5>Date: 14 Sep 2021 - 10 Oct 2021</h5>
                            <h5>Price: RM 20 - RM 180</h5><button class="btn btn-primary float-end" type="button" style="background: rgb(163, 31, 55);width: 164.5px;">Dashboard</button>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 20px;">
                        <div class="card-body shadow">
                            <h4 class="card-title">Future of Work</h4>
                            <h6 class="text-muted card-subtitle mb-2">Approved</h6>
                            <h5>Date: 14 Sep 2021 - 10 Oct 2021</h5>
                            <h5>Price: RM 20 - RM 180</h5><button class="btn btn-primary float-end" type="button" style="background: rgb(163, 31, 55);width: 164.5px;">Dashboard</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-2">
                <p>Content for tab 2.</p>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-3">
                <p>Content for tab 3.</p>
            </div>
        </div>
    </div>

    <!-- Below Template -->
    </div>
    <!-- /.container-fluid -->

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

<?php
    require __DIR__ . '/footer.php'
?>