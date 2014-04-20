#!/usr/local/bin/php
<?php
	include_once "config_def.php";
	session_start();

	$conn = pg_connect(CONNECTIONINFO);

	if (!$conn) {
		echo "Connection failed";
		exit;
	}	

	$username = $_SESSION['username'];
	
	$_SESSION['friendname'] = "Your Friend";
	echo $_SESSION['friendname'];
?>
