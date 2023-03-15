<?php
    $con = mysqli_connect("localhost","root","","bragais");

    //check connection
    if (!$con) {
        die("<script>alert('Connection Failed')</script>");
    }
?>