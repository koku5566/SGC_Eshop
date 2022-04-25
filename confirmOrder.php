<?php
    require __DIR__ . '/header.php'
?>
<?php
$order_id = $_GET['order_id'];
if(isset($_POST['confirm']))
{
  
  $order_id = $_POST['order_id'];
  $query = "UPDATE myOrder SET order_status = 'Completed' WHERE order_id = '$order_id' ";
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
  <h1 style="text-align:center; color: red ;">Order Confirmation</h1>
  <a href="getOrder.php" style="font-size:20px;">BACK</a>
  <section id="orders" class="order container my-5 py-3 ">
    <div class="container mt-2">
      <h2 class="font-weight-bold text-center">ARE YOU SURE YOU WANT TO CONFIRM YOUR ORDER?</h2>
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
        $sql2 = "SELECT * FROM myOrder 
        JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
        JOIN product ON orderDetails.product_id = product.product_id
        JOIN shopProfile ON orderDetails.shop_id = shopProfile.shop_id
        WHERE myOrder.order_id = '$order_id' ";
        $result2 = $conn->query($sql2);
        while($row2 = $result2->fetch_assoc()){
      ?>
      <?php }?>

      <!--------------------END OF DETAILS---------------------->
      
      <div class="card-footer">
          
          <form method="post" action="confirmOrder.php" style="font-size:25px;">
                <input type="hidden" id="order_id" name="order_id" value="<?php echo $_GET['order_id']; ?>">
                <input class="btn btn-primary" type="submit" name="confirm" value="Confirm Order" >
                
            </form>
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
