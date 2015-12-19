<?php
ob_start();
session_start();
$msg_id = $_GET['msg_id'];
    $connection = mysqli_connect("127.0.0.1", "root", "");
    mysqli_select_db($connection, "CheapoMail");

    $username = $_SESSION['logged_in'];

    $query = "SELECT id from User WHERE username='$username'";
    $query_result = mysqli_query($connection, $query);
    $id = mysqli_fetch_row($query_result);
    $id = $id[0];

    $query = "INSERT INTO Message_read(message_id, reader_id) VALUES('$msg_id', '$id') ";
    mysqli_query($connection, $query);

    $message_query = mysqli_query($connection, "SELECT * FROM Message WHERE find_in_set($id, replace(recipient_ids, ' ', '')) ORDER BY '$id' DESC LIMIT 10");
    $new_row_count = mysqli_num_rows($message_query);

    $str = "";

        if ($new_row_count == 0) {
            $str = "<tr><td>No Messages.</td></tr>";
        }
        if ($new_row_count > $_SESSION['count'] or $new_row_count == $_SESSION['count']) {
        $_SESSION['count'] = $new_row_count;
        $message_query = mysqli_query($connection, "SELECT * FROM Message WHERE find_in_set($id, replace(recipient_ids, ' ', '')) ORDER BY '$id' DESC LIMIT 10");

        $message_query2 = mysqli_query($connection, "SELECT Message.id AS id FROM Message JOIN Message_read WHERE Message.id = Message_read.message_id");
        $read_count = mysqli_num_rows($message_query2);

        $read_messages = array();
        while ($row = mysqli_fetch_array($message_query2)) {
            if (!in_array($row['id'], $read_messages)) {
                array_push($read_messages, $row['id']);
            }
        }
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
        mysqli_close($connection); // Closing Connection
    }
?>