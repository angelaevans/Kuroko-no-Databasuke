#!/usr/local/bin/php

<html><head><title>PHP Test</title></head><body>
<?php 

$conn  = pg_connect('user=htluong host=postgres.cise.ufl.edu dbname=kuroko password=Fun40xint101r2');

if (!$conn) { 
  echo "Connection failed";
  exit;
}

$query = sprintf("select * from users");
$result = pg_query($conn, $query);

if (!$result) {
    echo rand(0,5)."An error occured.\n";
    exit;
}

while ($row = pg_fetch_array($result)) {

    echo "userid: " . $row[0] . "<br />";

    echo "username: " . $row[1] . "<p />";

}

// free memory

pg_free_result($result);

// close connection

pg_close($conn);

?>
</body></html>
