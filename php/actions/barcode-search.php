<?php
    if (isset($_POST["submit"])) {
        
        $prodID = $_POST["id-scan"];

        require_once '../config.php';
        require_once '../functions.php';

        barcodeSearchItem($con, $prodID);
    }
    else{
        echo '<p>error</p>';
    }
?>