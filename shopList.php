<?php
    require_once __DIR__ . '/header.php'
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">

<div class="container">
  <div class="row mb-5">
    <div class="col-xl-2 col-lg-2 col-sm-2">
      <div class="image-container shadow" style="">
          <img class="" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
      </div>
      <div class="viewBtn">
        <button style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button>
      </div>
    </div>
    <div class="col-xl-10">
      <div class="description">
        <p class="descriptionContainer1">
          <i class="bi bi-people-fill"></i>
          Joined 
          <span id="" style="color: red;">2021</span> 
          <i class="fa fa-rating"></i>
          Rating 
          <span id="" style="color: red;">4.9 out of 5.0</span>
          <br> 
          <i class="fa fa-rating"></i>
          Products 
          <span id="" style="color: red;">12</span>
        </p>
      </div>
    </div>
  </div>

  <div class="row mb-5">
    <div class="col-xl-2 col-lg-2 col-sm-2">
      <div class="image-container shadow" style="">
          <img class="" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
      </div>
      <div class="viewBtn">
        <button style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button>
      </div>
    </div>
    <div class="col-xl-10">
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
    </div>
  </div>
  
  <div class="row mb-5">
    <div class="col-xl-2 col-lg-2 col-sm-2">
      <div class="image-container shadow" style="">
          <img class="" style="object-fit:contain;width:100%;height:100%" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-se-white-select-2020?wid=834&hei=1000&fmt=jpeg&qlt=95&.v=1586574259457" alt="Card image cap">
      </div>
      <div class="viewBtn">
        <button style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button>
      </div>
    </div>
    <div class="col-xl-10">
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
    </div>
  </div>
  
  <div class="float-end">
    <button class="nextBtn border border-1 rounded-pill text-center">-></button>
  </div>
</div>

<?php
    require __DIR__ . '/footer.php'
?>

<style>
.image-container{
  height:20vh;
  z-index:3;
  position:relative;
  border-radius:0.5rem;
}

.description{
  margin-top: 4%;
  position: absolute;
  height: 18vh;
  margin-left: -5%;
  z-index: 1;
  padding: 30px 100px;
  border-radius: 5px;
  background-color: #EEEDEE;
  width:100%;
}

.viewBtn{
  position: absolute;
  margin-top: -50px;
  margin-left: 75%;
  z-index: 3;
}

/* display  content center
.center{
  display: flex;
  justify-content: center;
} */

.nextBtn{
  width: 45px;
  margin: 0 20px 10px 0;
  background-color: white;
} 
</style>
