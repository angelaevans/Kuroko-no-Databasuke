#!/usr/local/bin/php
<!doctype html>
<?php session_start();?>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="css/stylesheet.css" />
    <meta charset="UTF-8">
    <script type="text/JavaScript" src="js/js_functions.js"></script> 
    <title>Kuroko no Databasuke</title>
</head>

<body>
<div align="center"><img src="Kuroko/KurokoNoDatabasuke.jpg" alt="Kuroko no Databasuke" /></div>
    <p align="center">
      <input    type="text" 
                placeholder="Username" 
                name="Usernameinput" 
                id="Usernameinput">
      <br />

      <input    name="Login" 
                type="submit" 
                id="Login" 
                value="Login!"
                onClick="javascript:login();">

      <input    name="NewUser" 
                type="submit" 
                id="NewUser" 
                value="New User!"
                onClick="javascript:register();">
    </p>
<div align="center" id="status"></div>
<br />
<div align="center" id="testing"></div>
</body>
</html>