#!/usr/local/bin/php
<?php
include_once "config_def.php";

$conn  = pg_connect(CONNECTIONINFO);
if (!$conn) { 
  echo "Connection failed";
  exit;
}
session_start();

$user = $_SESSION['username'];
$friend = $_POST['friendname'];


$query = "SELECT userid FROM Users WHERE username = '".$friend."'";
$result = pg_query($conn, $query);

$row = pg_num_rows($result);

if($row == 1){
	$test = "SELECT aretheyfriends('".$user."','".$friend."')";
	$result = pg_query($conn, $test);
	$row = pg_fetch_row($result);

	if($row[0] == "t"){
		$insert = "SELECT deleteFriend('".$user."','".$friend."')";
		$result = pg_query($conn, $insert);
		echo 1;
	}
	else{
		echo -1;
	}
}
else{
        echo 0;
}

?>
