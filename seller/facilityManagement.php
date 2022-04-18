<?php
   require __DIR__ . '/header.php'
  
?> 
<?php
   if(isset($_POST['AddFacility']))
   {
      //$campusId = $_SESSION['userId'];
      $campusId = "14";
      $title = $_POST['title'];
      $description = $_POST['description'];
      $address = $_POST['address'];
      $priceperhour = $_POST['priceperhour'];
      $contact = $_POST[''];

      // File upload configuration 
      $fileNames = array_filter($_FILES['img']['name']); 
      $imgInpCounter = 0;
      $targetDir = dirname(__DIR__,1)."/img/facility/"; 
      echo($targetDir);
      $allowTypes = array('jpg','png','jpeg'); 

      $sql_insert  = "INSERT INTO facilityPic (";
      $sql_insert .= "facility_id, title, price_per_hour, pic_description, address, ";
      $sql_insert .= "contact_whatsapp, pic_cover, pic1, pic2, pic3, pic4, campus_id ";
      $sql_insert .= ") ";
      $sql_insert .= "VALUES ((SELECT CONCAT('F',(SELECT LPAD((SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'sgcprot1_SGC_ESHOP' AND TABLE_NAME = 'facilityPic'), 6, 0))) AS newCombinationId),'$title','$priceperhour','$description','$address', ";
      $sql_insert .= "'$contact', ";

      foreach($_FILES['img']['name'] as $key=>$val){ 
         // File upload path 
         $fileName = basename($_FILES['img']['name'][$key]); 
         $ext = pathinfo($fileName, PATHINFO_EXTENSION);
         $fileName = round(microtime(true) * 1000).".".$ext;
         $targetFilePath = $targetDir.$fileName; 
         // Check whether file type is valid 
         $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
         if(in_array($fileType, $allowTypes)){ 
            if(move_uploaded_file($_FILES["img"]["tmp_name"][$key], $targetFilePath)){ 
               $sql_insert .= "'$fileName', ";
               $imgInpCounter++;
            }
         }
     } 

     //Enter empty for picture col that did not use
     while($imgInpCounter < 5)
     {
         $sql_insert .= "'', ";
         $imgInpCounter++;
     }

     $sql_insert .= "'$campusId'";
     $sql_insert .= ") ";

     if(mysqli_query($conn, $sql_insert)){
         ?>
             <script type="text/javascript">
                 //window.location.href = window.location.origin + "/seller/myProduct.php";
             </script>
         <?php
         
     }
     else
     {
         echo '<script language="javascript">';
         echo 'alert("Fail to Add Facility")';
         echo '</script>';
     }
   }

   $sql_2 = "SELECT * FROM facilityPic";
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<!-- Select datatable CSS-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">


