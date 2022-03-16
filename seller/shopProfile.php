<?php
    require __DIR__ . '/header.php'
?>

<!-- Icon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
  <div class="container profileContainer">
    <div class="row">
      <div>
      <img class="relative bg-image" src="https://edufair.fsi.com.my/img/sponsor/20/cover_1530346726.jpeg">
      <div class="absolute"><button class="editBtn"><i class="far fa-image"></i> Edit Cover Photo</button></div>
      <div class="sellerPicContainer"><img id="" class="sellerPic" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle"></div>
      </div>
    </div>
    <div class="row">
      <br><br><label class="form-label">Shop Name</label><br>
      <input type="text" class="form-control" id="customFile" />
    </div>  
    <div class="row">
      <label class="form-label">Shop Description</label><br>
      <textarea class="form-control" id="customFile" rows="3"></textarea>
    </div>
    <div class="row">
      <label class="form-label" for="formFileMultiple">Images/Video</label>
      <input type="file" class="form-control" id="formFileMultiple" multiple>
    </div>
    <div class="row buttonContainer">
      <button class="saveBtn">Save</button>
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

.profileContainer{
  background-color: white;
  padding: 50px;
  margin: 30px auto;
}

.buttonContainer{
  float: right;
}

.relative {
  position: relative;
  height: 310px;
} 

div.absolute {
  position: absolute;
  top: 420px;
  right: 250px;
}

.sellerPic{
  position: absolute;
  width: 50px;
  height: 50px;
  top: 51%;
  left: 60%;
  transform: translate(-50%, -50%);
}

.editBtn{
  background-color: white;
  border: none;
  border-radius: 3px;
}

.saveBtn{
  background-color: #0C1236;
  color: white;
  border: none;
  padding: 5px 30px;
  margin: 20px 0 0 0;
}
</style>
