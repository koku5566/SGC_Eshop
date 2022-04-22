<?php
    require __DIR__ . '/header.php'
?>

<!-- Insert data -->
<?php
//    if(isset($_POST['saveBtn'])){
//      //if(!empty($_POST['coverPhoto']) && !empty($_POST['profileImage']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['imageVideo'])){
//        $coverPhoto = $_POST['coverPhoto'];
//        $profileImage = $_POST['profileImage'];
//        $name = $_POST['name'];
//        $description = $_POST['description'];
//        $imageVideo = $_POST['imageVideo'];
//
//        $query = "INSERT INTO shopProfile(shop_profile_cover,shop_profile_image,shop_name,shop_description, shop_media) VALUES ('$coverPhoto','$profileImage','$name','$description','$imageVideo')";
//
//        //$run = mysqli_query($conn,$query);
//        if (mysqli_query($conn, $query)) {
//          echo "Form Submitted Successfully" ;
//        } else {
//          echo "Error: " . $query . "<br>" . mysqli_error($conn);
//        }
//        mysqli_close($conn);
//    }
?>

<!-- Select Data -->
<?php
  $sql = "SELECT * FROM shopProfile WHERE shop_id = 'U000001'";
  $result1 = mysqli_query($conn, $sql); 
?>

<!-- Update Profile -->
<?php
  session_start();
 if(isset($_POST['saveBtn']))
 {
  $profileIMG = array_filter($_FILES['profileImage']['name']);
  $targetDir = dirname(__DIR__, 1) . "/img/shop_logo/";
  $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'jfif');
  $profilePic = "";
  //$imageProperties = getimageSize($_FILES['profileImage']['tmp_name']);
  $coverImgContent = addslashes(file_get_contents($_FILES['profileImage']['name']));
  if (!empty($profileIMG)) {
      foreach ($_FILES['profileImage']['name'] as $key => $val) {
          // File upload path 
          echo (var_dump($_FILES['profileImage']));
          $fileName = basename($_FILES['profileImage']['name'][$key]);
          $ext = pathinfo($fileName, PATHINFO_EXTENSION);
          $fileName = round(microtime(true) * 1000) . "." . $ext;
          $targetFilePath = $targetDir . $fileName;
          echo ($targetFilePath);
          // Check whether file type is valid 
          $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
          if (in_array($fileType, $allowTypes)) {
              if (move_uploaded_file($_FILES["profileImage"]["tmp_name"][$key], $targetFilePath)) {
                  $profilePic = "$fileName";
              }
          }
      }
  }

  $coverIMG = array_filter($_FILES['profileCover']['name']);
  $targetDir = dirname(__DIR__, 1) . "/img/shop_logo/";
  $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'jfif');
  $profileCover = "";
  //$imageProperties = getimageSize($_FILES['profileCover']['tmp_name']);
  $coverImgContent = addslashes(file_get_contents($_FILES['profileCover']['name']));
  if (!empty($profileIMG)) {
      foreach ($_FILES['profileCover']['name'] as $key => $val) {
          // File upload path 
          echo (var_dump($_FILES['profileCover']));
          $fileName = basename($_FILES['profileCover']['name'][$key]);
          $ext = pathinfo($fileName, PATHINFO_EXTENSION);
          $fileName = round(microtime(true) * 1000) . "." . $ext;
          $targetFilePath = $targetDir . $fileName;
          echo ($targetFilePath);
          // Check whether file type is valid 
          $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
          if (in_array($fileType, $allowTypes)) {
              if (move_uploaded_file($_FILES["profileCover"]["tmp_name"][$key], $targetFilePath)) {
                  $profileCover  = "$fileName";
              }
          }
      }
  }
    $shopName = $_POST['name'];
    $shopDescription = $_POST['description'];

    $update = "UPDATE shopProfile SET shop_profile_cover='$profileCover', shop_profile_image='$profilePic', shop_name='$shopName', shop_description='$shopDescription', shop_media='$shopMedia' WHERE shop_id = 'U000001'";

      if (mysqli_query($conn, $update))
      { 
          /*Successful*/
          //header("refresh:1; url=shopProfile.php");
          echo 'Success';
      }
      else
      {
          /*Fail*/
          echo 'Update Fail';
      }
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

      <?php
        while ($row=mysqli_fetch_assoc($result1))
        {
          $shopCoverImage = $row['shop_profile_cover'];
          $shopProfilePic = $row['shop_profile_image'];
          $shopName = $row['shop_name'];
          $shopDescription = $row['shop_description'];
      ?>

      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

      <img class="relative bg-image img-fluid" id="backgroundImage" name="backgroundImage" src="/img/shop_logo/<?php echo $row['shop_profile_cover']?>"><br><br> <?php //echo $shopProfilePic ?>
      <div class="absolute">
        <input type="file" id="actual-btn" name="profileCover[]" onchange="loadCover(event)" hidden/>
        <label for="actual-btn" class="editBtn"><i class="far fa-image"></i> Edit Cover Photo</label>
      </div>
      <!--<div class="sellerPicContainer mx-auto d-block"><img id="" class="sellerPic" name="profileImage" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle"></div><br><br>
      </div>-->
      <div class="profile-pic"> 
        <label class="-label" for="file">
          <span class="glyphicon glyphicon-camera"></span>
          <span>Change<br>Image</span>
        </label>
        <input id="file" type="file" name="profileImage[]" value="" onchange="loadImage(event)"/>
        <img src="/img/shop_logo/<?php echo $row['shop_profile_image']?>" id="profileImage" name="profileImage" class="mb-2" width="200"/>
      </div>
    </div>
    
    <div class="row">
      <label class="form-label">Shop Name</label><br>
      <input type="text" class="form-control" name="name" value="<?php echo $shopName ?>" required />
    </div>  
    <div class="row">
      <label class="form-label">Shop Description</label><br>
      <textarea class="form-control"  rows="3" name="description"><?php echo $shopDescription ?></textarea>
    </div>
    <!--<div class="row">
      <div id="uploadContainer" name="mediaContainer" class="imageContainer clearfix">
         Image display frame (place where the image will display)
          <img id="frame" src="" class="img-fluid" />
        
        <label for="uploadBtn" id="myLabel" onclick="hideLabel()"><b>+</b><br>Add Image & Video</label>
        <input class="form-control" type="file" id="uploadBtn" name="" onchange="preview()" width="100px" height="100px" multiple hidden/>       
      </div>
    </div>-->


    <div class="text-center">
      <button type="submit" class="saveBtn" id="saveBtn" name="saveBtn">Save</button>
    </div> 
    </form>
  </div>
  <?php
    }
  ?>
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

/*.sellerPic{
  position: absolute;
  width: 50px;
  height: 50px;
  top: 45%;
  left: 55%;
}*/

.profile-pic {
  color: transparent;
  transition: all 0.3s ease;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  transition: all 0.3s ease;
  margin: 20px;
}
.profile-pic input {
  display: none;
}
.profile-pic img {
  position: absolute;
  object-fit: cover;
  width: 65px;
  height: 65px;
  box-shadow: 0 0 10px 0 rgba(255, 255, 255, 0.35);
  border-radius: 100px;
  left: 300px;
}
.profile-pic .-label {
  position: absolute;
  cursor: pointer;
  height: 65px;
  width: 65px;
  left: 300px;
}
.profile-pic:hover .-label {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.8);
  z-index: 10000;
  color: #fafafa;
  transition: background-color 0.2s ease-in-out;
  border-radius: 100px;
  margin-bottom: 0;
}
.profile-pic span {
  display: inline-flex;
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

/* Profile image review */
var loadImage = function (event) {
var image = document.getElementById("profileImage");
image.src = URL.createObjectURL(event.target.files[0]);
};

/* Cover photo review */
var loadCover = function (event) {
var image = document.getElementById("backgroundImage");
image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
