<?php
    require_once __DIR__ . '/header.php'
?>

<?php
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $shop_id = $_GET['id'];
    $sql1 = "SELECT product_name, product_description, product_price, product_cover_picture FROM product WHERE shop_id='$shop_id'";
    $sql2 = "SELECT discount_amount, voucher_code, voucher_startdate, voucher_expired FROM voucher"; 
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);

    //Added by Maverick
    $sql_shop = "SELECT A.shop_id, A.shop_name, A.shop_profile_image, U.registration_date FROM shopProfile AS A LEFT JOIN user AS U ON A.shop_id = U.user_id  WHERE shop_id = '$shop_id'";
    $result_shop = mysqli_query($conn, $sql_shop);

    if (mysqli_num_rows($result_shop) > 0) {
      while($row_shop = mysqli_fetch_assoc($result_shop)) {
        $shop_id = $row_shop['shop_id'];
        $shop_name = $row_shop['shop_name'];
        $shop_pic = $row_shop['shop_profile_image'];
        $shop_rating = $row_shop['shop_rating'];
        $shop_joinby = substr($row_shop['registration_date'], -4);
      }
    }
  
    $sql_shop = "SELECT COUNT(product_id) AS total_Product FROM product WHERE shop_id = '$shop_id'";
    $result_shop = mysqli_query($conn, $sql_shop);

    if (mysqli_num_rows($result_shop) > 0) {
      while($row_shop = mysqli_fetch_assoc($result_shop)) {
        $shop_totalProduct = $row_shop['total_Product'];
      }
    }
?>

<!-- Promotion banner by Lim Qiu Xiong-->
<?php
    //Fetch each promotion image information
    $promotion_title = array();
    $promotion_image = array();
    $user_id = $_GET['id'];
    
    $sql_promotion = "SELECT * FROM promotion AS A LEFT JOIN user AS B ON A.user_id = B.user_id WHERE A.user_id='$user_id' AND promotionEnd_Date >= now() AND `status` = 0";

    $result_promotion = mysqli_query($conn, $sql_promotion);
    
    if (mysqli_num_rows($result_promotion) > 0) {
        while($row_promotion = mysqli_fetch_assoc($result_promotion)) {
            array_push($promotion_title,$row_promotion['promotion_title']);
        array_push($promotion_image,$row_promotion['promotion_image']);
        }
    }   
    else{
    }
?>
<!-- Promotion banner by Lim Qiu Xiong-->

<!-- Promotion banner by Lim Qiu Xiong-->
<div class="col-xl-12">
  <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
      <div class="carousel-inner">
        <?php
        if(count($promotion_image)==0)
        {
          echo("<div class=\"carousel-item active\"> <img src=\"/img/resource/default_image.jpg\" alt=\"default_image\"> </div>");
        }
        else 
        {
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
        }
          
       ?>
      </div>
    <!-- Left right --> 
    <a class="carousel-control-prev" style="bottom: 10%;" href="#custCarousel" data-slide="prev"> <span class="border bg-secondary rounded carousel-control-prev-icon"></span> </a> 
    <a class="carousel-control-next" style="bottom: 10%;" href="#custCarousel" data-slide="next"> <span class="border bg-secondary rounded carousel-control-next-icon"></span> </a> 
                    
    </div>
