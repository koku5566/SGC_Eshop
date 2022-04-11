<?php
    require __DIR__ . '/header.php'

?>
<?php
//session_start();
//include('mysqli_connect.php');
//get orders
//if(isset($_SESSION['login'])){

//$user_id = $_SESSION['user_id'];
//$stmt_2 = $conn->prepare("SELECT myOrder.order_id, product.product_name, product.product_cover_picture, product.product_price, product.product_variation, orderDetails.quantity, orderDetails.amount, shopProfile.shop_name FROM myOrder JOIN orderDetails ON myOrder.order_id = orderDetails.order_id JOIN product ON orderDetails.product_id = product.id JOIN shopProfile ON product.shop_id = shopProfile.shop_id WHERE user_id = ?");
//$stmt_2 = $conn->prepare("SELECT * from myOrder WHERE user_id = ?");
//$stmt_2->bind_param('i', $user_id);
//$stmt_2->execute();

//$orders = $stmt_2->get_result();

//}
$sql_2 = "SELECT
myOrder.order_id,
myOrder.order_status,
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
JOIN shopProfile ON product.shop_id = shopProfile.shop_id

";
$stmt_2 = $conn->prepare($sql_2);
$stmt_2->execute();
$orders = $stmt_2->get_result();


?>


                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
                    <!---GET ORDER----->
                    <h1 style="text-align:center; color: red ;">PURCHASE HISTORY</h1>
                    <a href="index.php" style="font-size:20px;">BACK</a>
                    <section id="orders" class="order container my-5 py-3 ">
                        <div class="container mt-2">
                            <h2 class="font-weight-bold text-center">YOUR ORDERS</h2>
                            <hr class="mx-auto">
                        </div>
                        <?php while($row = $orders ->fetch_assoc()){ ?>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                            <div class="col md-auto text-start"><span><strong><?php echo $row['shop_name']?></strong></span>
                                            </div>
                                            <div class="col md-auto text-end" style="text-align:right;"><span><strong>
                                             OrderID:<?php echo $row['order_id']?></strong></span>
                                            </div>
                                        </div>
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
                                                
                                                <tr class="clickable "
                                                          onclick="location.href='orderDetails.php'" style="cursor:pointer;">
                                                    <td><?php echo $row['product_cover_picture']?></td>
                                                    <td><?php echo $row['product_name']?></td>
                                                    <td><?php echo $row['product_variation']?></td>
                                                    <td><?php echo $row['quantity']?></td>
                                                    <td><?php echo $row['product_price']?></td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                             <button type="button" class="btn btn-primary">Order Status</button>
                                             <button type="button" class="btn btn-primary" style="margin-left:10px;">Order Again</button>
                                             <button type="button" class="btn btn-primary" style="margin-left:10px;">Ratings</button>
                                             <span style="margin-left:20%;">Total</span>
                                             <span style="margin-left:18%;" ><?php echo $row['price']?></span>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <br>
                        <?php }?>
                        
                    </section>

                    




                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
<!----
   --->