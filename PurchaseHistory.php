<?php
    require __DIR__ . '/header.php'
?>
<?php
$sql = "SELECT 
product.product_name,
product.product_cover_picture,
product.product_price,
orderDetails.quantity,
product.product_sku

FROM product";
$result = $conn->query($sql);

?>

               

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%">
                <h1 style="width: 315px;margin-left: 460px;color: #c71526;">Purchase History</h1>
                <div style="padding-left: 20px;padding-top: 40px;">
                     <div>
                         <button class="btn btn-primary" type="button" style="width: 89.5px;padding-left: 0px;
                                     margin-left: 0px;background: rgba(13,110,253,0);color: var(--bs-blue);border-style: none;
                                      border-color: var(--bs-body-bg);text-decoration: underline;">
                                  <i class="fa fa-long-arrow-left" style="padding-right: 9px;color: var(--bs-blue);
                                        background: rgba(255,255,255,0);">
                                        </i>Back</button>
                                        <br /><br />
                                        <br />
                     </div>
                </div>
  
  <div style="height: 550px;border-style: solid;">
    <div class="row">
      <div class="col" style="width: 500px;">
      <img src="img/segi kl.png" style="width:400px; margin-left:10px">
      </div>
      <div class="col-xl-2">
        <p style="text-aligh:centre;">Date & Time:<br/> <span id="datetime"></span></p><br/>
      </div>
    </div>
    <br/>
    <div class="row" style="font-size:20px; ">
    <?php
          while ($row = $result->fetch_assoc()) {
      ?>
      
      <div class="col" style="width:150px; height:150px;object-fit:contain"><?php echo $row['product_cover_picture']?></div>
      <div class="col"  style="margin-top:10px;"><?php echo $row['product_name']?></div>
      <div class="col"  style="margin-top:10px;"><?php echo $row['product_qty']?></div>
      <div class="col" style="margin-top:10px;"><?php echo $row['product_sku']?>
      </div>
      
      <div class="col" style="margin-top:10px"><?php echo $row['product_variation']?>
      </div>
      <div class="col" style="margin-top:10px">RM<?php echo $row['product_price']?>
      </div>
    </div>
    
                                    
    <?php
    }?>
    </div>
      <div class="row" style="font-size:20px; ">
      <div class="col">
      <img src="img/product/iphone-grey.png" style="width:150px; height:150px;object-fit:contain">
      </div>
      <div class="col" style="margin-top:10px">3-in-1 Power Bank with Phone Stand Model: WI-SP510
      </div>
      <div class="col" style="margin-top:10px;">Navy Blue
      </div>
      <div class="col" style="margin-top:10px">x1
      </div>
      <div class="col" style="margin-top:10px">RM349.00
      </div>
      <div class="col" style="margin-top:10px" id="price">RM349.00
      </div>
    </div>
    <br/>
    <br/>
    <div style="width: 1509px;height: 89px;margin-left: 0px;
            border: 1.5px solid black;">
      <div class="row">
      <div class="col" style="margin-top:20px">
        <button class="btn btn-primary" type="button" style="background: #1A2C42; margin-left:20px;" ><a href="purchaseShippingDetails.php">Order Status</a></button>
        <button class="btn btn-primary" type="button" style="background: #1A2C42; margin-left:10px">Order Again</button>
        </div>
        <div class="col-2" style="margin-top:20px; font-size:20px">Total:
      </div>
        <div class="col-2" style="margin-top:20px; font-size:20px;color:red" id="calc">RM465.60<span id="total_Price"></span>
      </div>
      </div> 
             
</div>
  
  <script>
   var dt = new Date();
  document.getElementById("datetime").innerHTML = dt.toLocaleString();
  </script> 
  
  
</div>
  
   <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>


