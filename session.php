<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("127.0.0.1", "root", "");
// Selecting Database
mysqli_select_db($connection, "CheapoMail");

session_start(); // Starting Session
// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql    = mysqli_query($connection, "SELECT username FROM login WHERE username ='$user_check'", $connection);
$row        = mysqli_fetch_assoc($ses_sql);

$login_session = $row['username'];
if (!isset($login_session)) {
    mysqli_close($connection); // Closing Connection
    header('Location: homepage.html'); // Redirecting To Home Page
}
?>