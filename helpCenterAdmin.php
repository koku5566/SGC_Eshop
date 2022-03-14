<?php
    require __DIR__ . '/header.php'
?>
<?php
	
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['uimage']) && !empty($_POST['uimage'])  ){	
            
            //echo "<script>alert('Gottacha');</script>";
            $selectedPID = $_POST['uimage'];
            //$sql = "SELECT *  FROM `helpcenter` WHERE `hc_id` = ?";
            $sql = "SELECT  hc.hc_id, hc.hcc_id, hcc.category, hc.question, hc.answer, hc.pic, hc.pic_type
                    FROM helpCenterCategory hcc INNER JOIN helpCenter hc
                    ON hcc.hcc_id = hc.hcc_id
                    WHERE hc_id = ? AND hc.disable_date IS NULL";
                                    
            if($stmt = mysqli_prepare ($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $selectedPID);	//HARLO IF THIS INT = i, STRING = s
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $c1,$c2,$c3,$c4,$c5,$c6,$c7);
                    mysqli_stmt_fetch($stmt);
                }
                
                mysqli_stmt_free_result($stmt);
                mysqli_stmt_close($stmt);
            
            }
    }	
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['pcategorylist'], $_POST['pquestion'], $_POST['ptextarea']) && !empty($_POST['pcategorylist']) && !empty($_POST['pquestion']) && !empty($_POST['ptextarea']) && $_POST['uContent'] === 'Update'){	
    
        //echo "<script>alert('LETS FCKING GOooooooooooooooooooo')</script>";
        //echo "<script>document.getElementById('myModal').style.display = 'none'</script>";
        
        
                //ID to identify update file
                
                $selectedPID = $_POST['pid'];
                $pcategorylist = $_POST['pcategorylist'];
                $pquestion = $_POST['pquestion'];
                $panswer = $_POST['ptextarea'];
                
            
                //echo $selectedPID;
                //Image information 
                $name= $_FILES['eimg']['name'];
                $size = $_FILES['eimg']['size'];
                $temp = $_FILES['eimg']['tmp_name'];
                $type = $_FILES['eimg']['type'];
                
                $ext = strtolower(pathinfo($name,PATHINFO_EXTENSION));
            
    
                if($size == 0){
                    //echo "<script>alert('NO PIC')</script>";
                    $sql = "UPDATE `helpCenter` SET hcc_id =?, question=?, answer=?  WHERE hc_id=?";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        mysqli_stmt_bind_param($stmt, 'ssss',$pcategorylist,$pquestion,$panswer,$selectedPID); 	//s=string , d=decimal value i=ID
                
                        mysqli_stmt_execute($stmt);
                    
                        if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                        {
                            echo "<script>alert('Update successfully no img');</script>";
                        }else{
                            echo "<script>alert('Fail to Update no img');</script>";
                        }
                
                        mysqli_stmt_close($stmt);
                    }
                    
                }else{
                    //USER GOT PUT IMAGE 
                    if($ext != 'jpg' && $ext != 'png' && $ext != 'gif'){
                        echo "<script>alert('Invalid image format . Format must be in jpg, png or gif')</script>";
                    }
                    
                    if($size > 1000000){
                        echo "<script>alert('Invalid file size. The file size must not exceed 1Mb')</script>";
                    }
                    $imageData = file_get_contents($temp);
                    //echo "<script>alert('GOT PIC')</script>";
                    $sql = "UPDATE `helpCenter` SET hcc_id =?, question=?, answer=? , pic=?, pic_type=? WHERE hc_id=?";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        mysqli_stmt_bind_param($stmt, 'ssssss',$pcategorylist,$pquestion,$panswer,$imageData,$type,$selectedPID); 	//s=string , d=decimal value i=ID
                
                        mysqli_stmt_execute($stmt);
                    
                        if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                        {
                            echo "<script>alert('Update successfully got img');</script>";
                        }else{
                            echo "<script>alert('Fail to Update got img');</script>";
                        }
                
                        mysqli_stmt_close($stmt);
                    }
                }
        
            
            
            
            
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pid']) && !empty($_POST['pid']) && $_POST['dContent'] === 'Delete'){	
    
        $selectedPID = $_POST['pid'];
                echo "<script>alert($selectedPID);</script>";
                $sql = "UPDATE helpcenter SET disable_date=? WHERE hc_id=?;";
                $today = date("Y-m-d");
                 
                // $sql = "INSERT INTO `product`(`sku`, `name`, `price`) VALUES (?,?,?)";
                if($stmt = mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt, 'ss', $today, $selectedPID); 	//s=string , d=decimal value i=ID
            
                    mysqli_stmt_execute($stmt);
                
                    if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                    {
                        echo "<script>alert('Delete successfully');</script>";
                    }else{
                        echo "<script>alert('Fail to Update');</script>";
                    }
            
                    mysqli_stmt_close($stmt);
                }
                
                //echo "<script>alert('I got UUU');</script>";
    
    
    
    }else{}
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['acategorylist'], $_POST['aquestion'], $_POST['aans']) && !empty($_POST['acategorylist']) && !empty($_POST['aquestion']) && !empty($_POST['aans']) ){
            
            $acategorylist = $_POST['acategorylist'];
            $aquestion = $_POST['aquestion'];
            $aans = $_POST['aans'];
            
            //Image information 
                $name= $_FILES['aimg']['name'];
                $size = $_FILES['aimg']['size'];
                $temp = $_FILES['aimg']['tmp_name'];
                $type = $_FILES['aimg']['type'];
                
                $ext = strtolower(pathinfo($name,PATHINFO_EXTENSION));
        
            if($_POST['aContent'] === 'Add'){
                
                
                if($size == 0){
                    //echo "<script>alert('NO PIC')</script>";
                    
                    $sql = "INSERT INTO `helpcenter`(`hcc_id`, `question`, `answer`) VALUES (?,?,?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        mysqli_stmt_bind_param($stmt, 'sss', $acategorylist, $aquestion, $aans); 	//s=string , d=decimal value, i=integer
                
                        mysqli_stmt_execute($stmt);
                    
                        if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                        {
                            echo "<script>alert('Insert successfully');</script>";
                            
                            $sql = "UPDATE helpcenter set hc_id = concat('HC',id) WHERE id = (select id from helpcenter order by id desc LIMIT 1);";
                            if($stmt = mysqli_prepare($conn, $sql)){
                            mysqli_stmt_execute($stmt);
                            if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                            {echo "<script>alert('Update successfully HCCID');</script>";}
                            else{echo "<script>alert('Fail to Update');</script>";}}	
                            //END  
    
                        }else{
                            echo "<script>alert('Fail to Insert');</script>";
                        }
                
                        mysqli_stmt_close($stmt);
                    }
                    
                    
                }else{
                    //USER GOT PUT IMAGE 
                    
                    if($ext != 'jpg' && $ext != 'png' && $ext != 'gif'){
                        echo "<script>alert('Invalid image format . Format must be in jpg, png or gif')</script>";
                    }
                    
                    if($size > 1000000){
                        echo "<script>alert('Invalid file size. The file size must not exceed 1Mb')</script>";
                    }
                    $imageData = file_get_contents($temp);
                    
                    $sql = "INSERT INTO `helpcenter`(`hcc_id`, `question`, `answer`,`pic`,`pic_type`) VALUES (?,?,?,?,?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        mysqli_stmt_bind_param($stmt, 'sssss',$acategorylist, $aquestion, $aans, $imageData,$type); 	//s=string , d=decimal value, i=integer
                
                        mysqli_stmt_execute($stmt);
                    
                        if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                        {
                            echo "<script>alert('Insert successfully');</script>";
                            $sql = "UPDATE helpcenter set hc_id = concat('HC',id) WHERE id = (select id from helpcenter order by id desc LIMIT 1);";
                            if($stmt = mysqli_prepare($conn, $sql)){
                            mysqli_stmt_execute($stmt);
                            if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                            {echo "<script>alert('Update successfully HCID');</script>";}
                            else{echo "<script>alert('Fail to Update');</script>";}}	
                            //END  
                            
                        }else{
                            echo "<script>alert('Fail to Insert');</script>";
                        }
                
                        mysqli_stmt_close($stmt);
                    }
                    
                    
                    
                    
                }
                
                
                
                
            
            }
        
        
            
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['acCategoryName']) && !empty($_POST['acCategoryName']) ){
            
            $acCategoryName = $_POST['acCategoryName'];
            echo "$acCategoryName";
            
            //Image information 
                $name= $_FILES['acImage']['name'];
                $size = $_FILES['acImage']['size'];
                $temp = $_FILES['acImage']['tmp_name'];
                $type = $_FILES['acImage']['type'];
                
                $ext = strtolower(pathinfo($name,PATHINFO_EXTENSION));
        
            if($_POST['acContent'] === 'Add'){
        
                    //USER GOT PUT IMAGE 
                    
                    if($ext != 'jpg' && $ext != 'png' && $ext != 'gif'){
                        echo "<script>alert('Invalid image format . Format must be in jpg, png or gif')</script>";
                    }
                    
                    if($size > 1000000){
                        echo "<script>alert('Invalid file size. The file size must not exceed 1Mb')</script>";
                    }
                    $imageData = file_get_contents($temp);
                    
                    $sql = "INSERT INTO `helpcentercategory`(`category`,`pic`,`pic_type`) VALUES (?,?,?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        mysqli_stmt_bind_param($stmt, 'sss',$acCategoryName, $imageData,$type); 	//s=string , d=decimal value, i=integer
                
                        mysqli_stmt_execute($stmt);
                    
                        if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                        {
                            echo "<script>alert('Insert successfully');</script>";
                            $sql = "UPDATE helpcentercategory set hcc_id = concat('HCC',id)WHERE id = (select id from helpcentercategory order by id desc LIMIT 1);";
                            if($stmt = mysqli_prepare($conn, $sql)){
                            mysqli_stmt_execute($stmt);
                            if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
                            {echo "<script>alert('Update successfully HCCID');</script>";}
                            else{echo "<script>alert('Fail to Update');</script>";}}	
                            //END  
                            
                        }else{
                            echo "<script>alert('Fail to Insert');</script>";
                        }
                
                        mysqli_stmt_close($stmt);
                    }
    
            }
        
        
            
    }
    ?>

