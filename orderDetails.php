<?php
    require __DIR__ . '/header.php'
?>
<?php
if(isset($_POST['orderDetails_btn']) && isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    
    $stmt4 =$conn->prepare("SELECT * FROM myorder o JOIN orderdetails od ON od.order_id = o.order_id JOIN product p ON p.id = od.product_id WHERE od.order_id = ?");
    $stmt4->bind_param('i',$order_id);
    $stmt4->execute();
    $order_details = $stmt4->get_result();
}else{
    header('location: getOrder.php');
    exit;
}

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
                            <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                        $count=1;
                                        while($row = $order_details->fetch_assoc()){
                                        ?>
                                        <table class="table">
                                            <tr>
                                                <th colspan="3" align="left">Order Details (<?php echo $count++; ?>)</th>
                                            </tr>
                                            <tr>
                                                <td width="150">Delivery Method</td>
                                                <td width="20">:</td>
                                                <td><?php echo $row["delivery_method"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td><?php echo $row["order_status"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td>:</td>
                                                <td><?php echo $row["order_date"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Quantity</td>
                                                <td>:</td>
                                                <td><?php echo $row["quantity"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td>:</td>
                                                <td> RM <?php echo $row["price"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th colspan="3" align="left">Product Details</th>
                                            </tr>
                                            <tr>
                                                <td>SKU</td>
                                                <td>:</td>
                                                <td><?php echo $row["product_sku"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td>:</td>
                                                <td><?php echo $row["product_name"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>:</td>
                                                <td><?php echo $row["product_description"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Brand</td>
                                                <td>:</td>
                                                <td><?php echo $row["product_brand"]; ?></td>
                                            </tr>
                                        </table>
                                        <hr>
                                        <?php } ?>
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
