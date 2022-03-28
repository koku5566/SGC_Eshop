<?php
    require __DIR__ . '/header.php'
?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<?php

/*QUERY FOR ORDER*/
$sql = "SELECT
myOrder.order_id,
product.product_name,
product.product_cover_picture,
product.product_price,
orderDetails.quantity,
orderDetails.price
FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN product ON orderDetails.product_id = product.id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>



<!--Pick Up Modal-->
<div class="modal fade" id="pickUpModal" tabindex="-1" role="dialog" aria-labelledby="pickUpModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pick Up Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Shipping Progress table-->
        <table class="table track-pickup">
            <thead>
                <tr>
                    <th scope="col">Location</th>
                    <th scope="col">Date</th>
                    <th scope="col">Activity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                </tr>
            </tbody>
        </table>
        <!--end of table-->
        
        <form>
        <div class="form-group">
          <label for="orderstatus">ORDER STATUS:</label>
          <select id="orderstatus" class="form-control">
          <option value="processing">Order is Processing</option>
            <option value="ready">Ready To Pickup</option>
            <option value="cancelled">Order is cancelled</option> 
          </select>
        </div>

        <div class="form-group">
            <label for="notes">NOTES:</label>
            <textarea id="notes" name="notes" rows="3" cols="50">
            </textarea>
        </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%; font-size:14px">

    <!-- Order Filter -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Filter Order</h5>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-12" style="padding-bottom: .625rem;">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <select class="form-select" name="searchBy" aria-label="SearchBy"
                                        style="color:currentColor;">
                                        <option selected value="id">Order ID</option>
                                        <option value="name">Buyer Name</option>
                                        <option value="product">Product</option>
                                        <option value="trackingnumber">Tracking Number</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control" name="keyword" placeholder="Search order">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-12" style="padding-bottom: .625rem;">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Order Date</span>
                                </div>
                                <input type="text" name="daterange" class="form-control js-daterangepicker" value="01/01/2022 - 01/15/2022" />
                            </div>
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

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab"
                                aria-controls="all" aria-selected="true">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="toship-tab" data-toggle="tab" href="#toship" role="tab"
                                aria-controls="toship" aria-selected="false">To Ship</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="topickup-tab" data-toggle="tab" href="#topickup" role="tab"
                                aria-controls="topickup" aria-selected="false">To Pick Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab"
                                aria-controls="shipping" aria-selected="false">Shipping</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content mb-3">
                        <!--------------------------------All-------------------------------------->
                        <div class="order-list-panel">
                            <div class="top-card card-header">
                                <div class="row">
                                    <div class="col-5">Product(s)</div>
                                    <div class="col-1">Order Total</div>
                                    <div class="col-2">Status</div>
                                    <div class="col-2">All Channels</div>
                                    <div class="col-2">Actions</div>
                                </div>
                            </div>
                        </div>
                            <div class="tab-pane show active fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                                
                            <?php 
                            while ($row = $result->fetch_assoc()) {
                            ?>
                            <!--Each Order Item-->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col md-auto text-start"><span><strong>Username</strong></span>
                                            </div>
                                            <div class="col md-auto text-end" style="text-align:right;"><span><strong>
                                                Order
                                                ID:
                                                125353</strong></span></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- <div class="col-1"><img width="100%"
                                                    src="https://www.w3schools.com/images/w3schools_green.jpg"
                                                    alt="W3Schools.com">
                                            </div> -->
                                            <div class="col-1 image-container">
                                                <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="<?php echo $row['product_cover_picture']?>" alt="<?php echo $row['product_name']?>" />
                                            </div>
                                            <div class="col-3"><?php echo $row['product_name']?></div>
                                            <div class="col-1"><?php echo $row['quantity']?></div>

                                            <div class="col-1"><?php echo $row['product_price']?></div>
                                            <div class="col-2">Completed</div>
                                            <div class="col-2">DHL eCommerce 2121113134</div>
                                            <div class="col-2"><a href="shippingCheckDetails.php">Check details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Order Item-->
                                <?php 
                                }?>
                                                                
                                <!--Pick Up Order Item-->       
                                 <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col md-auto text-start"><span><strong>Username</strong></span>
                                            </div>
                                            <div class="col md-auto text-end" style="text-align:right;"><span><strong>
                                                Order
                                                ID:
                                                125353</strong></span></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-1"><img width="100%"
                                                    src="https://www.w3schools.com/images/w3schools_green.jpg"
                                                    alt="W3Schools.com"></div>
                                            <div class="col-3">Product Name yoo</div>
                                            <div class="col-1">X1</div>

                                            <div class="col-1">RM9.00</div>
                                            <div class="col-2">Completed</div>
                                            <div class="col-2">DHL eCommerce 2121113134</div>
                                            <div class="col-2"><a href="#pickUpModal" data-toggle="modal" data-target="#pickUpModal">Update Pick Up</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Order Item-->

                            </div>
                            <!--------------------------------To ship--------------------------------------->
                            <!--------------------------------------PHP----------------------------------------->
                                            <?php
                                                $sql_1 = "SELECT 
                                                myOrder.order_id,
                                                myOrder.tracking_status
                                                product.product_name,
                                                product.product_qty,
                                                product.product_cover_picture
                                                FROM 
                                                myOrder
                                                JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
                                                JOIN product ON orderDetails.product_id = product.product_id";

                                                $stmt_1 = $conn-> prepare($sql_1);
                                                $stmt_1->execute();
                                                $res = $stmt_1->get_result();
                                            ?>
                            <!------------------------------------END OF CODE---------------------------------->
                            <div class="tab-pane fade" id="toship" role="tabpanel" aria-labelledby="toship-tab">
                                <!--Pills tab--->
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-all-tab" data-toggle="pill"
                                            href="#pills-all" role="tab" aria-controls="pills-all"
                                            aria-selected="true">All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-to-process-tab" data-toggle="pill"
                                            href="#pills-to-process" role="tab" aria-controls="pills-to-process"
                                            aria-selected="false">To Process</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-processed-tab" data-toggle="pill"
                                            href="#pills-processed" role="tab" aria-controls="pills-processed"
                                            aria-selected="false">Processed</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <!--All to ship orders-->
                                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel"
                                        aria-labelledby="pills-all-tab">
                                        <div class="card-body" style="padding-left: 0px;">
                                        <div class="card-body" style="padding-left: 0px;">
                                            <div class="card" style="padding-right: 0px;">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Buyer&#39;s Name</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="container" style="padding-right: 14px;padding-left: 0px;">
                                                        <div class="row">
                                                            <div class="col-md-3 col-lg-2" style="width:15%; height:15%; object-fit:contain"><?php echo $row['product_cover_picture']?></div>
                                                            <div class="col-md-3 col-lg-2"><?php echo $row['product_name']?></div>
                                                            <div class="col-md-3 col-lg-2"><?php echo $row['product_variation']?></div>
                                                            <div class="col-md-3 col-lg-2"><?php echo $row['product_price']?></div>
                                                            <div class="col-lg-2">DHL ECOMMERCE</div>
                                                            <div class="col-lg-2">
                                                                <!-- Button trigger modal -->
                                                                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="margin-left:10px">
                                                                Arrange Shipment
                                                                </button>
                                                                <form action="" method="post">
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                                    <h4 class="modal-title" id="myModalLabel">Sucessfully</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row justify-content-center">
                                                                                        <div class="col-4">
                                                                                                 DHL ECOMMERCE
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <a>Tracking Number:</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary"><a href="">Okay</a></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </form>
                                                                <!-----END HERE------------>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                     </div>
                                </div>

                                    <!--to process to ship orders-->
                                    <div class="tab-pane fade" id="pills-to-process" role="tabpanel"aria-labelledby="pills-to-process-tab">
                                         <!----end Here-->
                                    </div>

                                    <!-- processed to ship orders-->
                                    <div class="tab-pane fade" id="pills-processed" role="tabpanel" aria-labelledby="pills-processed-tab">
                                        ...
                                    </div>
                                </div>

                            </div>
                            <!--------------------------------Pick Up--------------------------------------->
                            <div class="tab-pane fade" id="topickup" role="tabpanel" aria-labelledby="topickup-tab">...
                            yomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomama
                            </div>

                            <!--------------------------------Shipping--------------------------------------->
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                            yopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapa
                            </div>

                            <!--------------------------------Completed--------------------------------------->
                            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                            yosis
                            </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<!--Date Picker-->

<?php
    require __DIR__ . '/footer.php'
?>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>

    //Date picker function
    $(function () {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

</script>
<style>
.track-pickup tr:first-child td {
    color: green;
}
</style>