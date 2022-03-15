<?php
    require __DIR__ . '/header.php'
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Details</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Update</a>
    </div>


                   <!-- List All Product -->
                    <div class="row">
                        <!--Product List -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Basic Information</h5>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <select class="form-select" aria-label="SearchBy">
                                                        <option selected value="name">Product Name</option>
                                                        <option value="mainSku">Main Product SKU</option>
                                                        <option value="sku">Product SKU</option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Enter ..." aria-label="SearchKeyword">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" >Category</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Enter ..." aria-label="Category">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <button type="button" class="btn btn-primary">Search</button>
                                        <button type="button" class="btn btn-outline-dark">Reset</button>
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