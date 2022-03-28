<?php
    require_once __DIR__ . '/header.php'
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">

<div class="container">
  <form action="shopDetails.php">
  <div class="row mb-5">
    <div class="col-xl-2 col-lg-2 col-sm-2">
      <div class="image-container shadow" style="">
          <img class="" style="object-fit:contain;width:100%;height:100%" src="data:image/png;base64,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" alt="Card image cap">
      </div>
      <div class="viewBtn">
        <button type="submit" style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button>
      </div>
    </div>
    <div class="col-xl-10">
      <div class="description">
        <p class="descriptionContainer1">
          <i class="fa-light fa-people-group"></i>
          Joined 
          <span id="" style="color: red;">2021</span> 
          <i class="fa-regular fa-star"></i>
          Rating 
          <span id="" style="color: red;">4.9 out of 5.0</span>
          <br> 
          <i class="fa-regular fa-hand-holding-box"></i>
          Products 
          <span id="" style="color: red;">12</span>
        </p>
      </div>
    </div>
  </div>
  </form>

  <div class="row mb-5">
    <div class="col-xl-2 col-lg-2 col-sm-2">
      <div class="image-container shadow" style="">
          <img class="" style="object-fit:contain;width:100%;height:100%" src="https://gamingbolt.com/wp-content/uploads/2011/09/sony-logo.jpg" alt="Card image cap">
      </div>
      <div class="viewBtn">
        <button type="submit" style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button>
      </div>
    </div>
    <div class="col-xl-10">
      <div class="description">
        <p class="descriptionContainer1">
          <i class="fa-light fa-people-group"></i>
          Joined 
          <span id="" style="color: red;">2021</span> 
          <i class="fa-regular fa-star"></i>
          Rating 
          <span id="" style="color: red;">4.9 out of 5.0</span>
          <br> 
          <i class="fa-regular fa-hand-holding-box"></i>
          Products 
          <span id="" style="color: red;">12</span>
        </p>
      </div>
    </div>
  </div>
  
  <div class="row mb-5">
    <div class="col-xl-2 col-lg-2 col-sm-2">
      <div class="image-container shadow" style="">
          <img class="" style="object-fit:contain;width:100%;height:100%" src="https://vectorlogo4u.com/wp-content/uploads/2019/10/STARBUCKS-Logo-Vector.png" alt="Card image cap">
      </div>
      <div class="viewBtn">
        <button type="submit" style="background-color: #1A2C42; color: white; border: none; padding: 5px 10px;">View</button>
      </div>
    </div>
    <div class="col-xl-10">
      <div class="description">
        <p class="descriptionContainer1">
          <i class="fa-light fa-people-group"></i>
          Joined 
          <span id="" style="color: red;">2021</span> 
          <i class="fa-regular fa-star"></i>
          Rating 
          <span id="" style="color: red;">4.9 out of 5.0</span>
          <br> 
          <i class="fa-regular fa-hand-holding-box"></i>
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
