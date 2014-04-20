#!/usr/local/bin/php
<?php

include_once "config_def.php";

$conn  = pg_connect(CONNECTIONINFO);
session_start();

if (!$conn) { 
  echo "Connection failed";
  exit;
}

$picid = $_POST['picid'];
$username = $_SESSION['username'];
//$friendname = $_SESSION['friendname'];

//$query= "SELECT Sendnewmessage('".$username."', '".$friendname."', ".$picid.")";
//$query= "SELECT Sendnewmessage('".$username."', 'Huy', ".$picid.")";

//$result = pg_query($conn, $query);

?>
