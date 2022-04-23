<?php
    require __DIR__ . '/header.php'
?>
<?php
$order_id = $_GET['order_id'];


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
    </div>
      
      <br>
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
return confirm("Are you sure you want to complete the order?");
}


</script>