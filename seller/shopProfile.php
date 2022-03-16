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
  <div class="container profileContainer">
    <div class="row">
      <div>
      <img class="relative bg-image img-fluid" src="https://edufair.fsi.com.my/img/sponsor/20/cover_1530346726.jpeg">
      <div class="absolute">
        <input type="file" id="actual-btn" hidden/>
        <label for="actual-btn" class="editBtn"><i class="far fa-image"></i> Edit Cover Photo</label>
      </div>
      <div class="sellerPicContainer text-center"><img id="" class="sellerPic" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle"></div><br><br>
      </div>
    </div>
    <div class="row">
      <label class="form-label">Shop Name</label><br>
      <input type="text" class="form-control" id="customFile" />
    </div>  
    <div class="row">
      <label class="form-label">Shop Description</label><br>
      <textarea class="form-control" id="customFile" rows="3"></textarea>
    </div>
    <div class="row">
      <div id="uploadContainer" class="imageContainer">
        <!-- Image display frame (place where the image will display)
          <img id="frame" src="" class="img-fluid" />
        -->
        <label for="uploadBtn" id="myLabel" onclick="hideLabel()"><b>+</b><br>Add Image & Video</label>
        <input class="form-control " type="file" id="uploadBtn" onchange="preview()" rows="3" multiple hidden/>       
      </div>
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

.relative {
  position: relative;
} 

div.absolute {
  position: absolute;
  top: 470px;
  right: 180px;
}

.editBtn {
  background-color: white;
  padding: 0.5rem;
  border-radius: 0.3rem;
  cursor: pointer;
  margin-top: 1rem;
}

.sellerPic{
  position: absolute;
  width: 50px;
  height: 50px;
  
}

#uploadContainer {
  width: 30%;
  border: 1px solid #ADADAD;
  border-radius: 5px;
  color: #ADADAD;
  padding: 30px 0;
  text-align: center;
  margin-top: 20px;
}

.buttonContainer{
  float:center;
}

.saveBtn{
  background-color: #0C1236;
  color: white;
  border: none;
  padding: 5px 30px;
  margin: 20px 0 0 0;
}
</style>

<script>
function hideLabel() {
var x = document.getElementById("myLabel");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

/* Preview Image 
function preview() {
                frame.src = URL.createObjectURL(event.target.files[0]);
            }
*/

/* Preview Multiple Images */
$(function() {
  $(":file").change(function() {
    if (this.files && this.files[0]) {
      for (var i = 0; i < this.files.length; i++) {
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[i]);
      }
    }
  });
});

function imageIsLoaded(e) {
  $('.imageContainer').append('<img src=' + e.target.result + '>');
};
</script>
