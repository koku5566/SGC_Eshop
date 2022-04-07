<?php
    require __DIR__ . '/header.php'
?>

<!-- Icon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
 
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">            
  <div class="container ratingContainer">
    <div class="row">
      <img id="" class="sellerProfilePic" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle"><h5>SEGi College Subang Jaya</h5>
    </div>
    <div class="row descriptionContainer">
      <p><b>Shop Description</b><br> Joined<span id=""></span> Rating<span id=""></span><br> Products<span id=""></span></p>
    </div>
    <div class="row reviewContainer">
      <h4><b>User Review</b></h4>
      <p><span id="">

      <?php
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT product_id, user_id, message, rating, pic1 FROM reviewRating";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "Product id: " . $row["product_id"]. " User id: " . $row["user_id"]. " " . $row["message"]. "Rating: " . $row["rating"]. " " . $row["pic1"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>

      </span></p>
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
  width: 50px;
  height:40px;
}

.descriptionContainer{
  border:1.4px solid #E9E8E8;
  border-radius: 15px;
  margin-top: 20px;
  padding: 10px;
}

.reviewContainer{
  background-color: #EEEDEE;
  margin: 30px 0;
  padding: 15px;
  height: 200px; //should be remove after adding the review (id inside span of review)
}
</style>