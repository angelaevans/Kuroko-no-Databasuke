#!/usr/local/bin/php
<?php
include_once "php/config_def.php";

$conn  = pg_connect(CONNECTIONINFO);
if (!$conn) { 
  echo "Connection failed";
  exit;
}
if($_POST[AddFriend]){
$insert = "SELECT Addfriend('$_SESSION[uname]', '$_POST[add]')";
$result = pg_query($conn, $insert);
$row = pg_num_rows($result);
if(row > 1){
	echo "<p align='center'>Already friends</p>";
	exit;
}
else{
	header("Location: Conversation.html");
	exit;
}
}

?>
