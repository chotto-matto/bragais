<?php
    if (isset($_POST["submit"])) {
        $eid = $_POST["EID"];
        $password = $_POST["password"];

        require_once '../config.php';
        require_once '../functions.php';

        if (emptyInputLogIn($eid, $password) !== false) {
            header("location: ../../sign-in.php?error=emptyinput");
            exit();
        }

        loginUser($con, $eid, $password);
    }
    else{
        echo '<p>shet</p>';
    }
?>