</div>
<!-- End Promotion banner by Lim Qiu Xiong-->

    <!--Main Navigation-->
    <!--Main layout-->
    <main class="mt-5">
    <div class="container">
        
      <section class="text-center">
        <div class="ratingContainer shadow rounded">
          <div class="row">
            <div class="col list-parent"> 
              <i class="fa fa-star"></i>
              <?php
                  $sql ="SELECT sp.shop_id, sp.shop_name, COALESCE(ROUND(AVG(rr.rating), 1),'Not Rated')  AS shop_rating
                      FROM  shopProfile sp LEFT JOIN reviewRating rr
                      ON sp.shop_id = rr.seller_id
                      WHERE rr.disable_date IS NULL && sp.shop_id = '$i_shop_id'
                      GROUP BY sp.shop_id
                      LIMIT 1";
                  if($stmt = mysqli_prepare ($conn, $sql)){
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $f1,$f2,$f3);
                    
                    while(mysqli_stmt_fetch($stmt)){
                      echo"<span>$f3</span>";
                    }
                    mysqli_stmt_close($stmt);												
                  }														
                ?>
            </div>
            <div class="col list-parent"> 
              <i class="fa fa-gift"></i>
              <span><?php echo($shop_totalProduct); ?></span>
            </div>
            <div class="col list-parent"> 
              <i class="fa fa-calendar"></i>
              <span><?php echo($shop_joinby); ?></span>
            </div>
          </div>
        </div>
      </section><br>

        <section class="text-center">
          <h4 class="mb-5"><strong>Shop Voucher</strong></h4>
          <div class="d-flex align-items-center"> <!--<div class="voucherContainer d-flex align-items-center">-->
          <?php
                  if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row2 = $result2->fetch_assoc()) {
          ?>
          <div class="row overflow-scroll">
            <div class="voucher">
              <div class="coupon-card">
                <!--<img src="https://cdn.mos.cms.futurecdn.net/tQxVwcJSowYD7xwWDYidd9.jpg" class="logo">-->
                <!--<h3>20% flat off on all rides within the city <br> using HDFC Credit Card</h3>-->
                <h3>RM
                  <?php echo " " . $row2["discount_amount"]. " "; ?>
                </h3>
                
                <div class="coupon-row">
                  <span id="cpnCode"><?php echo " " . $row2["voucher_code"]. " "; ?></span>
                  <span id="cpnBtn">COPY</span>
                </div>
                
                <p>
                  <?php echo " From " . $row2["voucher_startdate"]. " till " . $row2["voucher_expired"]. " "; ?>
                </p>
                
                <!--<div class="circle1"></div>
                <div class="circle2"></div>-->
              </div>
            </div>
            <?php
                }
              } else {
                echo "<div class=\"text-center\" style=\"flex:auto;\"><p class=\"p-title\">No Voucher.</p></div>";
              }
              $conn->close();
            ?>
          </div>
        </section>

        <hr class="my-5" />

        <!--Section: Content-->
        <section class="text-center">
          <h4 class="mb-5"><strong>Best Sales</strong></h4>
          <div class="row">
            <?php
              if ($result1->num_rows > 0) {
                // output data of each row
                while($row1 = $result1->fetch_assoc()) {
            ?>
            
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card"><!--<div class="card" style="height:50vh;">-->
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                  <img
                    src="/img/product/<?php echo $row1['product_cover_picture']?>"
                    class="imgContainer"
                  />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <?php
                      echo " " . $row1["product_name"]. "<br>" . $row1["product_description"]. "<br>RM " . $row1["product_price"]. "<br>";
                  ?>
                  <!--<a href="#!" class="btn btn-primary">Button</a>-->
                </div>
              </div>
            </div>
            <?php
                }
              } else {
                echo "<div class=\"text-center\" style=\"flex:auto;\"><p class=\"p-title\">No item.</p></div>";
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
      .voucher{
        margin: 0 10px 0 0;
      }

      .coupon-card{
         background: linear-gradient(135deg, #7158fe, #9d4de6);
         color: #fff;
         text-align: center;
         padding: 10px 45px;
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
        margin: 10px auto;
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
        top: 14.5%;
        transform: translateY(-50%);
      }
      
      .circle1{
        left: 40px;
      }
      
      .circle2{
        right: 925px;
      }

      .imgContainer
      {
        height: 22vh;
        width: 20vh;
      }

      /*Promotion banner by Lim Qiu Xiong*/

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
      /*End Promotion banner by Lim Qiu Xiong*/
    </style>

    <script>
       var cpnBtn = document.getElementById("cpnBtn");
       var cpnCode = document.getElementById("cpnCode");
       
       cpnBtn.onclick = function(){
         navigator.clipboard.writeText(cpnCode.innerHTML);
         cpnBtn.innerHTML = "COPIED";
         setTimeout(function(){
           cpnBtn.innerHTML = "COPIED";
         }, 3000);
       }
    </script>

    <?php
    require __DIR__ . '/footer.php'
?>
