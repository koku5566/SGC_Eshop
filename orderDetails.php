<?php
    require __DIR__ . '/header.php'
?>
<?php
if(isset($_POST['orderDetails_btn']) && isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    
    $stmt4 =$conn->prepare("SELECT * FROM myOrder
    JOIN orderDetails  ON orderDetails.order_id = myOrder.order_id
    JOIN product ON product.product_id = orderDetails.product_id
    WHERE orderDetails.order_id  = ?");
    $stmt4->bind_param('i',$order_id);
    $stmt4->execute();
    $order_details = $stmt4->get_result();
}else{
    header('location: getOrder.php');
    exit;
}

if(isset($_GET["cancel"]) && isset($_GET["id"])){
    $conn->query("UPDATE myorder SET order_status = 'To Respond' WHERE order_id = ".$_GET["id"]);
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
                                                <th>Order ID : <?php echo $row['order_id']?></th>
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
                                                <th colspan="3" align="left">Product Details</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <img class="card-img-top img-thumbnail"
                                                    style="object-fit:contain;width:100%;height:100%"
                                                    src="/img/product/<?php echo $row['product_cover_picture']?>"
                                                    />
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Quantity</td>
                                                <td>:</td>
                                                <td><?php echo $row["quantity"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td>:</td>
                                                <td> RM <?php echo $row["amount"]; ?></td>
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
                                <div class="card-footer">
                                <a href="getOrder.php?cancel&id=<?php echo $row['order_id']?>" onclick="return confirm_click();"><button type="button" class="btn btn-primary">Cancel</button></a>
                                </div>
                    </section>
                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
