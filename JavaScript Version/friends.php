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
  <h1 id="bannername"><?php echo $_SESSION['username']; ?></h1>
<table width="100%" height="66%">
  <tr>
    <td width="226" height="71"><label id="friend" for="select">Friends:</label></td>
    <td width="226" height="71" align="center"><label id="friend" for="select" >Chat Conversation</label></td>
  </tr>
  <tr>
    <td width="25%"  valign="top">
	    <div id= "friendbox" style="max-height:400px;overflow:auto; min-width:280px;"></div>
	    <div id="addremovefriend">
			<input type="text" name="add" id="AddFriendtextfield" placeholder="Friend's Username">
			<input type="text" name="delete" id="DeleteFriendtextfield" placeholder="Friend's Username">
			<br />
			<input type="button" name="AddFriend" id="AddFriend" value="Add Friend" onClick="javascript:checkAddFriend();"><input type="button" name="DeleteFriend" id="DeleteFriend" value="Delete Friend" onClick="javascript:checkDeleteFriend();">
			<br /?
			<p><div align="center" id="status"></div></p>
		</div>
	</td>
	<td width="75%" valign="top">
		<div align="center">
		  <table width="75%" id="table">
		    <tr>
		      <td width="30" id="namelabel"><div id="friendname"></td>
		      <td width="30" id="namelabel">Your Message</div></td> 
		    </tr>
		    <tr>
		      <td height="250"><div id="friendconversation"><img src="http://www.toplessrobot.com/assets_c/2010/02/IchigoQuestionMarks-thumb-300x224.jpg"></div></td>
		      <td><div id="userconversation"><img src="http://www.toplessrobot.com/assets_c/2010/02/IchigoQuestionMarks-thumb-300x224.jpg"></div></td>
		    </tr>
		  </table>
		</div>
		<div align="center">
			<table width="100%" height="150" id="table">
				<tr><div align="center" id="namelabel">Send a Reply</div></tr>
				<tr><div id="instructions">Click the image you want to reply with below, and then press the send button!</div></tr>
				<tr>
					<td>
						<div align="center" id="picturepage"></div>
						<div align="center" id="picpagenum"></div>
					</td>
					<td>
						<div align="center" id="imageselection">
						<img alt="[Message Here]" id="picidfield">
						<input name="picselected" type=hidden id="picselected">
						<input name="Sendbutton" type="button" id="Sendbutton" value="Send!" onClick="javascript:checksendmessage();">
						</div>
					</td>
				</tr>
			</table>
		</div>
	</td>
  </tr>
</table>
</tr>
</body>
</html>