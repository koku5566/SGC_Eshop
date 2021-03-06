<?php
    require __DIR__ . '/header.php';

    if(!isset($_SESSION)){
        session_start();
     }
     if(!isset($_SESSION['id']))
     {
           $_SESSION['id'] = "";
     }
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
                            shopProfile.shop_id,
                            shopProfile.shop_profile_image

                            FROM voucher
                            JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id
                            JOIN product ON productVoucher.product_id = product.product_id
                            JOIN shopProfile ON product.shop_id = shopProfile.shop_id
                            GROUP BY voucher.voucher_id, shopProfile.shop_name, shopProfile.shop_profile_image, shopProfile.shop_id
                            "; 

                            $stmt = $conn->prepare($sql_voucher);
                            $stmt->execute();
                            $result = $stmt->get_result();
                                                
                                                
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
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                        <!-- <input type="hidden " name="uid" value="<?php echo $_SESSION['uid'];?>"> -->
                                        <input type="hidden" name="voucher_id" value="<?php echo $row['voucher_id']?>">
                                        <button type="submit" name="claim" class="btn btn-warning btn-sm" style="float: right" id="claimVoucherBtn">CLAIM</button>
                                    </form>
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

                                            $voucher_id = $row['voucher_id'];

                                            $sql_pn=
                                            "SELECT
                                            product.product_name,
                                            voucher.voucher_id
                                                                
                                            FROM voucher
                                            JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id
                                            JOIN product ON productVoucher.product_id = product.product_id
                                            JOIN shopProfile ON product.shop_id = shopProfile.shop_id
                                            WHERE voucher.voucher_id = $voucher_id
                                            ";
                
                                            $sm = $conn->prepare($sql_pn);
                                            $sm->execute();
                                            $res = $sm->get_result();

                                                while ($r = $res->fetch_assoc()) {
                                            ?>

                                            <p><?php echo $r['product_name'];?></p>

                                            <?php 
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
                                } else{
                                    ;
                                }
                        }?>
                        
                    </div>
                </div>
            </div>
        <br>
        </div>
        <br>
    </div>

    <?php 

    if(isset($_POST['claim'])){

        if (!isset($_SESSION['login']) || !isset($_SESSION['uid']) ){
            ?>
                <script type="text/javascript">
                    window.location.href = window.location.origin + "/login.php";
                </script>
            <?php
            exit;
        }
        else{

            $uid = $_SESSION['uid'];
            $voucher_id = $_POST['voucher_id'];

            $sqlc = "INSERT INTO voucherRedemption (voucher_id, user_id)
                    VALUES ('$voucher_id','$uid')";
                    
            if($conn->query($sqlc))
            {
                echo '<script>alert("Voucher claimed succesfully.")</script>';
            }
            else{
                echo '<script>alert("Voucher claimed failed. Login to claimed voucher")</script>';
            }
        }

    }

    ?>


<?php
    require __DIR__ . '/footer.php'
?>