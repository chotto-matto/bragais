<?php

if (isset($_POST["submit"])) {

    $EID = $_POST["employee_id"];
    $accessType = $_POST["emp-access"];

    require_once '../config.php';
    require_once '../functions.php';

    if ($accessType == "" || $accessType == "Pending" || $accessType == "Select Access Type") {
        header("location: ../../account-management.php?error=invalidselectedvalue");
        exit();
    }

    updateAccess($con, $accessType, $EID);

}else{
    header("location: ../../account-management.php?error=unknownerror");
    exit();
}
?>