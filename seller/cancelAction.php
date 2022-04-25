<?php
    require __DIR__ . '/header.php'
?>
<?php
$order_id = $_GET['order_id'];
if(isset($_POST['approve']))
{
  
  $order_id = $_POST['order_id'];
  $query = "UPDATE myOrder SET cancellation_status = 'cancelled' WHERE order_id = '$order_id' ";
  echo "$query";
  if (mysqli_query($conn, $query)) {
    ?><script>window.location = '<?php echo("$domain/seller/sellerCancellation.php");?>'</script><?php
		exit;
   } else {
    echo "Error updating record: " . mysqli_error($conn);
   }
    
}

?>


<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
  <h1 style="text-align:center; color: red ;">Cancellation Reply</h1>
  <a href="getOrder.php" style="font-size:20px;">BACK</a>
  <section id="orders" class="order container my-5 py-3 ">
    <div class="container mt-2">
      <h2 class="font-weight-bold text-center">Please give respond to your buyer.</h2>
      <hr class="mx-auto">
    </div>
    <div class="card">
      <div class="card-header">
        
      </div>
     
      
      <div class="card-footer">
          
          <form method="post" action="cancelAction.php" style="font-size:25px;">
                <input type="hidden" id="order_id" name="order_id" value="<?php echo $_GET['order_id']; ?>">
                <input class="btn btn-primary" type="submit" name="approve" value="Approve" style="display:grid ; margin:auto ;" >
                <input class="btn btn-primary" type="submit" name="decline" value="Decline" style="display:grid ; margin:auto ;" >
                
            </form>
      </div>
    

    </div>
  </section>
</div>

<?php
    require __DIR__ . '/footer.php'
?>