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
      <td width="408"><?php echo $_SESSION['fname']; ?></td>
    </tr>
    <tr>
      <td height="314">Message from User</td>
      <td>Message from Friend</td>
    </tr>
  </table>
</div>
<p align="center">Send New Picture:</p>
<form class="form" id="Pictures" name="Pictures" method="POST">
<p align="center">
  <label for="textfield">	Image Path:</label>
  <input type="text" name="textfield" id="textfield" placeholder="Image URL">
  <input name="PictureSelect" type="submit" id="PictureSelect" value="Picture Select">
</p>
<p align="center"><input name="PostPicture" type="submit" id="PostPicture" value="Send Message!"><p>
</form>
</body>
</html>
<?php
if($_POST['Logout']){
	session_destroy();
	header("Location: LoginPage.php");
}
if($_POST['FriendsList']){
	unset($_SESSION['fname']);
	header("Location: FriendList.php");
}
?>