<!-- Page Content -->
<div class="container p-2" style="background-color: #FFFFFF; width:80%;">
   <h2 class="m-4">Facility Management</h2>
   <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="container m-2">
         <h5 class="mt-2 mb-4">Basic Information</h5>
            <div class="row">
               <div class="form-group col-md-12">
                  <p class="p-title">Facility Name</p>
               </div>
               <div class="col-xl-10 col-lg-10 col-sm-12">
                  <div class="input-group mb-3">
                  <input type ="text" class="form-control" name="title" maxlength="1000" required>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-12">
                  <p class="p-title">Facility Description</p>
               </div>
               <div class="col-xl-10 col-lg-10 col-sm-12">
                  <div class="input-group mb-3">
                  <input type ="text" class="form-control" name="description" maxlength="1000" required>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-12">
                  <p class="p-title">Facility Address</p>
               </div>
               <div class="col-xl-10 col-lg-10 col-sm-12">
                  <div class="input-group mb-3">
                  <textarea class="form-control" name="address" maxlength="3000" required></textarea>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-12">
                  <p class="p-title">Hourly Rate</p>
               </div>
               <div class="col-xl-10 col-lg-10 col-sm-12">
                  <div class="input-group mb-3">
                     <input type="number"min="0" value="0" class="form-control" name="priceperhour" placeholder = "(RM)" required>
                  </div>
               </div>
            </div>
            <div class="form-row">   
               <div class="row">
                  <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                        <div class="drag-list">
                           <div class="row" style="margin-right: 0.5rem;margin-left: 0.5rem;">
                              <div style="padding-bottom: .625rem;display:flex">
                                    <div class="drag-item" draggable="true">
                                       <div class="image-container">
                                          <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                          <div class="image-layer">
                                                
                                          </div>
                                          <div class="image-tools-delete hide">
                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                          </div>
                                          <div class="image-tools-add">
                                                <label class="custom-file-upload">
                                                   <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                   <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                </label>
                                          </div>
                                       </div>
                                       <p>Cover Picture</p>
                                    </div>
                              </div>
                              <div style="padding-bottom: .625rem;display:flex">
                                    <div class="drag-item" draggable="true">
                                       <div class="image-container">
                                          <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                          <div class="image-layer">
                                                
                                          </div>
                                          <div class="image-tools-delete hide">
                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                          </div>
                                          <div class="image-tools-add">
                                                <label class="custom-file-upload">
                                                   <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                   <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                </label>
                                          </div>
                                       </div>
                                       <p>Picture 1</p>
                                    </div>
                                    <div class="drag-item" draggable="true">
                                       <div class="image-container">
                                          <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                          <div class="image-layer">
                                                
                                          </div>
                                          <div class="image-tools-delete hide">
                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                          </div>
                                          <div class="image-tools-add">
                                                <label class="custom-file-upload">
                                                   <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                   <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                </label>
                                          </div>
                                       </div>
                                       <p>Picture 2</p>
                                    </div>
                                    <div class="drag-item" draggable="true">
                                       <div class="image-container">
                                          <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                          <div class="image-layer">
                                                
                                          </div>
                                          <div class="image-tools-delete hide">
                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                          </div>
                                          <div class="image-tools-add">
                                                <label class="custom-file-upload">
                                                   <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                   <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                </label>
                                          </div>
                                       </div>
                                       <p>Picture 3</p>
                                    </div>
                                    <div class="drag-item" draggable="true">
                                       <div class="image-container">
                                          <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="">
                                          <div class="image-layer">
                                                
                                          </div>
                                          <div class="image-tools-delete hide">
                                                <i class="fa fa-trash image-tools-delete-icon" aria-hidden="true"></i>
                                          </div>
                                          <div class="image-tools-add">
                                                <label class="custom-file-upload">
                                                   <input accept=".png,.jpeg,.jpg" name="img[]" type="file" class="imgInp" multiple/>
                                                   <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                </label>
                                          </div>
                                       </div>
                                       <p>Picture 4</p>
                                    </div>
                              </div>
                           </div>
                        </div>
                  </div>
               </div>      
            </div>
            <div class="d-sm-flex align-items-center mb-4" style="justify-content: end;">
               <button type="submit" id="AddFacility" name="AddFacility" class="btn btn-outline-primary"></i>Add Facility</button>
            </div>
         </div>    
      </div>
   </form>
</div>
      
    </div>
  </div>
</div>

