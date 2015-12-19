<?php
ob_start();
session_start();
if(!($_SESSION['logged_in']))
{
    header("location:loginform.html");
}

// Establishing Connection with Server
$connection = mysql_connect("127.0.0.1", "root", "");
//selecting database from server
mysql_select_db("CheapoMail");

$message_id = $_GET['message_id']; // get the message_id from the URL
$i="select id from User where username='{$_SESSION['logged_in']}'";
$idd=mysql_query($i);
$id = mysql_fetch_row($idd);
$id=$id[0];
$body = mysql_query("select body from Message where find_in_set($id, replace(recipient_ids, ' ', '')) and id = $message_id");
$body=mysql_fetch_row($body);
$body=$body[0];
$subject = mysql_query("select subject from Message where find_in_set($id, replace(recipient_ids, ' ', '')) and id = $message_id");
$subject=mysql_fetch_row($subject);
$subject=$subject[0];
$recipient= mysql_query("select recipient_ids from Message where find_in_set($id, replace(recipient_ids, ' ', '')) and id = $message_id");
$recipient=mysql_fetch_row($recipient);
$recipient=$recipient[0];
$user= mysql_query("select user_id from Message where find_in_set($id, replace(recipient_ids, ' ', '')) and id = $message_id");
$user=mysql_fetch_row($user);
$user=$user[0];
$reader="insert into Message_read (message_id, reader_id) values ('$message_id', '$recipient')";
mysql_query($reader,$connection);
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $subject ?></title>
        <meta charset="UTF-8">
	    <link href="Style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <nav>
        <ul>
            <li style="float: left;"><img src = "images.png"/></li>
            <li><form id="logout" action="" method="post">
                    <a href="logout.php">
                        Logout
                    </a>
                </form>
            </li>
            <li><form action="" method="post">
                    <a class="tab" href="newuser.php">Create User</a>
                </form>
            </li>
            <li><form action="" method="post">
                    <a class="tab" href="cheapousers.php">Users</a>
                </form>
            </li>
            <li><form action="" method="post">
                    <a class="tab" href="message.php">Compose Message</a>
                </form>
            </li>
            <li><form class="theform" action="" method="post">
                    <a class="tab" href="Homepage.php">Home</a>
                </form>
            </li>
        </ul>
    </nav>
        <div class="ui main">
            <form id="form" action="messagee.php" method="post">
                <label for="sender">From:</label>
                <textarea id="sender" name="sender" ><?php echo $id ?></textarea>


                <br>

                <label for="recipient">To:</label>
                <textarea id="recipient" name="recipient"><?php echo $user ?></textarea>


                <br>
                <label for="subject">Subject:</label>
                <br><textarea id="subject" name="subject">RE: <?php echo $subject ?></textarea>


                <br>

                <label for="message">Message</label>
                <textarea id="message" name="message"></textarea>

                <br>

                <input type="submit" name="submit" value="Reply"/>
            </form>
        </div>
    </body>
</html>