#!/usr/local/bin/php
<!doctype html>
<?php session_start();?>
<html>
<head>
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet" href="stylesheet3.css" />
<title><?php echo $_SESSION['uname']; ?></title>
</head>

<body>
<div>
  <h1><?php echo $_SESSION['uname']; ?></h1>
</div>
<table align="center" width="751" height="459">
  <tr>
    <td width="226" height="71"><label id="friend" for="select">Friends:</label></td>
  </tr>
  <tr>
    <td height="380"><ul>
     <!--fill with php loop.
     not sure how to link to conversation page-->
	</ul></td>
    <td width="513" align="center"><img src="Kuroko/friends-season.jpg" alt="" width="441" height="302" align="right"/></td>
  </tr>
</table>
<p align="center">
  <label for="textfield">Add New Friend:</label>
	<input type="text" name="textfield" id="textfield" placeholder="Friend's Username">
	<input type="button" name="AddFriend" id="AddFriend" value="Add Friend">
</p>
</body>
</html>
