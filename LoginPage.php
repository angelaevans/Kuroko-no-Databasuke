#!/usr/local/bin/php
<!doctype html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="stylesheet.css" />
<meta charset="UTF-8">
<title>Kuroko no Databasuke</title>
</head>

<body>
<div align="center"><img src="Kuroko/KurokoNoDatabasuke.jpg" alt="Kuroko no Databasuke" /></div>
<form class="form" id="addUserForm" name="addUserForm" method="POST">
<h1 align="center" id="username">
  <label for="textfield"> 
  Username:
  </label></h1>
<p align="center">
  <input type="text" placeholder="Username" name="username" id="textfield"><br>
  <input name="Login" type="button" id="Login" value=" Login!       "><input name="NewUser" type="submit" id="NewUser" value="New User!">
</p>
</form>
</body>
</html>
<?php
$conn  = pg_connect('user=htluong host=postgres.cise.ufl.edu dbname=kuroko password=Fun40xint101r2');

if (!$conn) { 
  echo "Connection failed";
  exit;
}

if ($_POST[NewUser]){
$query = "SELECT insertUser('$_POST[username]')";
$result = pg_query($conn, $query);
if (!$result) {
    echo "No submission. Maybe the Username is already used?\n";
    exit;
}
}
elseif{
    echo "The login would happen here.\n";
    exit;
}
}
?>