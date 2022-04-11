<?php
    require_once __DIR__ . '/header.php'
?>

<?php
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT product_name, product_description, product_brand, product_cover_picture FROM product";
    $result = $conn->query($sql);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div id="carouselExampleControls" class="carousel banner" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://images.pexels.com/photos/3806753/pexels-photo-3806753.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://images.pexels.com/photos/5926239/pexels-photo-5926239.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://images.pexels.com/photos/5872348/pexels-photo-5872348.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    <!--Main Navigation-->
    <!--Main layout-->
    <main class="mt-5">
    <div class="container">

      <section class="text-center">
        <div class="ratingContainer shadow rounded">
          <p class="text-center">SEGi College Penang | Joined<span style="color: red;">2021</span>   Rating<span style="color: red;">4.9 out of 5.0</span>   Products<span style="color: red;">12</span></p>
        </div>
      </section><br>

        <section class="text-center">
          <h4 class="mb-5"><strong>Shop Voucher</strong></h4>
          <div class="voucherContainer d-flex align-items-center">
          </div>
        </section>

        <hr class="my-5" />

        <!--Section: Content-->
        <section class="text-center">
          <h4 class="mb-5"><strong>best Sellers</strong></h4>
          <div class="row">
            <?php
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
            ?>
            
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                  <img
                    src="/img/product/<?php echo $row['product_cover_picture']?>"
                    class="imgContainer"
                  />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <?php
                      echo " " . $row["product_name"]. "<br>" . $row["product_description"]. "<br>" . $row["product_brand"]. "<br>";
                  ?>
                  <!--<a href="#!" class="btn btn-primary">Button</a>-->
                </div>
              </div>
            </div>
            <?php
            }
          } else {
            echo "error";
          }
          $conn->close();

            ?>
          </div>
        </section>
        <!--Section: Content-->
        
      </div>
    </main>
    <!--Main layout-->

    <style>
      #carouselExampleControls,
        .carousel-inner,
        .carousel-item,
        .carousel-item.active {
          height: 80vh;
          position: relative;
        }

      .ratingContainer{
        background-color: white;
        padding: 15px;
        position: absolute;
        margin-top: -70px;
        width: 86%;
      }

      .voucherContainer{
        background-color: #f0f0f0;
        border: none;
        border-radius: 5px;
        height: 15vh; /* should be remove after add in voucher */
        width: 180vh; /* should be remove after add in voucher */
        margin:; /* Better set align center */
      }

      .imgContainer
      {
        height: 50vh;
      }
    </style>

    <?php
    require __DIR__ . '/footer.php'
?>
