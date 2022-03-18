<?php
    require __DIR__ . '/header.php';

    if(isset($_POST['add']) || isset($_POST['publish'])){ 

        $publish = 1;
        if(isset($_POST['add']))
        {
            $publish = 0;
        }


        // File upload configuration 
        $targetDir = "img/product/"; 
        $allowTypes = array('jpg','png','jpeg'); 
         
        $statusMsg = $errorMsg = $errorUpload = $errorUploadType = ''; 

        $sql_insert = "INSERT INTO `product`(`product_sku`, `product_name`, `product_description`, 
        `product_brand`, `product_cover_video`, `product_cover_picture`, `product_pic_1`, `product_pic_2`, `product_pic_3`, 
        `product_pic_4`, `product_pic_5`, `product_pic_6`, `product_pic_7`, `product_pic_8`, `product_weight`, 
        `product_length`, `product_width`, `product_height`, `product_danger`, `product_self_collect`, 
        `product_standard_delivery`, `product_preorder`, `product_variation`, `product_price`, `product_stock`, 
        `product_sold`, `product_status`, `product_banned`, `category_id`, `shop_id`) 
        VALUES ('".$_POST['sku']."','".$_POST['productName']."','".$_POST['description']."',
        '".$_POST['brand']."','".$_POST['coverVideo']."',";
        $fileNames = array_filter($_FILES['files']['name']); 

        $imgInpCounter = 0;
        if(!empty($fileNames)){ 
            
            foreach($_FILES['files']['name'] as $key=>$val){ 
                // File upload path 
                $fileName = basename($_FILES['files']['name'][$key]); 
                $targetFilePath = $targetDir . $fileName; 
                 
                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to server 
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                        // Image db insert sql 
                        $sql_insert .= "'".$fileName."',";
                        $imgInpCounter++;
                    }
                }
            } 
        }

        while($imgInpCounter < 9)
        {
            $insertValuesSQL .= "'".$fileName."',";
            $imgInpCounter++;
        }

        $sql_insert .= "'".$_POST['weight']."',
        '".$_POST['length']."','".$_POST['width']."','".$_POST['height']."','".$_POST['danger']."','".$_POST['selfCollect']."',
        '".$_POST['standardDelivery']."','".$_POST['preorder']."','".$_POST['variation']."','".$_POST['mainPrice']."','".$_POST['mainStock']."',
        '".$_POST['mainSold']."','".$publish."','".$_POST['banned']."','".$_POST['categoryId']."','".$_POST['shopId']."')";

        if(mysqli_query($conn, $sql_insert)){
            $sql_UpdateId = "UPDATE product AS A, (SELECT id FROM product ORDER BY id DESC LIMIT 1) AS B SET A.product_id=CONCAT('P',B.id) WHERE A.id = B.id";
            mysqli_query($conn, $sql_UpdateId);
        }
        else
        {
            echo("Error Insert Fail");
        }
    } 
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product Details</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Update</a>
    </div>


                   <!-- List All Product -->
                    <div class="row">
                        <!--Product List -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Basic Information</h5>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                            <div class="drag-list">
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
                                                                <input accept="image/*" type="file" class="imgInp" />
                                                                <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <p>Cover Picture</p>
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
                                                                <input accept="image/*" type="file" class="imgInp" />
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
                                                                <input accept="image/*" type="file" class="imgInp" />
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
                                                                <input accept="image/*" type="file" class="imgInp" />
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
                                                                <input accept="image/*" type="file" class="imgInp" />
                                                                <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <p>Picture 4</p>
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
                                                                <input accept="image/*" type="file" class="imgInp" />
                                                                <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <p>Picture 5</p>
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
                                                                <input accept="image/*" type="file" class="imgInp" />
                                                                <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <p>Picture 6</p>
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
                                                                <input accept="image/*" type="file" class="imgInp" />
                                                                <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <p>Picture 7</p>
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
                                                                <input accept="image/*" type="file" class="imgInp" />
                                                                <i class="fa fa-plus image-tools-add-icon" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <p>Picture 8</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" >Category</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Enter ..." aria-label="Category">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <button type="button" class="btn btn-primary">Search</button>
                                        <button type="button" class="btn btn-outline-dark">Reset</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

</div>
<!-- /.container-fluid -->

<style>

    @import "nib";

    [draggable] {
    user-select: none;
    }
    .drag-list {
        margin: 10px auto;
        border: 1px solid #ccc;
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

    .hide{
        display:none;
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

    // Instantiate
    var draggable = new DragNSort({
        container: document.querySelector('.drag-list'),
        itemClass: 'drag-item',
        dragStartClass: 'drag-start',
        dragEnterClass: 'drag-enter'
    });
    draggable.init();

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
                case 6:
                    text = "Picture 5"
                    break;
                case 7:
                    text = "Picture 6"
                    break;
                case 8:
                    text = "Picture 7"
                    break;
                case 9:
                    text = "Picture 8"
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



</script>

<?php
    require __DIR__ . '/footer.php'
?>