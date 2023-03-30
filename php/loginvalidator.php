<?php
    session_start();
    if (!isset($_SESSION["employee_id"])) {
        header("location: sign-in.php");
    }
?>
