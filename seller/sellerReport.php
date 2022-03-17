<?php
    require __DIR__ . '/header.php'
?>
  
<!-- Icon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
  <div class="container reportContainer">
    <div class="row">
      <img id="" class="sellerProfilePic" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle"><h5>SEGi College Subang Jaya</h5>
    </div>
    <div class="row statisticContainer">
      <h4><b>Sales Statistic</b><span id=""></span></h4>
    </div>
    <div class="row categoryContainer">
      <h4><b>Sales by Category</b></h4>
      <p><span id=""></span></p>
    </div>
    <button id="btnPrint" class="printButton text-right">PRINT REPORT</button>
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
  width: 50px;
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

<script>
const $btnPrint = document.querySelector("#btnPrint");
$btnPrint.addEventListener("click", () => {
    window.print();
});
</script>