<style>

    @import "nib";

    [draggable] {
    user-select: none;
    }
    .drag-list {
        margin: 10px auto;
        flex-basis: 770px;
        display:flex;
    }
    .drag-item {
    transition: 0.25s;
    -webkit-box-flex: 0;
    -ms-flex: 0 0 80px;
    flex: 0 0 80px;
    width: 80px;
    max-width: 80px;
    min-height: 80px;
    max-height: 80px;
    margin: 0 16px 40px 0;
    }
    .drag-start {
    opacity: 0.8;
    }
    .drag-enter {
    opacity: 0.5;
    transform: scale(0.9);
    }

    .image-container{
        width: 80px;
        height: 80px;
        background-color: white;
    }

    .image-layer:hover ~ .image-tools-delete{
        display:block;
    }

    .image-layer{
        width: 80px;
        height: 80px;
        opacity:0.5;
        position:absolute;
        margin-top: -80px;
    }

    .image-tools-delete:hover{
        display:block;
    }

    .image-tools-delete{
        width: 80px;
        height: 30px;
        background:grey;
        position:absolute;
        margin-top: -30px;
    }

    .image-tools-delete-icon{
        color: white;
        justify-content: center;
        display: grid;
        margin-top: 5px;
        font-size: 20px;
    }


    .image-tools-add{
        width: 80px;
        height: 80px;
        background:white;
        opacity:0.5;
        position:absolute;
        margin-top: -80px;
        z-index:100;
    }

    .image-tools-add-icon{
        color: black;
        justify-content: center;
        display: grid;
        margin-top: 30px;
        font-size: 20px;
    }

    .custom-file-upload{
        width:100%;
        height:100%;
    }

    .imgInp{
        display:none;
    }

    .img-thumbnail{
        min-height: 0;
        border: 1px solid #e3e3e3;
        border-radius: 10px;
    }

    .hide{
        display:none;
    }

    .td-var1{
        border: none;
        padding: 0;
        margin: 0;
        font-weight: bold;
        color: #858796;
    }

    .td-var2{
        border: none;
        padding: 0;
        margin: 0;
        font-weight: bold;
        color: #858796;
    }

    .thInp{
        border: none;
        padding: 0;
        margin: 0;
        font-weight: bold;
        color: #858796;
    }

    .td-var1:focus,.td-var2:focus,.thInp:focus,.thInp:focus-visible
    {
        border: none;
        padding: 0;
        margin: 0;
        font-weight: bold;
        color: #858796;
        box-shadow: none;
    }

    .warning, .warning:focus{
        border:1px red solid;
    }

    .warning-message{
        color:red;
        font-weight:bold;
    }

</style>

