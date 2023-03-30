<?php

    include_once 'config.php';
    include_once 'functions.php';

    session_start();
    session_destroy();

    header("location: ../sign-in.php");
?>