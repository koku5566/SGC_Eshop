<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
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
              <a class='product-thumb' href='#'><img src='https://www.sony.com.my/image/5d02da5df552836db894cead8a68f5f3?fmt=png-alpha&wid=330&hei=330' alt='Product'></a>
              <div class='product-info'>
                  <h4 class='product-title'><a href='#'>".$product_name."</a></h4><span><em>Size:</em>-</span><span><em>Color:</em>Black</span>
              </div>
          </div>
          <div class='form-group'>
              <!-- <label for='exampleInputEmail1'>Email address</label> -->
              <input type='email' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter Your email address'>
          </div>
      </div>
        <div class='modal-footer'>
          <!-- <button type='button' class='btn btn-secondary' id = 'btnB' data-dismiss='modal'>Back</button> -->
          <button type='button' class='btnN' >Notify Me</button>
        </div>
      </div>
    </div>
  </div>
 
 ";
?>
<!-- Button trigger modal -->
<!-- <button type="button" class="btnG" data-toggle="modal" data-target="#exampleModal1">
  GET NOTIFY
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">NOTIFY WHEN AVAILABLE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='product-item'>
            <a class='product-thumb' href='#'><img src='https://www.sony.com.my/image/5d02da5df552836db894cead8a68f5f3?fmt=png-alpha&wid=330&hei=330' alt='Product'></a>
            <div class='product-info'>
                <h4 class='product-title'><a href='#'>Sony Headphone WH-1000XM4</a></h4><span><em>Size:</em>-</span><span><em>Color:</em>Black</span>
            </div>
        </div>
        <div class="form-group"> -->
            <!-- <label for="exampleInputEmail1">Email address</label> -->
            <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your email address">
        </div>
    </div>
      <div class="modal-footer"> -->
        <!-- <button type="button" class="btn btn-secondary" id = "btnB" data-dismiss="modal">Back</button> -->
        <!-- <button type="button" class="btnN" >Notify Me</button>
      </div>
    </div>
  </div>
</div> -->

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