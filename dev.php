<?php
    include_once 'php/loginvalidator.php';
    include_once 'php/config.php';
    include_once 'php/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php
        include_once 'php/nav.php';
    ?>
    
    <div class="main-content">
        <h2>Development</h2>
        <hr>
        <table class="general-table">
            <tr>
                <th>Batch ID</th>
                <th>Product ID</th>
                <th>Model</th>
                <th>Color</th>
                <th>Size</th>
                <th>Heel Height</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Current Status</th>
                <th>Last Update</th>
            </tr>
            <?php
                displayDevelopment($con); 
            ?>
        </table>
    </div>
</body>
</html>