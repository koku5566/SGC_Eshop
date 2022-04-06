<?php
    require __DIR__ . '/header.php'
?>

<?php 


$sql_2 = "SELECT
myOrder.order_id,
product.product_name,
product.product_cover_picture,
product.product_price,
product.product_variation,
orderDetails.quantity,
orderDetails.price,
shopProfile.shop_name

FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN product ON orderDetails.product_id = product.id
JOIN shopProfile ON product.shop_id = shopProfile.shop_id";
$stmt_2 = $conn->prepare($sql_2);
$stmt_2->execute();
$result_2 = $stmt_2->get_result();


?>

<div class="container-fluid" style="width:100%">
<h1 style="color: red;text-align: center;">Purchase History</h1>
    <button class="btn btn-primary" type="button" style="width: 89.5px;padding-left: 0px;margin-left: 0px;background: rgba(13,110,253,0);color: var(--bs-blue);border-style: none;border-color: var(--bs-body-bg);text-decoration: underline;">
    <i class="fa fa-long-arrow-left" style="padding-right: 9px;color: var(--bs-blue);background: rgba(255,255,255,0);">
    <a href="index.php">Back</a></i>
    </button>
    <div class="tab-content mb-4" >
   
        <div class="order-history-list-panel">
        </div>
        <div class="tab-panel">
        <?php 
        while ($row = $result_2->fetch_assoc()) {
        ?>
            <div class="card" style="text-align: justify;width: 60%;margin-left: 20%;">
                <div class="card-header">
                    <div class="row">
                        <div class="col md-auto text-start"><span><strong><?php echo $row['shop_name']?></strong></span>
                        </div>
                        <div class="col md-auto text-end" style="text-align:right;"><span><strong>
                         OrderID:7</strong></span>
                        </div>
                    </div>
                </div>
                <a href="viewOrder.php" class="card-body"  >
                    <div class="row">
                                        
                        <div class="col-1 image-container">
                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $row['product_cover_picture']?>" alt="<?php echo $row['product_name']?>">
                        </div>
                        <div class="col-3">Iphone 11 Pro Max & Free Gift
                        
                        </div>
                        <div class="col-2">x1
                        
                        </div>
                        <div class="col md-auto text-start offset-md-1">
                        Type 1
                        </div>
                        <div class="col md-auto text-end">RM4000.00</div>
                        </div>
                    
                </a>
                <div class="card-footer">
                    <ul class="list-group list-group-horizontal" style="list-style-type:none;">
                        <li class="">
                        <button type="button" class="btn btn-primary" ><a hrfe="purchaseShippingDetails.php">Order Status</a></button></li>

                        <li style="padding-left: 20px;">
                        <button type="button" class="btn btn-primary">Order Again</button></li>

                        <li style="padding-left: 20px;">
                        <button type="button" class="btn btn-primary"><a hrfe="">Rating</a></button></li>

                        <li style="padding-left:200px">Total</li>
                        <li style="padding-left:30%;">RM<?php echo $row['product_price']?></li>
                    </ul>
                  </div>     
                </div>
            </div>
            <br>
            <?php 
            }?>
    </div>
   




















<?php
    require __DIR__ . '/footer.php'
?>