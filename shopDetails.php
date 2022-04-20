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
<!-- Slide Show by Lim Qiu Xiong-->
<?php
    //Fetch each promotion image information
    $promotion_title = array();
    $promotion_image = array();

    $sql_promotion = "SELECT * FROM promotion AS A LEFT JOIN user AS B ON A.user_id = B.userID WHERE promotionEnd_Date >= now() AND `status` = 0";

    $result_promotion = mysqli_query($conn, $sql_promotion);
    
    if (mysqli_num_rows($result_promotion) > 0) {
        while($row_promotion = mysqli_fetch_assoc($result_promotion)) {
            array_push($promotion_title,$row_promotion['promotion_title']);
        array_push($promotion_image,$row_promotion['promotion_image']);
        }
    }   
    else{
        ?>
            <script type="text/javascript">
                //window.location.href = window.location.origin + "/index.php";
            </script>
        <?php
    }
?>
<!-- Slide Show by Lim Qiu Xiong-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Slide Show by Lim Qiu Xiong-->
<div class="col-xl-12">
  <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
      <div class="carousel-inner">
        <?php
          for($i = 0; $i < count($promotion_image); $i++)
          {
            if($promotion_image[$i] != "")
            {
              $picName = "/img/promotion/".$promotion_image[$i];
              if($i == 0)
              {
                echo("<div class=\"carousel-item active\"> <img src=\"$picName\" alt=\"".$promotion_title[$i]."\"> </div>");
              }
              else
              {
                echo("<div class=\"carousel-item\"> <img src=\"$picName\" alt=\"".$promotion_title[$i]."\"> </div>");
              }
            }
          }
       ?>
      </div>
    <!-- Left right --> 
    <a class="carousel-control-prev" style="bottom: 10%;" href="#custCarousel" data-slide="prev"> <span class="border bg-secondary rounded carousel-control-prev-icon"></span> </a> 
    <a class="carousel-control-next" style="bottom: 10%;" href="#custCarousel" data-slide="next"> <span class="border bg-secondary rounded carousel-control-next-icon"></span> </a> 
                    
    </div>
</div>
<!-- End Slide Show by Lim Qiu Xiong-->

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
          <div class="d-flex align-items-center"> <!--<div class="voucherContainer d-flex align-items-center">-->
            <div class="voucher">
              <div class="coupon-card">
                <!--<img src="https://cdn.mos.cms.futurecdn.net/tQxVwcJSowYD7xwWDYidd9.jpg" class="logo">-->
                <!--<h3>20% flat off on all rides within the city <br> using HDFC Credit Card</h3>-->
                <h3>RM12 discount</h3>
                
                <div class="coupon-row">
                  <span id="cpnCode">STEALDEAL20</span>
                  <span id="cpnBtn">COPY CODE</span>
                </div>
                
                <p>Valid Till: 20 Dec, 2021</p>
                
                <div class="circle1"></div>
                <div class="circle2"></div>
              </div>
            </div>
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

      .coupon-card{
         background: linear-gradient(135deg, #7158fe, #9d4de6);
         color: #fff;
         text-align: center;
         padding: 10px 30px;
         border-radius: 15px;
         box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.15);
      }
      
      .logo{
        width: 80px;
        border-radius: 8px;
        margin-bottom: 20px;
      }
      
      .coupon-card h3{
        font-size: 15px;
        font-weight: 400;
        line-height: 40px;
      }
      
      .coupon-card p{
        font-size: 10px;
      }
      
      .coupon-row{
        display: flex;
        align-items: center;
        margin: 25px auto;
        width: fit-content;
      }
      
      #cpnCode{
        border: 1px dashed #fff;
        padding: 5px 10px;
        border-right: 0;
        font-size: 10px;
      }
      
      #cpnBtn{
        border: 1px solid #fff;
        background:#fff; 
        padding: 5px 10px;
        color: #7158fe;
        cursor: pointer;
        font-size: 10px;
      }
      
      .circle1, .circle2{
        background: #fff;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        position: absolute;
        top: 17%;
        transform: translateY(-50%);
      }
      
      .circle1{
        left: 40px;
      }
      
      .circle2{
        right: 940px;
      }

      .imgContainer
      {
        height: 50vh;
      }

      /*Slide show by Lim Qiu Xiong*/

      #border{
        background-color:black;
      }
      .image-container{
          width:100%;
          height: 40vh;
          padding: 20px;
      }
      .image-container .image{
          max-height: 100%;
          max-width: 100%;
      }
      .list-parent{
          white-space: nowrap;
          font-size: x-large;
      }
      .list-inline-item{
          background-color:white;
      }

      .carousel-item{
          height:60vh;
          background-color:transparent;
      }

      .carousel-inner img {
          width: 100%;
          height: 100%;
          object-fit:contain;
      }

      #custCarousel .carousel-indicators {
          position: static;
          margin-top: 20px
      }

      #custCarousel .carousel-indicators>li {
          width: 100px
      }

      #custCarousel .carousel-indicators li img {
          display: block;
          opacity: 0.5
      }

      #custCarousel .carousel-indicators li.active img {
          opacity: 1
      }

      #custCarousel .carousel-indicators li:hover img {
          opacity: 0.75
      }
      /*End Slide Show by Lim Qiu Xiong*/
    </style>

    <?php
    require __DIR__ . '/footer.php'
?>
