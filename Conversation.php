#!/usr/local/bin/php
<!doctype html>
<?php session_start();?>
<html>
<head>
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet" href="stylesheet2.css" />
<title><?php echo $_SESSION['uname']." | " .$_SESSION['fname']; ?></title>
</head>

<body>
<div align="right">
  <form class="form" id="buttons" name="buttons" method="POST">
	<input name="FriendsList" type="submit" id ="FriendsList" value="FriendsList"><input name="Logout" type="submit" id ="Logout" value="Logout">
  </form>
</div>
<h1>Conversation</h1>
<div align="center">
  <table width="831" id="table">
    <tr>
      <td width="407"><?php echo $_SESSION['uname']; ?></td>
      <td width="407"><?php echo $_SESSION['fname']; ?></td>
    </tr>
    <tr>
      <td height="314" align="center">
	<?php
	include_once "config_def.php";

	$conn = pg_connect(CONNECTIONINFO);

	if (!$conn) {
	  echo "Connection failed";
	  exit;
	}
	$query = "SELECT picPath FROM Pictures WHERE picID = (SELECT getpicidfromConversation('".$_SESSION['uname']."', '".$_SESSION['fname']."'))";	$result = pg_query($conn, $query);
	$row = pg_fetch_row($result);
	$_SESSION['pic'] = $row[0];
	echo "<img src=". $_SESSION['pic'] . " />" ?>
	</td>
      <td height="314" align="center">
	<?php
	include_once "config_def.php";

	$conn = pg_connect(CONNECTIONINFO);

	if (!$conn) {
	  echo "Connection failed";
	  exit;
	}
	$query = "SELECT picPath FROM Pictures WHERE picID = (SELECT getpicidfromConversation('".$_SESSION['fname']."', '".$_SESSION['uname']."'))";
	$result = pg_query($conn, $query);
	$row = pg_fetch_row($result);
	$_SESSION['pic'] = $row[0];
	echo "<img src=". $_SESSION['pic'] . " />" ?>
	</td>
    </tr>
  </table>
</div>
<p align="center">Send New Picture:</p>
<form class="form" id="Pictures" name="Pictures" method="POST">
<p align="center">
  <label for="textfield">	Image Path:</label>
  <input type="text" name="url" id="textfield" placeholder="Image Number">
  <input name="PictureSelect" type="submit" id="PictureSelect" value="Picture Select">
</p>
<p align="center"><input name="PostPicture" type="submit" id="PostPicture" value="Send Message!"><p>
</form>
</body>
</html>
<?php
include_once "config_def.php";

$conn = pg_connect(CONNECTIONINFO);

if (!$conn) {
  echo "Connection failed";
  exit;
}

if($_POST['Logout']){
	session_destroy();
	header("Location: LoginPage.php");
}
if($_POST['FriendsList']){
	unset($_SESSION['fname']);
	header("Location: FriendList.php");
}
if($_POST['PictureSelect']){
	header("Location: Pictures.php");
}
if($_POST['PostPicture']){	
	$address = $_POST['url'];
	$query= "SELECT Sendnewmessage('".$_SESSION['uname']."', '".$_SESSION['fname']."', ".$address.")";
	$result = pg_query($conn, $query); 
	$page = $_SERVER['PHP_SELF'];
	header("Refresh: 0, url=$page");
}
?>

