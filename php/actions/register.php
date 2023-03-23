<?php

if (isset($_POST["submit"])) {
    
    echo "It works";

    $EID = $_POST["employee-id"];
    $agentNo = $_POST["agent-no"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $displayname = $_POST["display-name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];
    $accessType = "Pending";

    require_once '../config.php';
    require_once '../functions.php';

    if (emptyInputSignUp($EID, $agentNo, $fname, $lname, $displayname, $email, $password, $confirmPassword) !== false) {
        header("location: ../../sign-up.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../../sign-up.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($password, $confirmPassword) !== false) {
        header("location: ../../sign-up.php?error=passworddontmatch");
        exit();
    }

    if (EIDexists($con, $EID) !== false) {
        header("location: ../../sign-up.php?error=idtaken");
        exit();
    }

    createUser($con, $EID, $agentNo, $fname, $lname, $displayname, $email, $password, $accessType);

}else{
    header("location: ../../sign-in.php");
    exit();
}
?>