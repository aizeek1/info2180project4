<?php
ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            CheapoMail Users
        </title>
        <link href="Style2.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="ui nav">
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
            <a class="tab" href="message2.php">Compose Message</a>
            </form>
        </li>
        <li><form action="" method="post">
            <a class="tab" href="Homepage2.php">Home</a>
            </form>
        </li>
        <li></li>
    </ul>
</nav>
</div>
        <h2>CheapoMail Users</h2>
        <?php
            session_start();
            if(!($_SESSION['logged_in']))
{
    header("location:loginform.html");
}
            $connection = mysql_connect("127.0.0.1", "root", "");
            //selecting database from server
            mysql_select_db("CheapoMail");
            
            $users=mysql_query("select id, firstname, lastname from User");
            echo '<table id="tabe">';
            echo '<tr class="ta"><th>ID #</th><th>First name</th><th>Last name</th></tr>';

            while($row = mysql_fetch_array($users))
            {
                echo '<tr><td >'.$row['id'].'</td><td >'.$row['firstname'].'</td><td>'.$row['lastname'].'</td></tr>';
            }
            echo "</table>";
        ?>
    </body>
</html>