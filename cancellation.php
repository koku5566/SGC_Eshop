<?php
    require __DIR__ . '/header.php'
?>
<?php
$sql_cancel = "SELECT
myOrder.order_id,
myOrder.order_status,
product.product_name,
product.product_cover_picture,
product.product_price,
product.product_variation,
orderDetails.quantity,
orderDetails.amount,
shopProfile.shop_name,
cancellation.cancellation_id

FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN product ON orderDetails.product_id = product.id
JOIN shopProfile ON product.shop_id = shopProfile.shop_id   
JOIN cancellation ON myOrder.cancellation_id = cancellation.cancellation_id

";
$stmt_cancel = $conn->prepare($sql_cancel);
$stmt_cancel->execute();
$cancelOrders = $stmt_cancel->get_result();


?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
                         <!---CANCEL ORDER----->
                    <h1 style="text-align:center; color: red ;">CANCELLATION</h1>
                    <a href="index.php" style="font-size:20px;">BACK</a>
                    <section id="orders" class="order container my-5 py-3 ">
                        <div class="container mt-2">
                            <h2 class="font-weight-bold text-center">ARE YOU SURE YOU WANT TO CANCEL YOUR ORDER?</h2>
                            <hr class="mx-auto">
                        </div>
                        <!--CANCELLATION START HERE-->
                        <?php while($row = $cancelOrders ->fetch_assoc()){ ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><?php echo $row['shop_name']?></h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product(s)</th>
                                                <th>Product Name</th>
                                                <th>Product Variation</th>
                                                <th>Product Quantity</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>Tell us why do you want to cancel the order</p>
                                    <form action="cancellationConfirm.php" method="POST">
                                    <div class="form-check" >
                                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Wrong Item">
                                      <label class="form-check-label" for="flexRadioDefault1" style="font-size:19px;" >
                                        Wrong Item Choosen
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"  value="Double Payment">
                                      <label class="form-check-label" for="flexRadioDefault2" style="font-size:19px;">
                                        Double Payment
                                      </label>
                                    </div>
                                    <div class="form-check" >
                                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3"  value="Regrets">
                                      <label class="form-check-label" for="flexRadioDefault3" style="font-size:19px;">
                                        Regrets
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4"value="Change Color" >
                                      <label class="form-check-label" for="flexRadioDefault4" style="font-size:19px;">
                                        Change color
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5" value="Others">
                                      <label class="form-check-label" for="flexRadioDefault5" style="font-size:19px;" >
                                        Others
                                      </label>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary " style="" name="save_cancellation">Confirm</button>
                            </div>
                            </form>
                        </div> <?php }?>

                 </div>

                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
