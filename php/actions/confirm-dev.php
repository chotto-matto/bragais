<?php

    if (isset($_POST["submit"])) {

        require_once '../config.php';
        require_once '../functions.php';

        cartToDevelop($con);
    }

?>