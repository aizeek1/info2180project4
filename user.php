<?php
ob_start();

$connection = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($connection, "CheapoMail");

$firstnameError       = "";
$lastnameError        = "";
$usernameError        = "";
$positionError        = "";
$passwordError        = "";
$confirmpasswordError = "";
$matchError           = "";
// On submitting form function below will execute.
if (isset($_POST['submit'])) {
    //validation of fields
    if (empty($_POST["firstname"])) {
        $firstnameError = "First Name is required";
        echo $firstnameError;
    } else {
        $firstname = $_POST["firstname"];
        // check name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
            $firstnameError = "Only letters and white space allowed";
            echo $firstnameError;
        }
    }
    if (empty($_POST["lastname"])) {
        $lastnameError = "Last Name is required";
        echo $lastnameError;
    } else {
        $lastname = $_POST["lastname"];
        // check name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
            $lastnameError = "Only letters and white space allowed";
            echo $lastnameError;
        }
    }

    if (empty($_POST["username"])) {
        $usernameError = "username is required";
        echo $usernameError;
    } else {
        $username = $_POST["username"];
        // check name only contains natural numbers
        if (!preg_match("/^[A-Za-z\d]*$/", $username)) {
            $usernameError = "Only letters and numbers allowed";
            echo $usernameError;
        }
    }

    if (empty($_POST["position"])) {
        $positionError = "Position is required";
        echo $positionError;
    } else {
        $position = $_POST["position"];
        // check name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $position)) {
            $positionError = "Only letters and white space allowed";
            echo $positionError;
        }
    }

    if (empty($_POST["password"])) {
        $passwordError = " Password is required";
        echo $passwordError;
    }
    else{
        if (!preg_match("/^.(?=.{8,})(?=.[A-Z])(?=.[a-z])(?=.[0-9]).$/",($_POST["password"]))){
            $passwordError = "Must be at least 8 characters long and contation at least one number, one capital letter and one common letter";
            echo $passwordError;
        }
    }
    if (empty($_POST["confirmpassword"])) {
        $confirmpasswordError = " Confirm Password is required";
        echo $confirmpasswordError;
    }
    else{
        if(!preg_match("/^.(?=.{8,})(?=.[A-Z])(?=.[a-z])(?=.[0-9]).$/",($_POST["confirmpassword"]))){
            $confirmpasswordError = "Must be at least 8 characters long and contation at least one number, one capital letter and one common letter";
            echo $confirmpasswordError;
            
        }
    }
    if ($_POST["password"] != $_POST["confirmpassword"]) {
        $matchError = "Passwords do not match. Please re-enter";
        echo $matchError;
    } else if ($_POST["password"] == $_POST["confirmpassword"]) {
        $password = $_POST["password"];
    }


    //insert data in form fields into database table
    $query = "INSERT INTO User(firstname, lastname, username, position,  password)
            VALUES('$firstname', '$lastname', '$username', '$position', '$password')";
    mysqli_query($connection, $query);
    header("location: Homepage.php");

}
mysqli_close($connection);

?>

   
