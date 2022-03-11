<?php
	if(!isset($_SESSION)){
		session_start();
	}

	//Destroy Session
	$_SESSION = array();
	setcookie(session_name(), '', time() - 2592000);
	session_destroy();
	
	header("Location: Main.php");
	exit;
?>