#!/usr/local/bin/php
<?php

include_once "config_def.php";

$conn  = pg_connect(CONNECTIONINFO);

if (!$conn) { 
  echo "Connection failed";
  exit;
}

session_start();
$username = $_POST['username'];
$_SESSION['username'] = $username;


$query = "SELECT userid FROM Users WHERE username = '".$username."'";
$result = pg_query($conn, $query);

$row = pg_num_rows($result);
if($row == 1){
	echo 0;
}
else{
	$query = "SELECT insertUser('".$username."')";
	$result = pg_query($conn, $query);
	echo 1;
}

?>