<!-- Begin Page Content --------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">






		
				
				
				
		
<div  class= "sohai">
	
		
		<!--THE MODAL EDIT QUESTION-->			
				<div id="myModal" class="modal">
					<!--THE MODAL CONTENT-->
						<div class="modal-content">
						<span class="close">&times;</span>
							<div class="editQuestion">
								

									<form action ='<?php echo $_SERVER['PHP_SELF'];?>' method = 'POST' id = "showmedawae" enctype = "multipart/form-data">

									<label for = 'pcategorylist' class = 'labelinput'>Category:</label>
									
									
											 <select id="pcategoryDisplay" name="pcategorylist" onchange='myBtnFunction()'>
									
												<?php
													$sql ="SELECT hcc_id, category
														   FROM helpCenterCategory 								   
														   WHERE disable_date IS NULL";
													if($stmt = mysqli_prepare ($conn, $sql)){
														mysqli_stmt_execute($stmt);
														mysqli_stmt_bind_result($stmt, $s1,$s2);
														
														while(mysqli_stmt_fetch($stmt)){
															if($c2 == $s1){
																echo "<option value='$s1' selected='selected'>$s2</option>";
															}else{
																echo "<option value='$s1'>$s2</option>";
															}
														}
														mysqli_stmt_close($stmt);
													}
												?>
											 </select><br><br><br>
											 
											
									

									<label for = 'pquestion' class = 'labelinput'>Question:</label>
									<input type = 'text' name ='pquestion' id ='pque' class = 'textinput'  onchange='myBtnFunction()' value = '<?php echo(isset($c4) && !empty ($c4))? $c4 : ''; ?>' required><br><br><br>

									<label for = 'panswer' class = 'labelinput' style = 'vertical-align: top; margin-left: 39px;'>Answer:</label>
									<textarea id = 'pans' name = "ptextarea"class = 'textarea' onchange='myBtnFunction()' required><?php echo(isset($c5) && !empty ($c5))? $c5 : ''; ?></textarea><br><br><br>

									<label for = 'pimg' class = 'labelinput' style = 'vertical-align: top; margin-left: 46px;'>Image:</label>
									<!--DISPLAY IMAGE HERE-->
									
									<?php
										$sql ="SELECT  hc.hc_id, hc.hcc_id, hcc.category, hc.question, hc.answer, hc.pic, hc.pic_type
											   FROM helpCenterCategory hcc INNER JOIN helpCenter hc
											   ON hcc.hcc_id = hc.hcc_id
											   WHERE hc.disable_date IS NULL;";
										if($stmt = mysqli_prepare ($conn, $sql)){
											mysqli_stmt_execute($stmt);
											mysqli_stmt_bind_result($stmt, $s1,$s2,$s3,$s4,$s5,$s6,$s7);
											
											while(mysqli_stmt_fetch($stmt)){
												if($c1 == $s1){

													if($c6 != NULL && $c7 != NULL){
														//echo 'Got pic';
														echo "<img  src='data: $c7;base64, " . base64_encode($c6)."'  class='editimgCss'>".
															 "<input type = 'file'  name ='eimg' id = 'pimg' onchange='myBtnFunction()'><br>";
															 
													}else{
														echo"<input type = 'file'  name ='eimg' id = 'pimg' onchange='myBtnFunction()'><br><br><br>";
																	 
													}
		
												}else{/* $c1 IS NOT SET THEN HERE - So nothing in here*/}
		
											}
											mysqli_stmt_close($stmt);
										}
									?>
									
									<?php echo (isset($c1) && !empty ($c1))? "<input type = 'hidden' name = 'pid' value = '".$c1."'>" : ''; ?>
									<input type = 'submit' name ='uContent' value ='Update'  id='updatebtn' style='float:right;' class="gobtn"disabled>
									</form>
									
									<form action ='<?php echo $_SERVER['PHP_SELF'];?>' method = 'POST' >
									<?php echo (isset($c1) && !empty ($c1))? "<input type = 'hidden' name = 'pid' value = '".$c1."'>" : ''; ?>
									<input type = 'submit' name ='dContent' value ='Delete'  id='deletebtn' style='float:left;background-color:red;color:white'>
									</form>

								
							
							</div>

						</div>
				</div>
						<?php
									//TO LET BUTTON ENABLED IF THERE IS CHANGES MADE
									$cc2 = (isset($c2) && !empty ($c2))? $c2 : '';
									$cc4 = (isset($c4) && !empty ($c4))? $c4 : '';
									$cc5 = (isset($c5) && !empty ($c5))? $c5 : '';
																	
								echo "<script>function myBtnFunction(){
									
									  let textcategory = document.getElementById('pcategoryDisplay').value;
									  let textquestion = document.getElementById('pque').value;
									  let textanswer = document.getElementById('pans').value;
									  let textimage = document.getElementById('pimg').value;
									  
									  let f = false;
										
										if (textcategory === '$cc2' && textquestion === '$cc4' && textanswer === '$cc5' && textimage === '') 
										{f = false;}		
										else			
										{f = true;} 
										
										if(f == true)
										{document.getElementById('updatebtn').disabled = false;}	
										else
										{document.getElementById('updatebtn').disabled = true;}
										
								}</script>";

							?>
							
							<?php
								//THIS TO LET myModal1 to display as block
								if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['uimage']) && !empty($_POST['uimage'])  ){
									
									$uimage = $_POST['uimage'];
									
									echo"<script>document.getElementById('myModal').style.display = 'block';</script>";	
								}
							?>
			<!--END OF MODAL EDIT QUESTION-->
