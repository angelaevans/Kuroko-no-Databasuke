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
  <input name="Login" type="submit" id="Login" value="Login!"><input name="NewUser" type="submit" id="NewUser" value="New User!">
</p>
</form>
</body>
</html>
<?php
$conn  = pg_connect("host=postgres.cise.ufl.edu dbname=kuroko user=htluong password=Fun40xint101r2");

if (!$conn) { 
  echo "Connection failed";
  exit;
}

session_start();
$_SESSION['uname']= $_POST[username];

if($_POST[Login]){
$query = "SELECT userid FROM Users WHERE username = '$_SESSION[uname]'";
$result = pg_query($conn, $query);
$row = pg_num_rows($result);
if($row == 0){
	echo "<p align='center'>Username does not exist. Create new account?</p>";
	exit;
}
else{
	header("Location: FriendList.php");
	exit;
}
}

if ($_POST[NewUser]){
$query = "SELECT insertUser('$_POST[username]')";
$result = pg_query($conn, $query);
if (!$result) {
    echo "<p align='center'>No submission. Maybe the Username is already used?\n</p>";
    exit;
}
else{
    header("Location: FriendList.php");
    exit;
}
}
?>