<script>
    function DragNSort (config) {
        this.$activeItem = null;
        this.$container = config.container;
        this.$items = this.$container.querySelectorAll('.' + config.itemClass);
        this.dragStartClass = config.dragStartClass;
        this.dragEnterClass = config.dragEnterClass;
    }

    //#region Drag and Drop Classess
        DragNSort.prototype.removeClasses = function () {
            [].forEach.call(this.$items, function ($item) {
                $item.classList.remove(this.dragStartClass, this.dragEnterClass);
        }.bind(this));
        };

        DragNSort.prototype.on = function (elements, eventType, handler) {
            [].forEach.call(elements, function (element) {
            element.addEventListener(eventType, handler.bind(element, this), false);
        }.bind(this));
        };

        DragNSort.prototype.onDragStart = function (_this, event) {
            _this.$activeItem = this;

            this.classList.add(_this.dragStartClass);
            event.dataTransfer.effectAllowed = 'move';
            event.dataTransfer.setData('text/html', this.innerHTML);
        };

        DragNSort.prototype.onDragEnd = function (_this) {
            this.classList.remove(_this.dragStartClass);
        };

        DragNSort.prototype.onDragEnter = function (_this) {
            this.classList.add(_this.dragEnterClass);
        };

        DragNSort.prototype.onDragLeave = function (_this) {
            this.classList.remove(_this.dragEnterClass);
        };

        DragNSort.prototype.onDragOver = function (_this, event) {
            if (event.preventDefault) {
                event.preventDefault();
            }

            event.dataTransfer.dropEffect = 'move';
            return false;
        };

        DragNSort.prototype.onDrop = function (_this, event) {
            if (event.stopPropagation) {
                event.stopPropagation();
            }

            if (_this.$activeItem !== this) {
                _this.$activeItem.innerHTML = this.innerHTML;
                this.innerHTML = event.dataTransfer.getData('text/html');
            }

            _this.removeClasses();
            rearrangeLabel();

            return false;
        };

        DragNSort.prototype.bind = function () {
            this.on(this.$items, 'dragstart', this.onDragStart);
            this.on(this.$items, 'dragend', this.onDragEnd);
            this.on(this.$items, 'dragover', this.onDragOver);
            this.on(this.$items, 'dragenter', this.onDragEnter);
            this.on(this.$items, 'dragleave', this.onDragLeave);
            this.on(this.$items, 'drop', this.onDrop);
        };

        DragNSort.prototype.init = function () {
            this.bind();
        };
    //#endregion

    // Instantiate Picture Drag
    var draggable = new DragNSort({
        container: document.querySelector('.drag-list'),
        itemClass: 'drag-item',
        dragStartClass: 'drag-start',
        dragEnterClass: 'drag-enter'
    });
    draggable.init();

    initImages();

    function rearrangeLabel(){
        var draggableItem = document.querySelectorAll('.drag-item');
        var counter=1;
        var text = "";
        draggableItem.forEach(item => {

            switch(counter)
            {
                case 1:
                    text = "Cover Picture"
                    break;
                case 2:
                    text = "Picture 1"
                    break;
                case 3:
                    text = "Picture 2"
                    break;
                case 4:
                    text = "Picture 3"
                    break;
                case 5:
                    text = "Picture 4"
                    break;
            }

            item.getElementsByTagName('p')[0].innerHTML = text;
            counter++;
        });

        const deleteImg = document.querySelectorAll('.image-tools-delete-icon');

        deleteImg.forEach(img => {
            img.addEventListener('click', function handleClick(event) {
                img.parentElement.previousElementSibling.previousElementSibling.src="";
                img.parentElement.nextElementSibling.classList.remove("hide");
                img.parentElement.classList.add("hide");
            });
        });

        const imgInp = document.querySelectorAll('.imgInp');
        imgInp.forEach(img => {
            img.addEventListener('change', function handleChange(event) {
                const [file] = img.files
                if (file) {
                    img.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(file)
                    img.parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                    img.parentElement.parentElement.classList.add("hide");
                }
            });
        });
    }

    function initImages()
    {
        const deleteImg = document.querySelectorAll('.image-tools-delete-icon');

        deleteImg.forEach(img => {
            img.addEventListener('click', function handleClick(event) {
                img.parentElement.previousElementSibling.previousElementSibling.src="";
                img.parentElement.nextElementSibling.classList.remove("hide");
                img.parentElement.nextElementSibling.firstElementChild.firstElementChild.value=null;
                img.parentElement.nextElementSibling.firstElementChild.firstElementChild.nextElementSibling.value=null;
                img.parentElement.classList.add("hide");
            });
        });

        const imgInp = document.querySelectorAll('.imgInp');
        imgInp.forEach(img => {
            img.addEventListener('change', function handleChange(event) {
                const [file] = img.files;
                var maxsize = 2000000;
                var extArr = ["jpg", "jpeg", "png"];
                var imageValid = true;
                for (var a = 0; a < this.files.length; a++)
                {
                    var ext = img.files[a].name.split('.').pop();
                    if(img.files[a].size >= maxsize || !extArr.includes(ext))
                    {
                        imageValid = false;
                    }
                }

                if(imageValid)
                {
                    if (img.files && img.files[0] && img.files.length > 1) {
                        for (var j = 0,i = 0; i < this.files.length; i++) {
                            while(imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.getAttribute('src') != "" && j < 9)
                            {
                                j++;
                            }
                            if(j < 9)
                            {
                                imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(img.files[i]);
                                imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                                imgInp[j].parentElement.parentElement.classList.add("hide");
                            }
                        }
                    }
                    else if(img.files && img.files[0])
                    {
                        var j = 0;
                        if(img.files[0].size < maxsize)
                        {
                            while(imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.getAttribute('src') != "" && j < 9)
                            {
                                j++;
                            }

                            imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(img.files[0]);
                            imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                            imgInp[j].parentElement.parentElement.classList.add("hide");
                        }
                    }
                }
                else
                {
                    alert("This Image is not a valid format, only image that smaller than 2MB and with .jpg, .jpeg and .png extension are allowed");
                    img.value = "";
                }
            });
        });
    }

</script>

<!-- Datatable -->
<script charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<!-- Select datatable JS-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script type ="module" src="../bootstrap/js/bootstrap.min.js"></script>




<?php
   require __DIR__ . '/footer.php'
?>