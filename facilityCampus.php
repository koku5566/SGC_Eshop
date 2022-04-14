<?php
    require __DIR__ . '/header.php'
?>
<?php
    $_SESSION['campusId'] = $_GET['campusId'];
?>
<?php
	//Fetch each product information
	$id = $_SESSION['campusId'];

    $sql_campus = "SELECT shop_name, shop_profile_cover FROM shopProfile AS A LEFT JOIN user AS B ON A.shop_id = B.user_id WHERE B.role = 'ADMIN' AND shop_id = '$id';  ";

	$result_campus = mysqli_query($conn, $sql_campus);

	if (mysqli_num_rows($result_campus) > 0) {
		while($row_campus = mysqli_fetch_assoc($result_campus)) {
			
			$shopName = $row_campus['shop_name'];
			$shopCover = $row_campus['shop_profile_cover'];
		}
	}
	else{
		?>
			<script type="text/javascript">
				window.location.href = window.location.origin + "/facilityrental.php";
			</script>
		<?php
	}
?>


                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
                    
                    <div class="card-header py-3">
                        <h5><?php echo($shopName); ?></h5>
                    </div>
                    <!-- Slideshow -->
                    <div class="w3-display-middle" style="width:100%">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://www.iphonehacks.com/wp-content/uploads/2021/09/iPhone-13-pre-order.jpg" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" style="z-index:0;" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" style="z-index:0;" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <!-- /.container-fluid -->
                <br>
                <div class="container-fluid" style="width:80%">

                   
                    <br>
                    <div class="card-header py-3">
                                    <h5>BOOK YOUR FACILITIES</h5>
                                </div>

                    <div class="row">
                        <!--Product List -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                            $sql_facility = "SELECT * FROM facilityPic WHERE campus_id = '$id'";

                                            $result_facility = mysqli_query($conn, $sql_facility);
                                        
                                            if (mysqli_num_rows($result_facility) > 0) {
                                                while($row_facility = mysqli_fetch_assoc($result_facility)) {
                                                    $facilityId = $row_facility['facility_id'];
                                                    $title = $row_facility['title'];
                                                    $priceperhour = $row_facility['price_per_hour'];
                                                    $description = $row_facility['pic_description'];
                                                    $address = $row_facility['address'];
                                                    $whatsapp = $row_facility['contact_whatsapp'];
                                                    $picCover = $row_facility['pic_cover'];

                                                    echo("
                                                    <div class=\"col-xl-4 col-lg-4 col-sm-6\" style=\"padding-bottom: .625rem;\">
                                                        <a data-sqe=\"link\" href=\"facilityDetail.php?facilityId=$facilityId\">
                                                            <div class=\"card\">
                                                                <div class=\"image-container\">
                                                                    <img class=\"card-img-top img-thumbnail\" style=\"object-fit:contain;width:100%;height:100%\" src=\"/img/facility/$picCover\" alt=\"$title\">
                                                                </div>
                                                                <div class=\"card-body\">
                                                                    <div class=\"Name\">
                                                                        <p class=\"card-text facility-name\">$title</p>
                                                                    </div>
                                                                    <div class=\"priceperhour\">
                                                                    <span style=\"font-size: 10pt; color:grey;\" >RM $priceperhour Per Hour</span>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>   
                                                        </a>
                                                    </div>
                                                    
                                                    ");
                                                }
                                            }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- /.container-fluid -->
<br>
<?php
    require __DIR__ . '/footer.php'
?>

<style>
    .campus-name{
        color:white;
        height:50px;
        overflow:hidden;
        text-align: center;   

    }


</style>
