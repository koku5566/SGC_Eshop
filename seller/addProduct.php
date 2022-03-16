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
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" >Product Name</span>
                                                </div>
                                                <input type="text" pattern="{20,100}" class="form-control" name="keyword" placeholder="Enter ..." aria-label="SearchKeyword" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6" style="padding-bottom: .625rem;">
                                            <?php
                                            
                                            $sql = "SELECT COUNT(DISTINCT A.product_id) AS total_product FROM product AS A";
                                            $result = mysqli_query($conn, $sql);
                                
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $total = (int) $row["total_product"];
                                                    $percent = $total/10;
                                                    $uploadAvailable = 1000 - $total;
                                                    echo("
                                                        <h5>$total Products</h5>
                                                    
                                                        <div class=\"progress\" style=\"height:0.3rem;\">
                                                            <div class=\"progress-bar\" role=\"progressbar\" style=\"width: $percent%\" aria-valuenow=\"$percent\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                                        </div>
                                                        <p data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Number of upload product available = 1000 - Number of current product\">You can still upload $uploadAvailable products</p>
                                                                
                                                    ");
                                                }
                                            }

                                            

                                            echo("
                                            <ul class=\"scroll-item\" aria-labelledby=\"SelectMainCategory\">
                                                <li class=\"category-item selected\">
                                                    <p class=\"text-overflow\">
                                                    $categoryName
                                                    </p> 
                                                <div class=\"category-item-right\">
                                                    <i class=\"fa fa-angle-right\" aria-hidden=\"true\" style=\"display:$display;\"></i>
                                                </div>
                                                </li>
                                            </ul>
                                            ")
                                            ?>
                                            
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

<style>
    .text-overflow {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .scroll-tem{
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        height: 320px;
        border-left: 1px solid #fff;
        overflow-y: scroll;
    }

    .category-selector .category-item {
        -webkit-box-pack:justify;
        -ms-flex-pack:justify;
        justify-content:space-between;
        line-height:32px;
        padding:0 16px;
        color:#333
    }
    .category-selector .category-item-right,
    .category-selector .category-item {
        display:-webkit-box;
        display:-ms-flexbox;
        display:flex;
        -webkit-box-align:center;
        -ms-flex-align:center;
        align-items:center
    }
    .category-selector .category-item-right {
        -ms-flex-negative:0;
        flex-shrink:0
    }
    .category-selector .category-item p {
        margin:0
    }
    .category-selector .category-item:hover {
        cursor:pointer;
        background:#f6f6f6
    }
    .category-selector .category-item.selected {
        font-weight:500;
        font-weight:var(--font-weight)
    }
    .category-selector .category-item.selected:not(.is-prohibit) .icon-next,
    .category-selector .category-item.selected:not(.is-prohibit) {
        color:#ee4d2d
    }
    .category-selector .category-item .not-allow-tag+.icon-next {
        margin-left:4px
    }
</style>

<?php
    require __DIR__ . '/footer.php'
?>