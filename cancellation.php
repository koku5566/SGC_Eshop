<?php
    require __DIR__ . '/header.php'
?>
<?php
$order_id = $_GET['order_id'];
if(isset($_POST['cancel']))
{
  $reason_type = $_POST['reason_type'];
  $order_id = $_POST['order_id'];
  $query = "UPDATE myOrder SET reason_type = '$reason_type' , cancellation_status = 'To respond' WHERE order_id = '$order_id' ";
  echo "$query";
  if (mysqli_query($conn, $query)) {
    ?><script>window.location = '<?php echo("$domain/getOrder.php");?>'</script><?php
		exit;
   } else {
    echo "Error updating record: " . mysqli_error($conn);
   }
    
}
  


?>


<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
  <h1 style="text-align:center; color: red ;">Cancellation</h1>
  <a href="getOrder.php" style="font-size:20px;">BACK</a>
  <section id="orders" class="order container my-5 py-3 ">
    <div class="container mt-2">
      <h2 class="font-weight-bold text-center">ARE YOU SURE YOU WANT TO CANCEL THE ORDER?</h2>
      <hr class="mx-auto">
    </div>
    <div class="card">
      <div class="card-header">
        <div class="order-list-panel">
          <div class="row">
            <div class="col-1"></div>
            <div class="col-5">Product</div>
            <div class="col-2">Unit Price</div>
            <div class="col-2">Quantity</div>
            <div class="col-2">Total Price</div>
          </div>
        </div>
      </div>
      <!-----------------THIS IS THE DETAILS------------------->
      <?php
       $shippingfee = 8.6;
       $totalamount = 0;
       $amount=0;
       $sql2 = "SELECT
       DISTINCT
       myOrder.order_id,
       product.product_name,
       product.product_price,
       product.product_cover_picture,
       shopProfile.shop_name,
       productTransaction.quantity
       
       FROM
       myOrder
       JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id
       JOIN product ON productTransaction.product_id = product.product_id
       JOIN shopProfile ON product.shop_id = shopProfile.shop_id
       JOIN user on myOrder.userID = user.user_id 
       JOIN cart ON myOrder.userID = cart.user_ID
       WHERE myOrder.order_id = '$order_id' ";
       $result2 = $conn->query($sql2);
       while($row2 = $result2->fetch_assoc()){
        $amount =  $row2['product_price']*$row2['quantity'];
                        $totalamount += $amount;
      ?>
     <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-1"><img src=/img/product/<?php echo $row2['product_cover_picture']?> style="object-fit:contain;width:100%;height:100%"></div>
            <div class="col-5">
              <?php echo $row2['product_name']; ?>
            </div>
            <div class="col-2">RM
              <?php echo $amount ?>.00
            </div>
            <div class="col-2">X
              <?php echo $row2['quantity']; ?>
            </div>
            <div class="col-2 red-text">RM
              <?php echo $amount; ?>.00
            </div>
          </div>
        </div>
        <?php }?>
      </div>

      <!--------------------END OF DETAILS---------------------->
      <!--------------------ASK REASON TO CANCEL---------------->
      <div class="card-body">
          <h2>Please tell us the reason why you want to cancel</h2>
          <form method="post" action="cancellation.php" style="font-size:25px;">
                <input type="radio" id="id_1" name="reason_type" value="Regrets"  >
                <label for="id_1" >Regrets</label><br>
                <input type="radio" id="id_2" name="reason_type" value="Change Of Mind">
                <label for="id_2">Change of Mind</label><br>
                <input type="radio" id="id_3" name="reason_type" value="Change Color">
                <label for="id_3">Change Color</label><br>
                <input type="radio" id="id_4" name="reason_type" value="Others" >
                <label for="id_1">Others</label><br>
                <input type="hidden" id="order_id" name="order_id" value="<?php echo $_GET['order_id']; ?>">
                <input class="btn btn-primary" type="submit" name="cancel" value="Confirm" >
                
            </form>
        </div>
          
      <!-----------------END OF ASK REASON TO CANCEL------------>

    </div>
  </section>
</div>
<!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
<script type="text/javascript">
function confirm_click()
{
return confirm("Order Cancelled");
}

</script>