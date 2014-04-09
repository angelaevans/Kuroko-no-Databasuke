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
  <form class="form" id="Logout" name="Logout" method="POST">
	<input name="Logout" type="submit" id ="Logout" value="Logout">
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
<p align="center">
  <label for="textfield">	Image Path:</label>
  <input type="text" name="textfield" id="textfield">
  <input name="PictureSelect" type="button" id="PictureSelect" value="Picture Select">
</p>
</body>
</html>
<?php
if($_POST['Logout']){
	session_destroy();
	header("Location: LoginPage.php");
}
?>
