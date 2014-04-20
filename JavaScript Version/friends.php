#!/usr/local/bin/php
<!doctype html>
<?php session_start();?>
<html>
<head>
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="css/stylesheet3.css" />
	<title><?php echo $_SESSION['username']; ?></title>
	<script type="text/JavaScript" src="js/js_functions.js"></script> 
</head>

<body onload="firstload()">
<input name="Logout" type="submit" id ="Logout" value=" [ Logout ] " onClick="javascript:logout();">
  <h1><?php echo $_SESSION['username']; ?></h1>
<table width="100%" height="66%">
  <tr>
    <td width="226" height="71"><label id="friend" for="select">Friends:</label></td>
    <td width="226" height="71" align="center"><label id="friend" for="select" >Chat Conversation</label></td>
  </tr>
  <tr>
    <td width="25%"  valign="top">
	    <div id= "friendbox" style="max-height:400px;overflow:auto; min-width:280px;">

	    
	    </div>
	    <div>
			<input type="text" name="add" id="AddFriendtextfield" placeholder="Friend's Username">
			<input type="submit" name="AddFriend" id="AddFriend" value="Add Friend" onClick="javascript:checkAddFriend();">
			<br />
			<input type="text" name="delete" id="DeleteFriendtextfield" placeholder="Friend's Username"><input type="submit" name="DeleteFriend" id="DeleteFriend" value="Delete Friend" onClick="javascript:checkDeleteFriend();">
			<div align="center" id="status"></div>
		</div>
	</td>
	<td width="75%" valign="top">
		<div align="center">
		  <table width="831" id="table">
		    <tr>
		      <td width="407" id="namelabel">Your Message</td>
		      <td width="408" id="namelabel"><div id="friendname"></div></td> 
		    </tr>
		    <tr>
		      <td height="314"><div id="userconversation"><img src="http://www.toplessrobot.com/assets_c/2010/02/IchigoQuestionMarks-thumb-300x224.jpg"></div></td>
		      <td><div id="friendconversation"><img src="http://www.toplessrobot.com/assets_c/2010/02/IchigoQuestionMarks-thumb-300x224.jpg"></div></td>
		    </tr>
		  </table>
		</div>
		<p align="center" id="imageselectlabel">Send Reply:</p>
		<p align="center" id="imageselection">
		  <img alt="[Message Here]" id="picidfield">
		  <input name="picselected" type=hidden id="picselected">
		  <input name="Sendbutton" type="submit" id="Sendbutton" value="Send!" onClick="javascript:checksendmessage();">
		</p>

	</td>
  </tr>
</table>
<div align="center" id="picturepage"></div>
<div align="center" id="picpagenum"></div>
</tr>
</body>
</html>
