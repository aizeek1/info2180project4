<?php
session_start();
if(!($_SESSION['logged_in']))
{
    header("location:loginform.html");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>New User</title>
        <link href="Style.css" rel="stylesheet" type="text/css">
        <script src = "validuser.js"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    </head>
    <body>
        <div class="ui nav">
        <nav>
            <ul>
                <li style="float:left;"><img src = "images.png"/></li>

                <li><form class="theform" id="logout" action="" method="post">
                    <a href="logout.php">
                        Logout
                    </a>
                    
                </form>
                </li>
                <li><form class="theform" action="" method="post">
                    <a class="tab" href="message.php">Compose Message</a>
                    </form>
                </li>
                <li><form action="" method="post">
            <a class="tab" href="cheapousers.php">Users</a>
            </form>
            </li>
                <li><form class="theform" action="" method="post">
                    <a class="tab" href="Homepage.php">Home</a>
                    </form>
                </li>
            </ul>
        </nav>
        </div>
        
        <div id ="my">
            <h2 id ="clog">Create New CheapoMail Account</h2>
        </div>
        
        <br><div id="user">
            <form id="userform" name="userForm" action="user.php" method="post" onsubmit="return validateForm()">
                <label>First Name: </label>
                <br><input type="text" name="firstname" placeholder ="First Name" id ="pname" onchange="return validateForm()"/><br>
                <br><label>Last Name: </label>
                <br><input type="text" name="lastname" placeholder="Last Name" id = "pname" onchange="return validateForm()"/></br>
                <br><label>Choose a username :</label></br>
                <input id="name" name="username" placeholder="username" type="text" onchange="return validateForm()"/><br>
                <br><label>Position:</label>
                <br><div class="note">*Either Administrator or Non-Administrator</div>
                <input id="position" name="position" placeholder="position" type="text" onchange="return validateForm()"/><br>
                <br><label>Create a password :</label>
                <br><div class="note">*Should contain at least one number, one common letter and one capital letter and be at least 8 charachters long</div>
                <input id="password" name="password" placeholder="**********" type="password" onchange="return validateForm()"/><br>
                <br><label>Confirm password :</label></br>
                <input id="confimpassword" name="confirmpassword" placeholder="**********" type="password" onchange="return validateForm()"/><br>
                <input type="submit" name="submit" value="Submit"/>
            </form>
        </div>
    </body>
</html>
            
       