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
	<form class="form" id="FriendList" name="FriendList" method="POST">
	<?php
		
		include_once "config_def.php";

		$conn = pg_connect(CONNECTIONINFO);
		if (!$conn) {
		  echo "Connection failed";
 		  exit;
		}	

		$query = "SELECT friendList('$_SESSION[uname]')";
		$result = pg_query($conn, $query);
		$fList = pg_fetch_all_columns($result, 0);
		foreach($fList as &$friend)
		{
			echo "<input name=Friend type=submit id=Friend value=" . $friend . "> <br>";
		}
		if($_POST[Friend])
		{
			$_SESSION = /*Script goes here?*/
			header("Location: Conversation.php");
			exit;
		}

		
	?>
	</form>
	</ul></td>
    <td width="513" align="center"><img src="Kuroko/friends-season.jpg" alt="" width="441" height="302" align="right"/></td>
  </tr>
</table>
<form class="form" id="addFriendForm" name="addFriendForm" method="POST">
<p align="center">
  <label for="textfield">Add New Friend:</label>
	<input type="text" name="add" id="textfield" placeholder="Friend's Username">
	<input type="submit" name="AddFriend" id="AddFriend" value="Add Friend">

  <label for="textfield">Delete Friend:</label>
	<input type="text" name="delete" id="textfield" placeholder="Friend's Username">
	<input type="submit" name="DeleteFriend" id="DeleteFriend" value="Delete Friend">
</p>
</form>
</body>
</html>


<?php
include_once "config_def.php";

$conn  = pg_connect(CONNECTIONINFO);
if (!$conn) { 
  echo "Connection failed";
  exit;
}

if($_POST[AddFriend]){
$insert = "SELECT Addfriend('$_SESSION[uname]', '$_POST[add]')";
$result = pg_query($conn, $insert);
$row = pg_num_rows($result);
if(row > 1){
	echo "<p align='center'>Already friends</p>";
	exit;
}
else{
	header("Location: Conversation.php");
	exit;
}
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