<!---------------------------------------------------------------------------------------------------------------------------------->			
			<!--STAR OF MODAL ADD QUESTION-->
			<div id="myModalAdd" class="modal">
					<!--THE MODAL CONTENT-->
						<div class="modal-content">
						<span class="close" id = "closeAdd">&times;</span>
							<div class="editQuestion">
								

									<form action ='<?php echo $_SERVER['PHP_SELF'];?>' method = 'POST' enctype = "multipart/form-data">

									<label for = 'addcategorylist' class = 'labelinput'>Category:</label>
									<!--
									<input type = 'text' name ='pcategory' id ='pcat' class = 'textinput' onchange='myBtnFunction()' value = 'echo(isset($c2) && !empty ($c2))? $c2 : ''; ' required><br><br><br>
									-->
									
											 <select id="addcategoryDisplay" name="acategorylist" required>
												<option value="">-Select Category-</option>
												<?php
													$sql ="SELECT hcc_id, category
														   FROM helpCenterCategory 								   
														   WHERE disable_date IS NULL ";
													if($stmt = mysqli_prepare ($conn, $sql)){
														mysqli_stmt_execute($stmt);
														mysqli_stmt_bind_result($stmt, $s1,$s2);
														
														while(mysqli_stmt_fetch($stmt)){
																echo "<option value='$s1'>$s2</option>";
															}
														mysqli_stmt_close($stmt);
													}
												?>	
											</select><br><br><br>		
											 
									<label for = 'addquestion' class = 'labelinput'>Question:</label>
									<input type = 'text' name ='aquestion' id ='addquestion' class = 'textinput' value = '' required><br><br><br>

									<label for = 'addans' class = 'labelinput' style = 'vertical-align: top; margin-left: 39px;'>Answer:</label>
									<textarea id = 'addans' name = "aans"class = 'textarea' required></textarea><br><br><br>

									<label for = 'addimg' class = 'labelinput' style = 'vertical-align: top; margin-left: 46px;'>Image:</label>
									<input type = 'file'  name ='aimg' id = 'addimg'><br><br><br>
																		
									
									
									<input type = 'submit' name ='aContent' value ='Add'  id='addquebtn' style='float:right;' class="gobtn">

									</form>
							
							</div>

						</div>
				</div>
			<!--END OF MODAL ADD QUESTION-->		 
											
			<!--STAR OF MODAL ADD CATEGORY-->
			<div id="myModalAddCat" class="modal">
					<!--THE MODAL CONTENT-->
						<div class="modal-content">
						<span class="close" id = "closeModalAddCat">&times;</span>
							<div class="editQuestion">
								
								<!--ADD CATEGORY-->
									<div id = "a_category">
									<form action ='<?php echo $_SERVER['PHP_SELF'];?>' method = 'POST' enctype = "multipart/form-data" >

										<label for = 'acCatName' class = 'labelinput'>Category:</label>					
										<input type = 'text' name ='acCategoryName' id ='acCatName' class = 'textinput' required><br><br><br>
									
																				 
										<label for = 'acImg' class = 'labelinput' style = 'vertical-align: top; margin-left: 46px;'>Image:</label>
										<input type = 'file'  name ='acImage' id = 'acImg' required><br><br><br>

										<input type = 'submit' name ='acContent' value ='Add' style='float:right;' class="gobtn">
																				
									</form>
									
									
									
								
							</div>

						</div>
				</div>
				
						
			<!--END OF MODAL ADD CATEGORY-->						

									
		
		

		<div class = "pp">	
			<!--Display All Category-->
			<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">		
					 <select id="categoryDisplay" name="categorylist" onchange = 'myBtnGoFunction()'>
						<option value="">-Select Category-</option>
						<?php
							$sql ="SELECT hcc_id, category
								   FROM helpCenterCategory 								   
								   WHERE disable_date IS NULL ";
							if($stmt = mysqli_prepare ($conn, $sql)){
								mysqli_stmt_execute($stmt);
								mysqli_stmt_bind_result($stmt, $c1,$c2);
								
								while(mysqli_stmt_fetch($stmt)){
									echo "<option value='$c1'>$c2</option>";
								}
								mysqli_stmt_close($stmt);
							}
						?>
					 </select>
					 
					<input type="submit" value = "Go" id = "goo" disabled= "disabled" class="gobtn">
			</form>	

			<!--Add Category Button-->
			<!--<input type='hidden' name='pps' value='addbutton'>-->
			<input type="image" id="pidbutton" src = "https://cdn.pixabay.com/photo/2021/07/25/08/07/add-6491203__340.png" class = "addbtn">	
			
			<button id = "addquestionbtn">BUTTON ADD QUESTION</button>
	
			<!--The Space Between Category and Question-->
				<div style = 'margin-top: 15px; max-height: 400px; overflow: auto;'>
			<!--Content for Question & Answer-->			   	
						<?php
				
							echo "<script>let u = []; let functionArr = [];</script>";
							$pp=0;
							
							if( isset ($_POST['categorylist']))
							{
								//echo "<script>alert('GOT')</script>";
								$selectedCategory = $_POST['categorylist'];
								//$sql = "SELECT * FROM helpCenter2 WHERE category = '$selectedCategory' AND disable_date IS NULL";		
								  $sql = "SELECT  hc.hc_id, hc.hcc_id, hcc.category, hc.question, hc.answer, hc.pic, hc.pic_type
										  FROM helpCenterCategory hcc INNER JOIN helpCenter hc
										  ON hcc.hcc_id = hc.hcc_id
										  WHERE hc.hcc_id = '$selectedCategory' AND hc.disable_date IS NULL;";								
							}else{
								//echo "<script>alert('DUN HAB')</script>";
								//$sql = "SELECT * FROM helpCenter2 WHERE disable_date IS NULL ";
								$sql = "SELECT  hc.hc_id, hc.hcc_id, hcc.category, hc.question, hc.answer, hc.pic, hc.pic_type
										FROM helpCenterCategory hcc INNER JOIN helpCenter hc
										ON hcc.hcc_id = hc.hcc_id
										WHERE hc.disable_date IS NULL;";
							}
							
							
							if($stmt = mysqli_prepare ($conn, $sql)){
							mysqli_stmt_execute($stmt);
							mysqli_stmt_bind_result($stmt, $c1,$c2,$c3,$c4,$c5,$c6,$c7);
												
							while(mysqli_stmt_fetch($stmt)){		
								echo"<script>u.push('$c1')</script>";
								
								
								if($c6 == NULL){
									$iforimage = "";
								}else{
									$iforimage = "<img src = 'data: $c7;base64, " . base64_encode($c6)."' class = 'imgfaq'>";
								}
								
								echo "<div id='faq$c1' class='faq'>". 
										"<div class='faq_text'>".
												"<h2>$c4</h2>".	
												"<p>$c5
												 <form action ='". $_SERVER['PHP_SELF']."' method = 'POST' class = 'baka'>".
												"$iforimage".
												"<input type='hidden' name='uimage' value='".$c1."'>".	
												"<input type='image' alt= 'submit' name ='btnimage' src = 'https://www.freeiconspng.com/thumbs/edit-icon-png/edit-new-icon-22.png' class = 'imgset' ></form>".
												"</p>".	
										"</div>".
										"<span class='btn' id='btn$c1'>+</span>".
									"</div>";
									$pp++;
								}
					
								for($i=0; $i<$pp; $i++ ){
									echo	"<script>
												 functionArr.push(function(){
														document.getElementById('faq' + u[$i]).classList.toggle('open');
							  
														if (document.getElementById('btn' + u[$i]).innerHTML === '+'){			  
																document.getElementById('btn' + u[$i]).innerHTML = '&#8722';
															}
														else{
																document.getElementById('btn' + u[$i]).innerHTML = '+';
															}
													  }	);
													  
													  document.getElementById('faq' + u[$i]).onclick = functionArr[$i]
											</script>";
									
								}
							
													
							}
							

						?>
	
				</div>
		</div>
				
						
					
