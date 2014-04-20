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
$friendname = $_SESSION['friendname'];

$query = "SELECT userid FROM Users WHERE username = '".$friendname."'";
$result = pg_query($conn, $query);

$row = pg_num_rows($result);

if($row == 1){
        $test = "SELECT aretheyfriends('".$username."','".$friendname."')";
        $result = pg_query($conn, $test);
        $row = pg_fetch_row($result);

        if($row[0] == "t"){
		$query= "SELECT Sendnewmessage('".$username."', '".$friendname."', ".$picid.")";
                $result = pg_query($conn, $query);
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
