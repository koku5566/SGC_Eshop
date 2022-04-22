<?php
    require __DIR__ . '/header.php'
?>
<?php 

?>
 <form action ="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">
              <input type = "hidden" name="id" value="<?php echo $facility["id"]?>">
              <input type="submit" class="btn btn-danger btn-rounded btn-sm fw-bold" name="dfacility" value="Delete">
            </form>
<?php
    require __DIR__ . '/footer.php'
?>

<style>


</style>
