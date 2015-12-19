<?php
session_start();
session_unset();
session_destroy(); // Destroying All Sessions
header("Location:loginform.html"); // Redirecting To Login Page
?>
