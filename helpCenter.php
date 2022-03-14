<?php
    require __DIR__ . '/header.php'
?>

<link rel="stylesheet" type="text/css" href = "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
<link rel="stylesheet" type="text/css" href = "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<!-- Begin Page Content -------------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['pid']) && !empty($_POST['pid'])){
	
	$ppid =  $_POST['pid'];
	echo ($ppid );
	//$array=json_decode(ujson);
	//echo ($array);
	
	
		 
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['img'])){	//check whether the form is send ma 
	
		print_r($_FILES);
		
		//$sql = "INSERT INTO `helpcenter`(`hcc_id`, `question`, `answer`, `pic`, `pic_type`) VALUES (?,?,?,?,?);";

			$name= $_FILES['img']['name'];
			$size = $_FILES['img']['size'];
			$temp = $_FILES['img']['tmp_name'];
			$type = $_FILES['img']['type'];
			$imageData = file_get_contents($temp);
			$ext = strtolower(pathinfo($name,PATHINFO_EXTENSION));
			$hcc_id = 3;
			$categoryP = "God of War";
			$questionP = "Can A platinum bullet pierce throught my wood armor 3";
			$answerP = "Yes, in fact it could make a really clean pierce 3";
			
		if($ext != 'jpg' && $ext != 'png' && $ext != 'gif'){
			echo "<script>alert('Invalid image format . Format must be in jpg, png or gif')</script>";
		}
		
		if($size > 1000000){
			echo "<script>alert('Invalid file size. The file size must not exceed 1Mb')</script>";
		}
		
		
		
		if($stmt = mysqli_prepare($conn, $sql)){	//see this all same de so need rmb this a lot
				mysqli_stmt_bind_param($stmt, 'issss',$hcc_id, $questionP,$answerP, $imageData, $type); 	//s=string , d=decimal value
		
				mysqli_stmt_execute($stmt);
			
				if(mysqli_stmt_affected_rows($stmt) == 1 )	//why check with 1? this sequal allow insert 1 row nia
				{
					echo "<script>alert('Upload successfully');</script>";
					// UPDATE HCC_ID
					$sql = "UPDATE helpcenter set hc_id = concat('HC',id) WHERE id = (select id from helpcenter order by id desc LIMIT 1);";					
					if($stmt = mysqli_prepare($conn, $sql)){
						mysqli_stmt_execute($stmt);
					
						if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
						{echo "<script>alert('Update successfully HCCID');</script>";}
						else{	
						 echo "<script>alert('Fail to Update');</script>";}}
					//END 
					//mysqli_stmt_close($stmt);
				}else{
					echo "<script>alert('Fail to Upload');</script>";
				}
		
				mysqli_stmt_close($stmt);
			}

	}
	

?>
 
	
<!--START OF TESTINGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG-->	
	<div class="container">
		<h1>Category</h1>
		<div class="logo-slider">
	<?php
		
	$sql = "SELECT hcc_id, category, pic, pic_type 
	        FROM `helpCenterCategory` 
			WHERE disable_date IS NULL";	//KM - CHANGE TO helpCenterCategory
		if($stmt = mysqli_prepare ($conn, $sql)){
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $c1,$c2,$c3,$c4);
			
			
			while(mysqli_stmt_fetch($stmt)){			

					
					
					if(strlen($c2) >= 16){
						$cTrim = substr($c2, 0, 16);
						$cTag = "$cTrim...";
					}else{$cTag = $c2;}
					
				echo "<div class='item'>" .
					"<form action = '". $_SERVER['PHP_SELF']."' method = 'POST' class = 'imgCssT'>" .
						"<input type='hidden' name='pid' value='$c1'>" .
						 "<input type='image' name = 'uProduct' src='data: $c4;base64, " . base64_encode($c3)."' alt='Submit' class='imgCss'></form>" .
						"<div class='catTag'>$cTag</div></div>"; 
			}

	}

	?>

		</div>
	</div>

