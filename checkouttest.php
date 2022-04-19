<?php
    require __DIR__ . '/header.php';
	//   if($_SESSION['login'] == false)
	//  {
	//  	echo "<script>alert('Login to checkout');
	//  		window.location.href='login.php';</script>";
    //  } 

 echo $_SESSION['uid'];

//Username and address
 $usersql ="SELECT user.email,userAddress.address_id,userAddress.user_id,userAddress.contact_name,userAddress.phone_number,userAddress.address,userAddress.postal_code,userAddress.area,userAddress.state,userAddress.country 
            FROM `userAddress`
            JOIN user ON userAddress.user_id = user.user_id
            WHERE userAddress.user_id= '$_SESSION[uid]';";
            
            $userresult = mysqli_query($conn, $usersql);  
            $userrow = mysqli_fetch_assoc($userresult);       

$sellerUID = 11; //*TO GET*
$customerUID = $_SESSION['uid'];

  //Under the same seller
  $productlength =[];
  $productwidth = [];
  $productheight = 0;
  $productweight =0;
  
  $cartsql = "SELECT product_ID, quantity FROM cart WHERE user_ID = '$customerUID'";
  $result = $conn->query($cartsql);

  if ($result->num_rows > 1) { //if multiple product in cart
    while($row = $result->fetch_assoc()) {
     
    $productQty = $row['quantity'];

    // Multiple items in one order: Volumetric weight calculation (kg) = Max Length (cm) x Max Width (cm) x Sum (Height (cm) x Quantity) / 5000.
    //===========To get product weight, height, and width of the product==================
    $sqlinfo = "SELECT product_length, product_width, product_height, product_weight FROM product WHERE product_id = '$row[product_ID]'";
    $result = $conn->query($sqlinfo);
    if (mysqli_num_rows($result) > 0) {
        while ($prod = $result->fetch_assoc()) {
        
            array_push($productlength, $prod['product_length']);
            array_push($productwidth, $prod['product_width']);
            $productheight += $prod['product_height']* $productQty;  // Sum (Height (cm) x Quantity)
            //$productweight += $prod['product_weight'] 
            
        }
    }
  }
$maximumlength = max($productlength);
$maximumwidth = max($productwidth);
$volumetricWeight = $maximumlength* $maximumwidth* $productheight/5000;
}
else if ($result->num_rows = 1) { //if only one item in cart
    while($row = $result->fetch_assoc()) {
        $productQty = $row['quantity'];

        //Single item in one order: Volumetric weight calculation (kg) = Height (cm) x Width (cm) x Length (cm) / 5000.        
        //===========To get product weight, height, and width of the product==================
            $sqlinfo = "SELECT product_length, product_width, product_height, product_weight FROM product WHERE product_id = '$row[product_ID]'";
            $result = $conn->query($sqlinfo);
            if (mysqli_num_rows($result) > 0) {
                while ($prod = $result->fetch_assoc()) {
                    if ($productQty == 1) 
                    {
                        $volumetricWeight = $prod['product_height']* $prod['product_width']* $prod['product_length']/5000;
                    }
                    else{
                        $volumetricWeight = ($prod['product_height']*$productQty)* $prod['product_width']* $prod['product_length']/5000;

                    }
                }
            }
        }

}

echo $volutetricWeight;
  
  //echo $productheight, $maximumlength, $maximumwidth;
  //echo $productweight;



?>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/checkout.css">
   


    <div class="container-fluid" style="width:80%">
<body style="background: #f5f2f2;">
    <div class="container" style="padding: 24px;margin-top: 30px;">
        <div style="padding: 12px;background: var(--bs-body-bg);border-width: 1px;box-shadow: 0px 0px 1px var(--bs-gray-500);"><label class="form-label" style="font-size: 20px;"><i class="fa fa-map-marker" style="width: 19.4375px;"></i><strong>Delivery Address</strong></label>
            <div class="row">
                <div class="col"><label class="col-form-label" style="margin-left: 15px;"><?php echo $userrow['contact_name']; ?></label></div>
                <div class="col offset-lg-0" style="text-align: left;"><label class="col-form-label" style="text-align: center;"><?php echo $userrow['phone_number']; ?></label></div>
                <div class="col"><button class="btn btn-primary text-center" type="button" style="text-align: right;background: #A71337;width: 122.95px;">Change</button></div>
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
                            <input class="form-check-input" type="radio" name="shipping-option" id="standarddelivery" checked>
                            <label class="form-check-label" for="standarddelivery">
                                Standard Delivery
                             </label>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#courieroptionModal">Choose</button>

                        </div>
                    </div>
                    <div class="col2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping-option" id="pickup" >
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
                    <div class="form-check"><input class="form-check-input" type="radio"  name="paymentmethod" id="formCheck-3"><label class="form-check-label" for="formCheck-3">Credit/Debit Card</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio"  name="paymentmethod" id="formCheck-5"><label class="form-check-label" for="formCheck-5">Online Banking</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio"  name="paymentmethod" id="formCheck-6"><label class="form-check-label" for="formCheck-6">E-Wallet</label></div>
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
            <div class="col"><button class="btn btn-primary text-center" type="button" style="text-align: right;background: #A71337;width: 200.95px;float: right;">Place Order</button></div>
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