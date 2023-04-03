<?php

    if (isset($_POST["submit"])) {

        require_once '../config.php';
        require_once '../functions.php';

        $prodID = $_POST["item-id"];
        $status = $_POST["status"];

        updateItemListing($con, $status, $prodID);
    }else
    {
        echo "test";
    }

?>