<?php

    require_once '../config.php';
    require_once '../functions.php';

    function processDrpdown($selectedVal) {
        echo json_encode($selectedVal);
    }        

    if ($_POST['dropdownValue']){
        //call the function or execute the code
        processDrpdown(developDisplayFromDropdown($con, $_POST['dropdownValue']));
    }
?>