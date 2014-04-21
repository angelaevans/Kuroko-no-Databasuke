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
	$friendname = $_SESSION['friendname'];

	$query = "SELECT picPath FROM pictures WHERE picID = (SELECT getpicidfromConversation('".$username."', '".$friendname."'))";
	$result = pg_query($conn, $query);
	$row = pg_fetch_row($result);
	echo $row[0];
?>