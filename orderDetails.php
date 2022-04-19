<?php
    require __DIR__ . '/header.php'
?>
<?php
if(isset($_POST['orderDetails_btn']) && isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    
    $stmt4 =$conn->prepare("SELECT * FROM myOrder WHERE order_id = ?");
    $stmt_4 -> bind_param('i',$order_id);
    $stmt_4->execute();
    $order_details = $stmt_4->get_result();
}else{
    header('location: getOrder.php');
    exit;
}

?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
                <h1 style="text-align:center; color: red ;">Order Details</h1>
                    <a href="index.php" style="font-size:20px;">BACK</a>
                  
                    <section id="orders" class="order container my-5 py-3 ">
                        <div class="container mt-2">
                            <h2 class="font-weight-bold text-center">YOUR ORDER DETAILS</h2>
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
                                                    <th>Prod ID</th>
                                                    <th>Product(s)</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Product Quantity</th>
                                                    <th>Total Amount</th>
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                              
                                                <tr >
                                                    
                                                    <td style="text-align: center;"><?php echo $row['product_id']?></td>
                                                    <td><img src=/img/product/<?php echo $row['product_cover_picture']?> style="object-fit:contain;width:30%;height:30%"><td>
                                                    <td style="text-align: left;"><?php echo $row['product_name']?></td>
                                                    <td style="text-align: center;"><?php echo $row['quantity']?></td>
                                                    <td style="text-align: center;"><?php echo $row['amount']?></td>
                                                    
                                                </tr>
                                            
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                </div>
                        
                                <div class="card-footer">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                
                                             <a href="orderDetails.php?id ="><button type="button" class="btn btn-primary">Order Status</button>
                                             <button type="button" class="btn btn-primary" style="margin-left:10px;">Order Again</button>
											 
                                             
											 <!--CHEONG KIT MIN (Rating)-->
											<!--
											  <button type="button" class="btn btn-primary" style="margin-left:10px;">Ratings</button>
											  -->
												<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">
												<input type = "hidden" name = "rid" value = "<?php echo $row['product_id']?>">
												<input type = "submit" class="btn btn-primary" name = "wreview" value = "Review"></form>											  
											 <!--CHEONG KIT MIN (END of Rating)-->
                                             <span style="margin-left:20%;">Total</span>
                                             <span style="margin-left:18%;" ><?php echo $row['amount']?></span>
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
