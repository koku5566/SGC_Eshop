<?php
    require __DIR__ . '/header.php'
?>


               

<?php
$sql = "SELECT 
product.product_name,
product.product_cover_picture,
product.product_qty,
product.product_variation,
product.product_price
FROM product
";
$result = mysqli_query($sql);
?>


  
  
   <!-- /.container-fluid -->


   

<?php
    require __DIR__ . '/footer.php'
?>

<style>
</style>

<script>
  var dt = new Date();
  document.getElementById("datetime").innerHTML = dt.toLocaleString();
</script> 


