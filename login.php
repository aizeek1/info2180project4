<?php
ob_start();
session_start(); // Starting Session
$error = ''; // Variable To Store Error
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        // Define $username and $password
        $username = $_POST['username'];
        $password = $_POST['password'];


        $connection = mysqli_connect("127.0.0.1", "root", "");

        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        mysqli_select_db($connection, "CheapoMail");

        // SQL query to fetch information of registered users and finds user match.
        $password_query = mysqli_query($connection, "SELECT password FROM User WHERE password='$password'");
        $password_db    = mysqli_fetch_row($password_query);
        $username_query = mysqli_query($connection, "SELECT username FROM User WHERE username='$username'");
        $username_db    = mysqli_fetch_row($username_query);
        $position_query = mysqli_query($connection, "SELECT position AS pos FROM User WHERE username='$username' AND password='$password'");
        $position       = mysqli_fetch_row($position_query);

        if ($username == $username_db[0] && $password == $password_db[0]) {
            $_SESSION['logged_in'] = $username; // Initializing Session
            if ( $position[0] == "Administrator") {
                header("Location: Homepage.php"); // Redirecting To Home Page
                exit();
            } else {
                header("Location: Homepage2.php"); // Redirecting To Home Page
                exit();
            }

        } else {
            echo "Username or Password is invalid";
        }
        mysqli_close($connection); // Closing Connection
    }
}
?>
