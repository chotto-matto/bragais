<?php
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
        <h2>Stock List</h2>
        <hr>
        <table class="general-table">
            <tr>
                <th>Item ID</th>
                <th>Model</th>
                <th>Size</th>
                <th>Color</th>
                <th>Heel Height</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Current Status</th>
                <th>Date Transferred</th>
            </tr>
            <?php
                displayStocks($con); 
            ?>
        </table>
    </div>
</body>
</html>