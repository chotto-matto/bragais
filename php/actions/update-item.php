<?php

    if (isset($_POST["submit"])) {

        require_once '../config.php';
        require_once '../functions.php';

        $prodID = $_POST["item-id"];
        $model = $_POST["model"];
        $color = $_POST["color"];
        $size = $_POST["size"];
        $heelHeight = $_POST["heel-height"];
        $categ = $_POST["category"];
        $price = $_POST["price"];

        updateProducts($con, $prodID, $model, $size, $color, $heelHeight, $categ, $price);
    }

?>