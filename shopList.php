<?php
    require_once __DIR__ . '/header.php'
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">

<div class="container">
  <div class="row">
    <div class="list">
      <div class="image-container">
          <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
      </div>
      <div class="description">
        <p class="descriptionContainer1">
          <i class="bi bi-people-fill"></i>
          Joined 
          <span id="" style="color: red;">2021</span> 
          <i class="far fa-rating"></i>
          Rating 
          <span id="" style="color: red;">4.9 out of 5.0</span>
          <br> 
          <i class="far fa-rating"></i>
          Products 
          <span id="" style="color: red;">12</span>
        </p>
      </div>
      <div class="viewBtn">
        <button style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="list">
      <div class="image"><img src=""></div>
      <div class="description">
        <p class="descriptionContainer1">
          <i class="bi bi-people-fill"></i>
          Joined 
          <span id="" style="color: red;">2021</span> 
          <i class="far fa-rating"></i>
          Rating 
          <span id="" style="color: red;">4.9 out of 5.0</span>
          <br> 
          <i class="far fa-rating"></i>
          Products 
          <span id="" style="color: red;">12</span>
        </p>
      </div>
      <div class="viewBtn">
        <button style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="list">
      <div class="image"><img src=""></div>
      <div class="description">
        <p class="descriptionContainer1">
          <i class="bi bi-people-fill"></i>
          Joined 
          <span id="" style="color: red;">2021</span> 
          <i class="far fa-rating"></i>
          Rating 
          <span id="" style="color: red;">4.9 out of 5.0</span>
          <br> 
          <i class="far fa-rating"></i>
          Products 
          <span id="" style="color: red;">12</span>
        </p>
      </div>
      <div class="viewBtn">
        <button style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button>
      </div>
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
    padding: 30px 145px;
    border-radius: 5px;
    background-color: #EEEDEE;
}
#image1{
  position: absolute;
  z-index: 2;
  height: 100px;
  width: 100px;
  border-radius: 5px;
  background-color: maroon;
}

#viewBtn1{
  position: absolute;
  z-index: 3;
  height: 100px;
  width: 500px;
  margin: 65px 80px;
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
  border-radius: 5px;
  background-color: maroon;
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
  border-radius: 5px;
  background-color: maroon;
}

#viewBtn3{
  position: absolute;
  z-index: 3;
  height: 100px;
  width: 500px;
  margin: 65px 80px;
}
</style>
