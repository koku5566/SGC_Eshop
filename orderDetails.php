<?php
    require __DIR__ . '/header.php'
?>
<?php
$order_id = $_GET['order_id'];


?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
                    <h1 style="text-align:center; color: red ;">Order Status/ Order Details</h1>
                    <a href="getOrder.php" style="font-size:20px;">BACK</a>
                  
                    <section id="orders" class="order container my-5 py-3 ">
                        <div class="container mt-2">
                            <h2 class="font-weight-bold text-center">ORDER DETAILS</h2>
                            <hr class="mx-auto">
                        </div>
                   
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
