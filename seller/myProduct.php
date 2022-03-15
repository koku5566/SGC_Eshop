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
                                    <h5 class="m-0 font-weight-bold text-primary">Filter Product</h5>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-sm-12" style="padding-bottom: .625rem;">
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
                                        <div class="col-xl-6 col-lg-6 col-sm-12" style="padding-bottom: .625rem;">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" >Category</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Enter ..." aria-label="Category">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-10 col-lg-8 col-sm-4" style="padding-bottom: .625rem;">
                                            <button type="button" class="btn btn-primary">Search</button>
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

                    <!-- List All Product -->
                    <div class="row">
                        <!--Product List -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Filter Product</h5>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                            <nav id="myTab" class="nav nav-tabs" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">All</a>
                                                <a class="nav-item nav-link" id="nav-published-tab" data-toggle="tab" href="#nav-published" role="tab" aria-controls="nav-published" aria-selected="false">Published</a>
                                                <a class="nav-item nav-link" id="nav-sold-tab" data-toggle="tab" href="#nav-sold" role="tab" aria-controls="nav-sold" aria-selected="false">Out of Stock</a>
                                                <a class="nav-item nav-link" id="nav-violation-tab" data-toggle="tab" href="#nav-violation" role="tab" aria-controls="nav-violation" aria-selected="false">Banned</a>
                                                <a class="nav-item nav-link" id="nav-unpublish-tab" data-toggle="tab" href="#nav-unpublish" role="tab" aria-controls="nav-unpublish" aria-selected="false">Unpublished</a>
                                            </nav>

                                            <div class="tab-content" id="nav-tabContent">
                                                 <!-- All Product -->
                                                <div class="tab-pane active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                                                    <!-- Header Bar -->
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-sm-6" style="padding-bottom: .625rem;">
                                                            <div>
                                                                <h5>10 Products
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <p data-bs-toggle="tooltip" data-bs-placement="bottom" title="Number of upload product available = 1000 - Number of current product">You can still upload 990 products</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                 <!-- Published -->
                                                <div class="tab-pane" id="nav-published" role="tabpanel" aria-labelledby="nav-published-tab">
                                                    type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                                </div>

                                                 <!-- Out of Stock -->
                                                <div class="tab-pane" id="nav-sold" role="tabpanel" aria-labelledby="nav-sold-tab">
                                                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                                </div>

                                                 <!-- Banned -->
                                                <div class="tab-pane" id="nav-violation" role="tabpanel" aria-labelledby="nav-violation-tab">
                                                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                                </div>

                                                 <!-- Unpublished -->
                                                <div class="tab-pane" id="nav-unpublish" role="tabpanel" aria-labelledby="nav-unpublish-tab">
                                                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>

</div>
<!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

    .nav-link{

    }

    .tab-pane.active {
    animation: slide-down 0.5s ease-out;
    }

    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>