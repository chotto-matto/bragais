<?php
    if (isset($_POST["submit"])) {
        
        $prodID = $_POST["prodID"];
        $quantity = $_POST["restock-quantity"];

        require_once '../config.php';
        require_once '../functions.php';

        addStocks($con, $quantity, $prodID);
    }
    else{
        echo '<p>error</p>';
    }
?>