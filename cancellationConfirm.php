<?php
    require __DIR__ . '/header.php'
?>
<?php
    if(isset($_POST['save_cancellation']))
    {
        $cancel = $_POST['flexRadioDefault'];
       // echo $cancel;
        $query = "INSERT INTO cancellation (cancellation_reason) VALUES ('$cancel') ";
        $queryR = mysqli_query($conn,$query); 
    }

?>


                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">

                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
