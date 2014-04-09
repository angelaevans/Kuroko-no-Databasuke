#!/usr/local/bin/php
<!doctype html>
<?php session_start();?>
<html>
<head>
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="css/stylesheet3.css" />
	<title><?php echo $_SESSION['uname']; ?></title>
	<script type="text/JavaScript" src="js/js_functions.js"></script> 
</head>

<body onload="loadfriends()">
<div>
  <h1><?php echo $_SESSION['uname']; ?></h1>
</div>

<table width="100%" height="66%">
  <tr>
    <td width="226" height="71"><label id="friend" for="select">Friends:</label></td>
    <td width="226" height="71" align="center"><label id="friend" for="select" >Conversation:</label></td>
  </tr>
  <tr>
    <td width="20%"  valign="top">
	    <div id= "friendbox" height="50px">

	    
	    </div>
	    <div>
			<input type="text" name="add" id="AddFriendtextfield" placeholder="Friend's Username">
			<input type="submit" name="AddFriend" id="AddFriend" value="Add Friend" onClick="javascript:checkAddFriend();">
			<br />
			<input type="text" name="delete" id="DeleteFriendtextfield" placeholder="Friend's Username">
			<input type="submit" name="DeleteFriend" id="DeleteFriend" value="Delete Friend">
			<div align="center" id="status"></div>
		</div>
	</td>
	<td width="75%" valign="top">
		<div align="center">
		  <table width="831" id="table">
		    <tr>
		      <td width="407"><?php echo $_SESSION['uname']; ?></td>
		      <td width="408"><?php echo $_SESSION['fname']; ?></td>
		    </tr>
		    <tr>
		      <td height="314">Message from User</td>
		      <td>Message from Friend</td>
		    </tr>
		  </table>
		</div>
		<p align="center">Send New Picture:</p>
		<p align="center">
		  <label for="textfield">	Image Path:</label>
		  <input type="text" name="textfield" id="textfield">
		  <input name="PictureSelect" type="button" id="PictureSelect" value="Picture Select">
		</p>

	</td>
  </tr>
</table>
<form class="form" id="addFriendForm" name="addFriendForm" method="POST">
</form>
</body>
</html>



<?php
include_once "php/config_def.php";

$conn  = pg_connect(CONNECTIONINFO);
if (!$conn) { 
  echo "Connection failed";
  exit;
}

if($_POST[DeleteFriend]){
$del = "SELECT deleteFriend('$_SESSION[uname]', '$_POST[delete]')";
$result = pg_query($conn, $del);
$row = pg_num_rows($result);
if(!result){
	echo "<p align='center'>Not Friends</p>";
	exit;
}
else{
	echo "<p align='center'>Friend Deleted</p>";
	exit;
}
}
//The messages don't output right, but the friends are added/deleted correctly
?>

