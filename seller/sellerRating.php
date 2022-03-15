<?php
    require __DIR__ . '/header.php'
?>

<title>Shop Rating</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  
<!-- Icon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
<!-- Preview Image -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">            
  <div class="container ratingContainer">
    <div class="row">
      <img id="" class="sellerProfilePic" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle"><h4>SEGi College Subang Jaya</h4>
    </div>
    <div class="row descriptionContainer">
      <p><b>Shop Description</b><br> Joined<span id=""></span> Rating<span id=""></span><br> Products<span id=""></span></p>
    </div>
    <div class="row reviewContainer">
      <h3><b>User Review</b></h3>
      <p><span id=""></span></p>
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
  width: 70px;
  height:55px;
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