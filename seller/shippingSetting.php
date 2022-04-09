<?php
    require dirname(__DIR__, 1) . '/seller/header.php';


?>
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%;">
        <!-- Basic Infomation -->


<form action="#">
<div class="form-group" >
  <label for="shipping-option">Choose your shop shipping option:</label>
  <select class="form-control" id="shipping-option">
      <!-- [service_name] -->
    <option value="PosLaju">Pos Laju</option> 
    <option value="Skynet">Sky Net</option>
    <option value="ABX">ABX Express</option>
    <option value="Flash Express">Flash Express</option>
    <option value="DHL eCommerce">DHL eCommerce</option>
    <option value="Pgeon">Pgeon Delivery</option>
    <option value="J&T Express"> J&T Express</option>
  </select>
</div>

<button type="submit" class="btn btn-primary">Update</button>
</form>

</div>
<!-- /.container-fluid -->





<?php
    require dirname(__DIR__, 1) . '/seller/footer.php';
?>