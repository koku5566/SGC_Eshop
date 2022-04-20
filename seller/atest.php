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
        <textarea class="form-control" id="productDescription" name="productDescription"></textarea>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
<!-- /.container-fluid -->


<script src='../tinymce/js/tinymce/tinymce.min.js'></script>

<script>
    tinymce.init({

    selector: '#mytextarea',

    plugins: [

    'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',

    'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',

    'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'

    ],

    toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +

    'alignleft aligncenter alignright alignjustify | ' +

    'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'

    });
</script>

<?php
    require __DIR__ . '/footer.php'
?>