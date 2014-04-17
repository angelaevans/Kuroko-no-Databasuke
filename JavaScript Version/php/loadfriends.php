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

	$query = "SELECT friendList('".$username."')";
	$result = pg_query($conn, $query);

	$jsonoutput = array();
	while($row =pg_fetch_row($result)){
		 array_push($jsonoutput, $row);
	}
	
	echo json_encode($jsonoutput);
?>
