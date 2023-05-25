<?php

    if (isset($_POST["submit"])) {

        require_once '../config.php';
        require_once '../functions.php';

        $prodID = $_POST["prodID"];
        $model = $_POST["model-name"];
        $color = $_POST["color"];
        $size = $_POST["size"];
        $heelHeight = $_POST["heel-height"];
        $categ = $_POST["categ"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $status = "Pending";
        $dateTransferred = date('m/d/Y');

        insertToDevelopPending($con, $prodID, $model, $size, $color, $heelHeight, $quantity, $categ, $price, $status, $dateTransferred);
    }

?>