#!/usr/local/bin/php
<?php

include_once "config_def.php";

$conn  = pg_connect(CONNECTIONINFO);

if (!$conn) { 
  echo "Connection failed";
  exit;
}
session_start();
echo $_SESSION['friendname'];
?>