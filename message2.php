<?php
session_start();
if(!($_SESSION['logged_in']))
{
    header("location:loginform.html");
}
// Establishing Connection with Server
$connection = mysql_connect("127.0.0.1", "root", "");
//selecting database from server
mysql_select_db("CheapoMail");
$i="select id from User where username='{$_SESSION['logged_in']}'";
$idd=mysql_query($i);
$id = mysql_fetch_row($idd);
$id=$id[0];
?>
<!DOCTYPE html>
<html>

<head>
	<title>Compose Message</title>
	<meta charset="UTF-8">
	<link href="Style.css" rel="stylesheet" type="text/css">
</head>

<body>
<nav>
	<ul>
		<li style="float:left;"><img src = "images.png"/></li>
		<li><form id="logout" action="" method="post">
				<a href="logout.php">
					Logout
				</a>

			</form>
		</li>

		<li><form action="" method="post">
				<a class="tab" href="cheapousers2.php">Users</a>
			</form>
		</li>
		<li><form class="theform" action="" method="post">
				<a class="tab" href="Homepage2.php">Home</a>
			</form>
		</li>
	</ul>
</nav>
        <br><h2>Compose Message</h2>
	<div class="ui main" style="padding-top: 40px;">
		<form id="form" action="messagee.php" method="post">
			
			<label for="sender">From:</label>
			<textarea id="sender" name="sender"><?php echo $id ?></textarea>

			
			<br>
			
			<label for="recipient">Recipient(s):</label>
			<textarea id="recipient" name="recipient"></textarea>

			
			<br>
			<label for="subject">Subject:</label>
			<br><textarea id="subject" name="subject"></textarea>

			
			<br>

			<label for="message">Message</label>
			<textarea id="message" name="message"></textarea>

			
			<br>

			<input type="submit" name="submit" value="Send"/>
		</form>
	</div>
</body>

</html>
