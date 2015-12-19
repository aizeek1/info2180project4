<?php
// Establishing Connection with Server
$connection = mysql_connect("127.0.0.1", "root", "");
//selecting database from server
mysql_select_db("CheapoMail");

 if (isset($_POST['submit']))
    {
        if (empty($_POST["recipient"])) 
        {
            echo "Field can not be empty";
        }
        else
        {
            $recipient=($_POST["recipient"]);
        }
         if (empty($_POST["subject"])) 
        {
            echo "Field can not be empty";
        }
        else
        {
            $subject=($_POST["subject"]);
        }
          if (empty($_POST["sender"])) 
        {
            echo "Field can not be empty";
        }
        else
        {
            $sender=($_POST["sender"]);
        }
        $message=($_POST["message"]);
        $messpo=mysql_query("select position from User where id='$sender'");
        $messpoo=mysql_fetch_row($messpo);
        
        //insert data in form fields into database table 
        $sql ="INSERT INTO Message(body, subject, user_id, recipient_ids) VALUES ('$message', '$subject', '$sender', '$recipient')";
        mysql_query($sql,$connection);
        
         if($messpoo[0]=="Administrator")
        {
            header("Location: Homepage.php"); // Redirecting To Home Page
            exit();
        }
        else
        {
            header("Location: Homepage2.php"); // Redirecting To Home Page
            exit();
        }
    }
    mysql_close($connection);
?>