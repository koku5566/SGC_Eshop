<?php
	require __DIR__ . '/header.php'	
?>



<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['rrsub']) && $_POST['rrsub'] === 'Submit'){
		
		//$ss1 = $_FILES['img']['name'][0];
		$ss1 = "amanda teh";
		echo "<div class='alert alert-success'>$ss1 || sohai</div>";
		//echo "$ss1 || sohai";
		
	}
   
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- Begin Page Content --------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">		

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Product Review</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <!--CONTENT START-->
      <div class="modal-body">
		<!--DISPLAY HERE
		<div id = "modalResult" style = "height: 100%"></div>
		-->
        <div style="height: 100%">
				<!--CONCAT at 90 -->
					<img src = "https://pbs.twimg.com/profile_images/1452244355062829065/jUmYXUCM_400x400.jpg" class = "productpic">
					<div class = "namestar">
						<h5 style = "font-size: 1rem; padding-top: 1rem; margin-bottom: 0.3rem; color: #333; font-weight: bold;"><?php echo (isset($c4) && !empty ($c4))? $c4 : 'WI-SP510 Wireless Headphone blablabla'; ?></h5>
						<h6>Model: WISP510</h6>
						<h3>RM 349.00</h3>									
					</div>
					
					
					<div style="margin-bottom: 1.1em; text-align: center;margin-top: 1.5rem;">
					<i class="bi bi-star-fill tqy"></i>
					<i class="bi bi-star-fill tqy"></i>
					<i class="bi bi-star-fill tqy"></i>
					<i class="bi bi-star-fill tqy"></i>
					<i class="bi bi-star tqy"></i>
					</div>
			
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder = "Enter Message..." style = "8rem;"></textarea>
			
			<!---------------------------------------------------------------------------------------------------------------------->
				<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" enctype = "multipart/form-data">
				<div class="card-body">
                        <div class="row">
                           
                            <div class="col-xl-10 col-lg-10 col-sm-12">
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
                                                        <p>Picture 5</p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
			
			
			
			<!----------------------------------------------------------------------------------------------------------------------------->	
			
						

      </div>
	  <!--CONTENT END-->
      <div class="modal-footer">
		<button class = "btn btn-primary" name = "rrsub">Submit</button>
      </div>
	  </form>
    </div>
  </div>
</div>
</div>

       <h2>JUST SOME SPACE nani da fck</h2>
       <h2>JUST SOME SPACE</h2> 
       <h2>JUST SOME SPACE</h2>                              
       <h2>JUST SOME SPACE</h2> 
       <h2>JUST SOME SPACE</h2> 
       <h2>JUST SOME SPACE</h2> 
</div>
<!-- /.container-fluid ----------------------------------------------------------------------------------------------->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
.bi.bi-star-fill{
	-webkit-text-fill-color: orange;
}
.tqy{
	font-size:1.32rem;
	margin: 0 0.22rem;
}
.productpic{
	display: block; 
	float: left;
	margin: 0.75em 1em 0 1em; 
	border-radius: 8%; 
	width: 6.5rem; 
	height: 6.5rem;
}

.divcontent{
	font-size: 0.85rem; 
	max-height: 5rem; 
	min-height: 5rem; 
	overflow: hidden; 
	margin-top: 0.5 rem;
}
.namestar{
	min-height: 7.5rem;
	padding: auto;
	position: relative;
	
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
</style>
<script>


    initImages();
    initVariation();


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

    function initImages()
    {
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
                const [file] = img.files;

                var extArr = ["jpg", "jpeg", "png"];

                if (img.files && img.files[0] && img.files.length > 1) {
                    for (var j = 0,i = 0; i < this.files.length; i++) {
                        while(imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.getAttribute('src') != "" && j < 9)
                        {
                            j++;
                        }

                        var ext = img.files[i].name.split('.').pop();
                        if(j < 9 && extArr.includes(ext))
                        {
                            imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(img.files[i])
                            imgInp[j].parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                            imgInp[j].parentElement.parentElement.classList.add("hide");
                        }
                        else
                        {
                            alert("This Image is not a valid format");
                            img.value = "";
                            break;
                        }
                    }
                }
                else if(img.files && img.files[0])
                {
                    var ext = img.files[0].name.split('.').pop();
                    if(extArr.includes(ext))
                    {
                        img.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.src = URL.createObjectURL(file)
                        img.parentElement.parentElement.previousElementSibling.previousElementSibling.classList.remove("hide");
                        img.parentElement.parentElement.classList.add("hide");
                    }
                    else{
                        alert("This Image is not a valid format");
                        img.value = "";
                    }
                }
            });
        });
    }
	
/*
$(".alert.alert-success").delay(2000).slideUp(200, function() {
    $(this).alert('close');
});
*/
$(".alert.alert-danger").delay(3000).slideUp(200, function() {
    $(this).alert('close');
});

</script>