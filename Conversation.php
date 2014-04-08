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
<div>
  <h1>Conversation</h1>
</div>
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
