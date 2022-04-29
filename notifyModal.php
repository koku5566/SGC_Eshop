<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"> -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<?php
 echo "
  <button type='button' class='btnG' data-toggle='modal' data-target='#notify$i'>
    GET NOTIFY
  </button>
  
  <div class='modal fade' id='notify$i' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='modalLabel'>NOTIFY WHEN AVAILABLE</h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          <div class='product-item'>
              <a class='product-thumb' href='#'><img src='/img/product/$product_image' alt='Product'></a>
              <div class='product-info'>
                  <h4 class='product-title'><a href='#'>".$product_name."</a></h4><span><em>Size:</em>-</span><span><em>Color:</em>-</span>
              </div>
           </div>
           
        </div>
        <div class='modal-footer'>
          <form action='cart_manage.php' method='POST'>
            <input type='hidden' value='".$userID."' name='userID'>
            <button type='submit' class='btnN' name='notify'>Notify Me</button>
          </form>
        </div>
      </div>
    </div>
  </div>
 
 ";
?>

<style>
    #modalLabel
    {
        color: #A71337;
    }
    .btnN 
    {
        background-color: #1A2C42;
        color: white;
        position: relative;
        float: left;
    }
    .btnG
    {
      background-color: #A71337;
      color: white;
    }
</style>
