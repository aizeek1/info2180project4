<?php
ob_start();
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
    <title>Homepage</title>
    <link href="Style.css" rel="stylesheet" type="text/css">
</head>
<body onload="repeatAjax()">
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
                    <a class="tab" href="cheapousers2.php">Users</a>
                </form>
            </li>
            <li><form action="" method="post">
                    <a class="tab" href="message2.php">Compose Message</a>
                </form>
            </li>
            <li></li>
        </ul>
    </nav>
</div>

<div class="ui main">
    <table id="">
        <thead>
        <tr>
            <th scope="col">Your Last Ten Messages</th>
        </tr>
        </thead>
         <tbody id="msg_table">
            <?php
            $connection = mysqli_connect("127.0.0.1", "root", "");
            mysqli_select_db($connection, "CheapoMail");
            $username = $_SESSION['logged_in'];
            $query = "SELECT id, position from User WHERE username='$username'";
            if ($query_result = mysqli_query($connection, $query)) {
                $id_pos = mysqli_fetch_array($query_result);
                $id = $id_pos['id'];
                $position = $id_pos['position'];

                $message_query = mysqli_query($connection, "SELECT * FROM Message WHERE find_in_set($id, replace(recipient_ids, ' ', '')) ORDER BY '$id' ASC LIMIT 10");
                $row_count = mysqli_num_rows($message_query);

                if ($row_count == 0) {
                    echo "<tr><td>No Messages.</td></tr>";
                }

                $_SESSION['count'] = $row_count;
                $message_query2 = mysqli_query($connection, "SELECT Message.id AS id FROM Message JOIN Message_read WHERE Message.id = Message_read.message_id");
                $read_count = mysqli_num_rows($message_query2);

                $read_messages = array();
                while ($row = mysqli_fetch_array($message_query2)) {
                    if (!in_array($row['id'], $read_messages)) {
                        array_push($read_messages, $row['id']);
                    }
                }
                $str = "";

                $counter = 0;
                while ($row = mysqli_fetch_array($message_query)) {
                    $h_id = "h" . $row['id'];
                    $b_id = "b" . $row['id'];
                    $counter = $row['id'];
                    if ($read_count > 0 and in_array($counter, $read_messages)) {
                        $str = $str . "
                    <tr> <td onclick=\"showMessage('$h_id', '$b_id')\">" .
                            "
                        <span style=\"font-weight: normal;\" class=\"msg_header\" id='$h_id'>" .
                            "Subject: " . $row['subject'] . ". Received From ID: " . $row['user_id']
                            . "</span>
                        <br>
                        <br>
                        <span id='$b_id' class=\"msg_body\">Message: " . $row['body'] .
                            "<br><br>
                        <button class='$position' onclick=\"reply('$b_id', '$position')\">Reply</button></span>
                    </td> </tr>";
                    } else {
                        $str = $str . "
                    <tr> <td onclick=\"showMessage('$h_id', '$b_id')\">" .
                            "
                        <span class=\"msg_header\" id='$h_id'>" .
                            "Subject: " . $row['subject'] . ". Received From ID: " . $row['user_id']
                            . "</span>
                        <br>
                        <br>
                        <span id='$b_id' class=\"msg_body\">Message: " . $row['body'] .
                            "<br><br>
                        <button class='$position' onclick=\"reply('$b_id', '$position')\">Reply</button></span>
                    </td> </tr>";
                    }
                }
                echo $str;
            }
            mysqli_close($connection); // Closing Connection
            ?>
        </tbody>
    </table>
</div>
<script src="message.js" type="text/javascript"></script>
</body>
</html>
