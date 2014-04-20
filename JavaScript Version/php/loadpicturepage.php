#!/usr/local/bin/php
<?php
	include_once "config_def.php";
	session_start();

	$conn = pg_connect(CONNECTIONINFO);

	if (!$conn) {
		echo "Connection failed";
		exit;
	}	
	$jsonoutput = array();


	$query = "SELECT getpicturesbypagemaxpage()";
	$result = pg_query($conn, $query);

	$picpage = $_SESSION['picpage'];

	$row = pg_fetch_row($result);

	array_push($jsonoutput, '["'.$picpage.'"]');
	array_push($jsonoutput, $row);



	$query = "SELECT getpicturesbypage(".$picpage.")";
	$result = pg_query($conn, $query);

	while($row =pg_fetch_row($result)){
		 array_push($jsonoutput, $row);
	}
	
	echo json_encode($jsonoutput);
?>
