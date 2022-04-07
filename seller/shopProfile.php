<?php
    require __DIR__ . '/header.php'
?>

<?php
    if(isset($_POST['submit'])){
      //if(!empty($_POST['coverPhoto']) && !empty($_POST['profileImage']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['imageVideo'])){
        $coverPhoto = $_POST['coverPhoto'];
        $profileImage = $_POST['profileImage'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $imageVideo = $_POST['imageVideo'];

        $query = "INSERT INTO shopProfile(shop_profile_cover,shop_profile_image,shop_name,shop_description, shop_media) VALUES ('$coverPhoto','$profileImage','$name','$description','$imageVideo')";

        //$run = mysqli_query($conn,$query);
        if (mysqli_query($conn, $query)) {
          echo "Form Submitted Successfully" ;
        } else {
          echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
        //if($run){
        //  echo "Form Submitted Successfully" ;
        //}
        //else{
        //  echo "Form not submitted";
        //}

      //}
      //else{
      //  echo "all fields required";
      //}
    }
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
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <img class="relative bg-image img-fluid" src="https://edufair.fsi.com.my/img/sponsor/20/cover_1530346726.jpeg">
      <div class="absolute">
        <input type="file" id="actual-btn" name="coverPhoto" hidden/>
        <label for="actual-btn" class="editBtn"><i class="far fa-image"></i> Edit Cover Photo</label>
      </div>
      <div class="sellerPicContainer rounded mx-auto d-block"><img id="" class="sellerPic" name="profileImage" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle"></div><br><br>
      </div>
    </div>
    
    <div class="row">
      <label class="form-label">Shop Name</label><br>
      <input type="text" class="form-control" name="name"/>
    </div>  
    <div class="row">
      <label class="form-label">Shop Description</label><br>
      <textarea class="form-control"  rows="3" name="description"></textarea>
    </div>
    <div class="row">
      <div id="uploadContainer" class="imageContainer clearfix">
        <!-- Image display frame (place where the image will display)
          <img id="frame" src="" class="img-fluid" />
        -->
        <label for="uploadBtn" id="myLabel" onclick="hideLabel()"><b>+</b><br>Add Image & Video</label>
        <input class="form-control" type="file" id="uploadBtn" name="imageVideo" onchange="preview()" width="100px" height="100px" multiple hidden/>       
      </div>
    </div>
    <div class="text-center">
      <button type="submit" class="saveBtn" name="submit">Save</button>
    </div> 
    </form>
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
  top: 490px;
  right: 180px;
}

.editBtn {
  background-color: white;
  padding: 5px;
  border-radius: 3px;
  cursor: pointer;
  margin-top: 10px;
}

.sellerPic{
  position: absolute;
  width: 50px;
  height: 50px;
  top: 45%;
  left: 55%;
  
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

.clearfix {
  overflow: auto;
}

.buttonContainer {
  text-align:center;
}

.saveBtn {
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
