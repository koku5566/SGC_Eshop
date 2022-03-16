<?php
    require __DIR__ . '/header.php'
?>
  
  <!-- Icon -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  
  <!-- Preview Image -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
  <div class="container reportContainer">
    <div class="row">
      <img id="" class="sellerProfilePic" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle"><h4>SEGi College Subang Jaya</h4>
    </div>
    <div class="row statisticContainer">
      <h3><b>Sales Statistic</b><span id=""></span></h3>
    </div>
    <div class="row categoryContainer">
      <h3><b>Sales by Category</b></h3>
      <p><span id=""></span></p>
    </div>
    <button class="printButton float-end">PRINT REPORT</button>
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
.reportContainer{
  background-color: white;
  margin: 25px auto;
  padding: 30px;
}

.sellerProfilePic{
  width: 70px;
  height:40px;
}

.statisticContainer{
  background-color: grey;
  margin-top: 20px;
  padding: 5px;
  height: 200px; //should be remove after adding the review (id inside span of review)
}

.categoryContainer{
  background-color: #EEEDEE;
  margin-top: 30px;
  padding: 5px;
  height: 200px; //should be remove after adding the review (id inside span of review)
}

.printButton{
  background-color: #0C1236;
  color: white;
  border: none;
  margin-top: 5px;
  padding: 5px 25px;
}
</style>