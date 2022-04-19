<?php
    require __DIR__ . '/header.php';

	  if($_SESSION['login'] == false)
	 {
	 	echo "<script>alert('Login to checkout');
	 		window.location.href='login.php';</script>";
     } 
 
//Username and address
 $usersql ="SELECT user.email,userAddress.address_id,userAddress.user_id,userAddress.contact_name,userAddress.phone_number,userAddress.address,userAddress.postal_code,userAddress.area,userAddress.state,userAddress.country 
            FROM `userAddress`
            JOIN user ON userAddress.user_id = user.user_id
            WHERE userAddress.user_id= '$_SESSION[uid]';";
            
            $userresult = mysqli_query($conn, $usersql);  
            $userrow = mysqli_fetch_assoc($userresult);                 


?>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/checkout.css">
   

<!-- Shipping Courier Option Modal -->
<div class="modal fade" id="courieroptionModal" tabindex="-1" role="dialog" aria-labelledby="courieroptionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="courieroptionModalLabel">Select Courier Option</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- option -->
        <div class="form-check"> 
        <?php 
           for ($i = 0; $i<=5; $i++)
           {
          ?>
          <div class="row">
            <div class="col-1">
            <input class="form-check-input" type="radio" name="courierselection" id="<?php print_r($json -> result[0]->rates[$i]->rate_id)?>" checked>
            </div>
            <div class="col">
                <img class="card-img-top img-thumbnail"style="object-fit:contain;width:100%;height:100%" src="<?php echo $json -> result[0]->rates[$i]->courier_logo; ?>"  alt="<?php print_r($json -> result[0]->rates[$i]->courier_name)?>" />
                <label class="form-check-label" for="<?php print_r($json -> result[0]->rates[$i]->rate_id)?>">
                <div class="row">
                    <div class="col-3">
                        <span><strong><?php echo "<pre>";print_r($json -> result[0]->rates[$i]->courier_name); echo "</pre>";?></strong></span>
                        <span><small><?php echo "<pre>";print_r($json -> result[0]->rates[$i]->delivery); echo "</pre>";?></small></span>
                    </div>
                    <div class="col">
                        <span style="color:#A71337"><?php  echo "<pre>";print_r($json -> result[0]->rates[$i]->shipment_price); echo"</pre>";?></span>
                    </div>
                </div>
                </label>
            </div>
          </div>
          <hr>
          <!-- end of option -->
          <?php } ?>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

     <!-- Address Modal -->
     <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Select Address</h4>
        </div>
        <div class="modal-body">
        <?php
/* 	$UID = $_SESSION["uid"];
	
	$sql = "SELECT * FROM userAddress WHERE user_id ='$UID'";

	$res_data = mysqli_query($conn,$sql);
	while($addressrow = mysqli_fetch_array($res_data)){
		("
			<div>
            <input class=\"form-check-input\" type=\"radio\" name=\"address-option\" id=\"address-option\" >
            <label class=\"form-check-label\" for=\"address-option\">
				".$addressrow["contact_name"]."
				".$addressrow["phone_number"]."
				".$addressrow["address"]."
				".$addressrow["postal_code"]."
				".$addressrow["area"]."
				".$addressrow["state"]."
				".$addressrow["country"]."
                </label>
			</div>
			");
	} */
?>
        </div>  
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
    <div class="container-fluid" style="width:80%">
