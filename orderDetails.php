<?php
    require __DIR__ . '/header.php'
?>
<?php
$order_id = $_GET['order_id'];



?>

<!-- Begin Page Content -->
    <div class="container-fluid" style="width:80%">
        <h1 style="text-align:center; color: red ;">Order Status/ Order Details</h1>
        <a href="getOrder.php" style="font-size:20px;">BACK</a>
        <section id="orders" class="order container my-5 py-3 ">
            <div class="container mt-2">
                <h2 class="font-weight-bold text-center">ORDER DETAILS</h2>
                <hr class="mx-auto">
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="order-list-panel">
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-5">Product</div>
                            <div class="col-2">Unit Price</div>
                            <div class="col-1">Quantity</div>
                            <div class="col-3">Total Price</div>
                        </div>
                    </div>
                </div>
              



                <div class="card-body">
                    <div class="col-1"></div>
                    <div class="col-5"></div>
                    <div class="col-2"></div>
                    <div class="col-1"></div>
                    <div class="col-3"></div>     
                </div>
                <div class="card-footer">
                <?php if($row['order_status'] =='Paid'){?>
                    <a class="btn btn-primary " style="margin-left:10px;"  href="purchaseShippingDetails.php?order_id=<?php echo $row['order_id'];?>">Cancel Order</a>
                    <?php } else{ ?>
                    <a class="btn btn-primary"style="margin-left:10px;" href="purchaseShippingDetails.php?order_id=<?php echo $row['order_id'];?>">Confirmed Order</a>
                    <?php }?>
                </div>
               
            </div>
          


        </section>
    </div>
                   
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
