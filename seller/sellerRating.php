<?php
    require __DIR__ . '/header.php'
?>

<?php
  $shopId = $_SESSION['userid'];
  $sql_shop = "SELECT * FROM shopProfile WHERE shop_id = '$shopId'";
  $rating_result = mysqli_query($conn, $sql_shop);
?>

<?php
  $sql_user = "SELECT username FROM user
  INNER JOIN reviewRating
  ON user.user_id = reviewRating.user_id";

  $user_result = mysqli_query($conn, $sql_user);
?>

<!-- Icon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
 
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">            
  <div class="container ratingContainer">

    <div class="row">
    <?php
        while ($row = mysqli_fetch_assoc($rating_result))
        {
          $shopName = $row['shop_name'];
    ?>
      <img id="" class="sellerProfilePic" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle"><h5 class="ml-3"><?php echo $shopName ?></h5>
      <?php
        }
      ?>
    </div>

    <div class="row descriptionContainer">
      <p><b>Shop Description</b><br> Joined<span id=""></span> Rating<span id=""></span><br> Products<span id=""></span></p>
    </div>
    
    <div class="reviewContainer">
      <div class="row reviewTitle">
        <h4><b>User Review</b></h4>
      </div>

      <div class="row reviewContent">

        <?php
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $sql = "SELECT user.username, user.profile_picture, reviewRating.message, reviewRating.rating, reviewRating.pic1, reviewRating.pic2, reviewRating.pic3, reviewRating.pic4, reviewRating.pic5
          FROM reviewRating
          INNER JOIN user
          ON reviewRating.user_id = user.user_id
          WHERE seller_id = '$shopId'";
          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
        ?>

        <div class="col-lg-6 col-md-12">
          <p>
          <?php echo "" . $row["username"]. ""?> 
          <?php echo "<br>Rating: " . $row["rating"]. "<br>" . $row["message"]. "<br>" ?><img src="/img/rating/<?php echo $row['pic1']?>"/> <img src="/img/rating/<?php echo $row['pic2']?>"/> <img src="/img/rating/<?php echo $row['pic3']?>"/> <img src="/img/rating/<?php echo $row['pic4']?>"/> <img src="/img/rating/<?php echo $row['pic5']?>"/> <br><?php;
          ?>
          </p>
        </div>
        <?php
            }
           } else {
            echo "<br> 0 result";
          }
          $conn->close();
        ?>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
body{
background-color: #EEEDEE;
}
.ratingContainer{
  background-color: white;
  margin: 50px auto;
  padding: 30px;
}

.sellerProfilePic{
  width: 45px;
  height:45px;
}

.descriptionContainer{
  border:1.4px solid #E9E8E8;
  border-radius: 15px;
  margin-top: 20px;
  padding: 10px;
}

.reviewContainer{
  background-color: #EEEDEE;
  padding: 15px;
  margin: 30px 0;
}

.reviewTitle {
  background-color: #EEEDEE;
  padding: 15px;
}

.reviewContent{
  background-color: #EEEDEE;
}
</style>