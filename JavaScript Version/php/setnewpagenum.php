#!/usr/local/bin/php
<?php
	include_once "config_def.php";
	session_start();

	$conn = pg_connect(CONNECTIONINFO);

	if (!$conn) {
		echo "Connection failed";
		exit;
	}	
	$_SESSION['picpage'] = $_POST['newpicpage'];
	
?>
