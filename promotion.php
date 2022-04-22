<?php
    require __DIR__ . '/header.php'
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<style>
   #voucherlogo{
   height: 100px;
   width: 100px;
   display: flex;
   justify-content: center;
   overflow: hidden
    }

    #voucherlogo img {
    width: 100px
    }

    img {
    width: 100px
    }

    #vouchercard{
    width: 11.5rem;
    height: 25rem;
    }

    #termsvouchercard{
    width: 11.5rem;
    height: 20rem;
    }

    .tnccontainer{
    border-radius: 10px;
    border: dashed;
    }

    .selectvoucher{
    width: 40px;
    height: 28px;
    }

    /* -------------------- Category Scrollbar----------------------- */

    /* width */
    ::-webkit-scrollbar {
    width: 5px;
    height: 5px;
    }

    .scrolling-wrapper{
        overflow-x: auto;
    }

    .scrolling-wrapper2{
        overflow-y: auto;
        max-height: 580px;
        min-width: 80%;
    }
</style>

    <!-- Begin Page Content -->
    <div class="container-fluid" style="width:80%;">
        <!-- Slideshow -->
        <div class="row">
            <div class="justify-content-center">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block w-100" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="Third slide">
                            </div>
                        </div>
                            <a class="carousel-control-prev" style="z-index:0;" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" style="z-index:0;" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- Voucher -->
        <div class="row">
            <div class = "container-fluid m-5">
                <div class = "d-flex justify-content-center">
                    <div class="scrolling-wrapper row flex-row flex-nowrap mt-3 pb-4 pt-2 mr-2">
                        <?php 
                                                
                            $sql_voucher =
                            "SELECT 
                            voucher.voucher_id,
                            voucher.voucher_code,
                            voucher.voucher_type,
                            voucher.discount_amount,
                            voucher.voucher_display,
                            voucher.voucher_limit,
                            voucher.voucher_startdate,
                            voucher.voucher_expired,
                            voucher.voucher_details,
                            shopProfile.shop_name,
                            shopProfile.shop_profile_image

                            FROM voucher
                            JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id
                            JOIN product ON productVoucher.product_id = product.product_id
                            JOIN shopProfile ON product.shop_id = shopProfile.shop_id
                            GROUP BY voucher.voucher_id, shopProfile.shop_name, shopProfile.shop_profile_image
                            "; 

                            $stmt = $conn->prepare($sql_voucher);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $sql_pn=
                            "SELECT
                            product.product_name,
                            voucher.voucher_id
                                                
                            FROM voucher
                            JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id
                            JOIN product ON productVoucher.product_id = product.product_id
                            JOIN shopProfile ON product.shop_id = shopProfile.shop_id
                            ";

                            $sm = $conn->prepare($sql_pn);
                            $sm->execute();
                            $res = $sm->get_result();
                                                
                                                
                            while ($row = $result->fetch_assoc()) {
                                $td = date('y-m-d');
                                $expr = $row['voucher_expired'];
                                
                                $today = strtotime($td);
                                $expired = strtotime($expr);
                                
                                if($row['voucher_display'] > 0   && $row['voucher_limit'] > 0 && $expired > $today){
                            ?>

                        <div class="col-md-2 m-4">
                            <div class="card" id="vouchercard">
                                <div class="container">
                                    <img class="m-4" src="../img/shop_logo/<?php echo $row['shop_profile_image']; ?>" id="voucherlogo">
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title"><strong><?php echo $row['shop_name']; ?></strong></h6>
                                    <h5 class="card-subtitle text-muted"><?php echo $row['discount_amount']; ?> <?php echo $row['voucher_type']; ?> off</h5>
                                    <small>Used : <?php echo $row['voucher_startdate']; ?> ~ <?php echo $row['voucher_expired']; ?></small><br>
                                    <u>
                                        <a type="" class="" data-toggle="modal" data-target="#termsModal<?php echo $row['voucher_id']; ?>">
                                        T&C applied.
                                        </a>
                                    </u>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-warning btn-sm" style="float: right" data-toggle="modal" data-target="#alert">CLAIM</button>
                                </div>
                            </div>
                        </div>

                        <!-- Voucher Modal -->
                        <div class="modal fade" id="termsModal<?php echo $row['voucher_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="termsModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="termsModalLongTitle">Terms and Conditions.</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center">
                                            <div class="card m-2" id="termsvouchercard">
                                            <div class="container">
                                                <img class="mt-3" src="../img/shop_logo/<?php echo $row['shop_profile_image']; ?>" id="voucherlogo">
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title"><strong><?php echo $row['shop_name']; ?></strong></h6>
                                                <h5 class="card-subtitle text-muted"><?php echo $row['discount_amount']; ?> <?php echo $row['voucher_type']; ?> off</h5>
                                                <small>Used : <?php echo $row['voucher_startdate']; ?> ~ <?php echo $row['voucher_expired']; ?></small><br>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tnccontainer m-5 p-3">
                                        <div class="container">
                                            <strong>Product</strong>
                                            <?php 
                                                    while ($r = $res->fetch_assoc()) {
                                                        // $voucherid = $r['voucher_id'];
                                                        // $voucherid2 = $row['voucher_id'];
                                                        // for($i = 0; $i < count($voucherid2); $i++){
                                                        //     for($x = 0; $x < count($voucherid); $x++){
                                                                if($r['voucher_id'] == $row['voucher_id']){
                                            ?>
                                            <p><?php echo $r['product_name'];?>, </p>
                                            <?php 
                                            // }
                                                }
                                            }
                                        }?>
                                        </div>
                                        <div class="container">
                                            <strong>More Details</strong>
                                            <p> <?php echo $row['voucher_details']; ?> </p>
                                        </div>
                                        <div class="container">
                                            <strong>Usage Period</strong>
                                            <p><?php echo $row['voucher_startdate']; ?> ~ <?php echo $row['voucher_expired']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            <?php 
                                // } else{
                                //     ;
                                //}
                        }?>
                        
                    </div>
                </div>
            </div>
        <br>
        </div>
        <br>
    </div>
    


<?php
    require __DIR__ . '/footer.php'
?>