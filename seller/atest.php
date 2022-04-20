<?php
    require __DIR__ . '/header.php';
             
    if(isset($_POST['submit']))
    {
        $productDescription = mysqli_real_escape_string($conn, $_POST["productDescription"]);

        $sql_update = "UPDATE product SET ";
        $sql_update .= "product_description = '$productDescription' WHERE product_id = 'P000059' ";

        if(!mysqli_query($conn,$sql_update))
        {
            echo("Error description: " . mysqli_error($conn));
        }
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid" id="mainContainer">

    <form id="productForm" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <textarea class="form-control" id="productDescription" name="productDescription" maxlength="3000"></textarea>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
<!-- /.container-fluid -->


<script src='../tinymce/js/tinymce/tinymce.min.js'></script>

<script>
    tinymce.init({

        selector: '#productDescription',

        toolbar: 'undo redo | casechange blocks | bold italic | removeformat'

    });
</script>

<?php
    require __DIR__ . '/footer.php'
?>