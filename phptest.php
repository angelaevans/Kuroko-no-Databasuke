#!/usr/local/bin/php
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>PHP Test</title>
</head>
<body>
	<h1> Kuroko no Databasuke </h1>
	<h2> Create a new Account </h2>
	<form class="form" id="addUserForm" name="addUserForm" method="POST">
		Username: <input type="text" name="username" value="Username Here"> <br>
		<input type="submit" value="Create User">
	</form>
</body>
</html>
<?php
$conn  = pg_connect('user=htluong host=postgres.cise.ufl.edu dbname=kuroko password=Fun40xint101r2');

if (!$conn) { 
  echo "Connection failed";
  exit;
}

$query = "SELECT insertUser('$_POST[username]')";
$result = pg_query($conn, $query);

if (!$result) {
    echo "That Username is already used!\n";
    exit;
}
?>