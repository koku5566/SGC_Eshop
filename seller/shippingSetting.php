<?php
    require dirname(__DIR__, 1) . '/seller/header.php';

    if(isset($_POST['updateCourier']))
    {
        $sellerid = $_SESSION['uid'];

        $courier = $_POST['courierservice'];

        $query = "UPDATE shopProfile SET courier='$courier' WHERE shop_id = '$sellerid'";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
    
            $_SESSION['success']= "Courier service option updated";
            header('Location: shipping_setting.php');
        }
        else
        {
            $_SESSION['status']= "Courier service option not updated";
            header('Location: shipping_setting.php');
        }
        
    
    }
    
    
    

?>
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%;">
<?php
    if(isset($_SESSION['success'])&& $_SESSION['success']!='')
    {
        echo '<div class="alert alert-primary" role="alert">'.$_SESSION['success'].'</div>';
        unset($_SESSION['success']); //unset value when reload
    }

    if(isset( $_SESSION['status'] )&&  $_SESSION['status'] )
    {
        echo '<div class="alert alert-danger" role="alert">'. $_SESSION['status'] .'</div>';
        unset( $_SESSION['status'] ); //unset value when reload
    }
    ?>


<form action="#">
<div class="form-group" >
  <label for="shipping-option">Choose your shop courier service option:</label>
  <select class="form-control" name="courierservice" id="shipping-option">
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

<button type="submit" name="updateCourier" class="btn btn-primary">Update</button>
</form>

</div>
<!-- /.container-fluid -->





<?php
    require dirname(__DIR__, 1) . '/seller/footer.php';
?>