</div>
			
			
		
			
		




</div>
<!-- /.container-fluid ----------------------------------------------------------------------------------------------->
<script>
//FOR EDIT QUESTION
var modal = document.getElementById("myModal");
//var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
  modal.style.display = "none";
}

//FOR ADD QUESTION
var modalAdd = document.getElementById("myModalAdd");
var btnAddQue = document.getElementById("addquestionbtn");
var spanAdd = document.getElementsByClassName("close")[1];
btnAddQue.onclick = function() {
  modalAdd.style.display = "block";
}
spanAdd.onclick = function() {
  modalAdd.style.display = "none";
}

//FOR ADD Category

var modalAddCat = document.getElementById("myModalAddCat");
var btnAddCat = document.getElementById("pidbutton");
var spanAddCat = document.getElementsByClassName("close")[2];

btnAddCat.onclick = function() {
  modalAddCat.style.display = "block";
}
spanAddCat.onclick = function() {
  modalAddCat.style.display = "none";
  
}

/****************************************************************/

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  else if (event.target == modalAdd) {
	modalAdd.style.display = "none";
  }
  else if (event.target == modalAddCat){
	 modalAddCat.style.display = "none";
  }
	  
}

	
	
function myBtnGoFunction(){
		  let ddlist = document.getElementById('categoryDisplay').value;
		  
		  let f = false;
			
			if (ddlist === "" )
			{f = false;	}	
			else{f = true;}	
					
			
			if(f == true){document.getElementById('goo').disabled = false;}
			else{ document.getElementById('goo').disabled = true;}
	}			
	

</script>
<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