<!--END OF TESTINGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG-->			
		
		
<!--START OF TESTINGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG-->		
	<main>
		<h1 id="faq">Frequently Asked Question</h1>
			<div id="showHC1">	
				<?php
					echo "<script>let u = []; let functionArr = [];</script>";
					
					$pp=0;
					
					if( isset ($_POST['pid']))
					{
						$selectedCategory = $_POST['pid'];
						
						//$sql = "SELECT * FROM helpCenter2 WHERE category = '$selectedCategory' AND disable_date IS NULL";
						
						$sql = "SELECT  hc.hc_id, hc.hcc_id, hcc.category, hc.question, hc.answer, hc.pic, hc.pic_type
								FROM helpCenterCategory hcc INNER JOIN helpCenter hc
								ON hcc.hcc_id = hc.hcc_id
								WHERE hc.hcc_id = '$selectedCategory' AND hc.disable_date IS NULL;";
						if($stmt = mysqli_prepare ($conn, $sql)){
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt, $c1,$c2,$c3,$c4,$c5,$c6,$c7);
											
						while(mysqli_stmt_fetch($stmt)){		
						    echo"<script>u.push('$c1')</script>";
						   
							echo "<div id='faq$c1' class='faq'>										  
								 <div class='faq_text'>
								 <h2>$c4</h2>
								 <p>$c5</p>
							     </div>
							     <span class='btn' id='btn$c1'>+</span>
					             </div>";		
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
						
					}else{
						//$sql = "SELECT * FROM helpCenter2 WHERE disable_date IS NULL ";
						$sql = "SELECT  hc.hc_id, hc.hcc_id, hcc.category, hc.question, hc.answer, hc.pic, hc.pic_type
								FROM helpCenterCategory hcc INNER JOIN helpCenter hc
								ON hcc.hcc_id = hc.hcc_id
								WHERE hc.disable_date IS NULL;";
						if($stmt = mysqli_prepare ($conn, $sql)){
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt, $c1,$c2,$c3,$c4,$c5,$c6,$c7);
											
						while(mysqli_stmt_fetch($stmt)){		
						    echo"<script>u.push('$c1')</script>";
						   
							echo "<div id='faq$c1' class='faq'>										  
								 <div class='faq_text'>
								 <h2>$c4</h2>
								 <p>$c5</p>
							     </div>
							     <span class='btn' id='btn$c1'>+</span>
					             </div>";		
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
					}
					
					
					
				?>
			</div>
	</main>
<!--END OF TESTINGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG-->		
	

</div>
<!-- /.container-fluid ------------------------------------------------------------------------------------------------>
<script>
$('.logo-slider').slick({
		slidesToShow: 5,
		slidesToScroll:1,
		dots:true,
		arrows:true,
		autoplay: false,
		autoplaySpeed: 2000, 
		infinite: true
	});

	let ujson = JSON.stringify(u);
	
	let k = [];
	let y =[];
	
	for(let i=0; i< 6; i++){
		k.push("btn"+ u[i]);
		y.push("faq" + u[i]);
		
	}
	
	
	
</script>
<?php
    require __DIR__ . '/footer.php'
?>

<style>
body{
	font-family:Roboto, sans-serif;
	background-color: #f7f7f7;
}
img{
	height: 100px; 
	width: 100%;
	max-width: 150px;  
}
.container{
	max-width: 1040px;
	margin: 100px auto
}
h1{
	font-size: 30px;
	font-weight: 500;
	text-align: center;
	position: relative;
	margin-bottom: 60px;
}
h1:after{
	content: '';
	position: absolute;
	width: 100px;
	height: 4px;
	background-color: #ff8159;
	bottom: -20px;
	left: 0;
	right: 0;
	margin: 0 auto;
}
.logo-slider .item{
	background-color: #fff;
	border-radius: 8px;
	padding: 10px;
	border: 3px solid #111;
}
.logo-slider .slick-slide{
	margin: 15px 38px 15px 28px; 
}
.slick-dots li.slick-active button:before{
	color: #ff5722;
}
.slick-dots li button:before{
	font-size: 12px;
}
.slick-next:before,
.slick-prev:before{
	color: #ff8159;
	font-size: 24px;
}
.item:hover{
	display: block;
	transition: all ease 0.3s;
	transform: scale(1.1) translate(-5px);
}
.imgCss{
	height: 100px; 
	width: 100%;
	max-width: 150px;  

}
.catTag{
	text-align: center;
	overflow: hidden;
}
<!---->
main{
	max-width: 800px;
	margin: 5vh auto;
	padding: 20px;
}

#faq{
	font-size: 2.5em;
	font-weight: 400;
	margin-bottom: 40px;
	color: #707070;
}
h2{
	font-size: 1.1em;
	font-weight: 400;
	color: #5e5d5d;
}
.faq{
	padding: 20px 30px;
	border: 1px solid rgba(0 0 0 / .1);
	border-radius: 5px;
	color: #979797;
	position: relative;
	line-height: 1.5em;
	margin-top: 15px;
	cursor: pointer;
}
.faq .faq_text{
	width:90%;
}
.btn{
	color: #5e5d5d;
	position: absolute;
	right: 25px;
	top: 35px;
	font-weight: 400;
	font-size: 1.4em;
}


.faq.open h2{
	color: #00848f;
}
.faq p {
	display: none;
}
.faq.open p {
	display:block;
}
.faq.open .btn{
	color: #00848f;
}
</style>
