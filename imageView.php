<?php
    require __DIR__ . '/header.php';
    if(isset($_GET['image_id'])) {
        $sql = "SELECT `cover_image_type` , `cover_image` FROM `event` WHERE `event_id`=" . $_GET['image_id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["cover_image_type"]);
        echo $row["cover_image"];
	}
	mysqli_close($conn);
?>