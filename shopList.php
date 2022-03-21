<?php
    require __DIR__ . '/header.php'
?>

<div class="container">
  <div class="row row1">
  <div class="list">
    <div id="image1" class="shadow rounded"><img src="https://eduadvisor.my/wp-content/uploads/2015/07/segi-logo-square-150x150.png"></div>
    <div id="description1"><p class="descriptionContainer1">Joined <span id="" style="color: red;">2021</span> Rating <span id="" style="color: red;">4.9 out of 5.0</span><br> Products <span id="" style="color: red;">12</span></p></div>
    <div id="viewBtn1"><button style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button></div>
  </div>
  </div>

  <div class="row row2">
  <div class="list">
  <div id="image2" class="shadow rounded"><img src=""></div>
    <div id="description2"><p class="descriptionContainer2">Joined <span id="" style="color: red;">2021</span> Rating <span id="" style="color: red;">4.9 out of 5.0</span><br> Products <span id="" style="color: red;">12</span></p></div>
    <div id="viewBtn2"><button style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button></div>
  </div>
  </div>
  
  <div class="row row3">
  <div class="list">
    <div id="image3" class="shadow rounded"><img src=""></div>
    <div id="description3">Joined <span id="" style="color: red;">2021</span> Rating <span id="" style="color: red;">4.9 out of 5.0</span><br> Products <span id="" style="color: red;">12</span></div>
    <div id="viewBtn3"><button style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button></div>
  </div>
  </div>
</div>

<?php
    require __DIR__ . '/footer.php'
?>

<style>
.row1{
  position: relative; /*fix the position of the div in row1*/
}

#description1{
    position: absolute;
    z-index: 1;
    margin: 30px 50px;
    padding: 30px 120px;
    border-radius: 5px;
    background-color: #EEEDEE;
}
#image1{
  position: absolute;
  z-index: 2;
  height: 100px;
  width: 100px;
}

#viewBtn1{
  position: absolute;
  z-index: 3;
  height: 100px;
  width: 500px;
  margin: 65px 80px;
}

.row2{
  position:absolute; /*set the position of the div of row2 not fix at a place*/
  margin: 200px 0;
}

#description2{
    position: absolute;
    z-index: 1;
    width: 500px;
    margin: 30px 50px;
    padding: 30px 0;
    text-align: center;
    border-radius: 5px;
    background-color: #EEEDEE;
}
#image2{
  position: absolute;
  z-index: 2;
  height: 100px;
  width: 100px;
}

#viewBtn2{
  position: absolute;
  z-index: 3;
  height: 100px;
  width: 500px;
  margin: 65px 80px;
}

.row3{
  position:absolute; /*set the position of the div of row2 not fix at a place*/
  margin: 400px 0;
}

#description3{
    position: absolute;
    z-index: 1;
    width: 500px;
    margin: 30px 50px;
    padding: 30px 0;
    text-align: center;
    border-radius: 5px;
    background-color: #EEEDEE;
}
#image3{
  position: absolute;
  z-index: 2;
  height: 100px;
  width: 100px;
}

#viewBtn3{
  position: absolute;
  z-index: 3;
  height: 100px;
  width: 500px;
  margin: 65px 80px;
}
</style>
