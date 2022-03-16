<?php
    require __DIR__ . '/header.php'
?>

    <!-- Begin Page Content -->
    <div class="container-fluid" style="width:100%;">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Update</a>
        </div>
                   <!-- Product Filter -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Add Product</h5>
                                    <p>Please select the correct category for your products</p>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" >Product Name</span>
                                                </div>
                                                <input type="text" class="form-control" name="keyword" placeholder="Enter ..." aria-label="SearchKeyword">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6" style="padding-bottom: .625rem;">
                                            <div class="input-group mb-3">
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <a class="dropdown-item" href="#">Action</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                    </li>
              
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-10 col-lg-8 col-sm-4" style="padding-bottom: .625rem;">
                                            
                                        </div>
                                        <div class="col-xl-1 col-lg-2 col-sm-4" style="padding-bottom: .625rem;">
                                            <button type="button" class="btn btn-primary">Search</button>
                                        </div>
                                        <div class="col-xl-1 col-lg-2 col-sm-4" style="padding-bottom: .625rem;">
                                            <button type="button" class="btn btn-outline-dark">Reset</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
    <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>