<body style="background: #f5f2f2;">
    <div class="container" style="padding: 24px;margin-top: 30px;">
        <div style="padding: 12px;background: var(--bs-body-bg);border-width: 1px;box-shadow: 0px 0px 1px var(--bs-gray-500);"><label class="form-label" style="font-size: 20px;"><i class="fa fa-map-marker" style="width: 19.4375px;"></i><strong>Delivery Address</strong></label>
            <div class="row">
                <div class="col"><label class="col-form-label" style="margin-left: 15px;"><?php echo $userrow['contact_name']; ?></label></div>
                <div class="col offset-lg-0" style="text-align: left;"><label class="col-form-label" style="text-align: center;"><?php echo $userrow['phone_number']; ?></label></div>
                <div class="col"><button class="btn btn-primary text-center" type="button" style="text-align: right;background: #A71337;width: 122.95px;" data-toggle="modal" data-target="#myModal"    >Change</button></div>
            </div>
            <div class="row">
                <div class="col"><label class="col-form-label" style="margin-left: 14px;"><?php echo $userrow['address'],',',$userrow['postal_code'],',', $userrow['area'],',',$userrow['state'],',',$userrow['country']; ?></label></div>
            </div>
        </div>
        <div style="padding: 12px;background: var(--bs-body-bg);border-width: 1px;box-shadow: 0px 0px 1px var(--bs-gray-500);margin-top: 15px;">
            <div></div>
            <div class="row">
                <div class="col"><label class="form-label" style="font-size: 20px;"><strong>Your Order</strong></label>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th>Variation</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Item Subtototal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                                <tr>
                                    <td></td>
                                    <td>Product 1</td>
                                    <td>Black</td>
                                    <td>RM20</td>
                                    <td>2</td>
                                    <td>RM40</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Product 2</td>
                                    <td>-</td>
                                    <td>RM50</td>
                                    <td>1</td>
                                    <td>RM50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- <div style="margin-top: 40px;"><label class="form-label" style="margin-top: 10px;">Voucher</label>
                <div class="row">
                    <div class="col-lg-11 offset-lg-0"><input type="text" style="border-color: rgba(0,0,0,0.32);width: 240.8px;padding: 7px 2px;" placeholder="Enter voucher code"><button class="btn btn-primary text-center" type="button" style="text-align: right;background: #A71337;width: 122.95px;margin-left: 11px;">Apply</button></div>
                </div>
            </div> -->
            <div class="shipping-option" >
                <div class="row">
                    <div class="col"><label class="col-form-label" style="margin-top: 10px;">Shipping Option</label></div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <div class="form-check">
                        <form action="" method="post" class="paymentmethod">
                            <input class="form-check-input" type="radio" name="shipping-option" id="standarddelivery" checked>
                            <label class="form-check-label" for="standarddelivery">
                                Standard Delivery
                             </label>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#courieroptionModal">Choose</button>

                        </div>
                    </div>
                    <div class="col2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping-option" id="pickup"required >
                            <label class="form-check-label" for="pickup">
                                Pick-up
                            </label>
                        </div>
                    </div>
                </div>


            </div>
            <div>
                <div class="row">
                    <div class="col"><label class="form-label">Message</label>
                        <div class="row">
                            <div class="col"><input type="text" style="border-color: rgba(0,0,0,0.32);width: 240.8px;padding: 7px 2px;" placeholder="Leave a message to seller"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding: 12px;background: var(--bs-body-bg);border-width: 1px;box-shadow: 0px 0px 1px var(--bs-gray-500);margin-top: 15px;">
            <div class="row">
                <div class="col"><label class="form-label" style="font-size: 20px;"><strong>Payment Method</strong><br></label>
                    <div class="form-check"><input class="form-check-input" type="radio" name="paymentmethod" id="formCheck-3" required><label class="form-check-label" for="formCheck-3">Credit/Debit Card</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio" name="paymentmethod" id="formCheck-5"><label class="form-check-label" for="formCheck-5">Online Banking</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio" name="paymentmethod" id="formCheck-6"><label class="form-check-label" for="formCheck-6">E-Wallet</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio" name="paymentmethod" id="formCheck-4"><label class="form-check-label" for="formCheck-4">Cash on Delivery</label></div>
                </div>
                <div class="col"><label class="form-label" style="font-size: 20px;"><strong>Order Summary</strong><br></label>
                    <ul class="list-group">
                        <li class="list-group-item"><span>Order Total</span></li>
                        <li class="list-group-item"><span>Shipping Total</span></li>
                        <li class="list-group-item"><span>Total Payment</span></li>
                    </ul>
                </div>
            </div>
            <br>
            <div class = 'row'>
            <div class="col"><button class="btn btn-primary text-center" type="submit" style="text-align: right;background: #A71337;width: 200.95px;float: right;">Place Order</button></div>
            </form>
            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>