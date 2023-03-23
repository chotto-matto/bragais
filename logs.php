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
        <h2>Logs</h2>
        <hr>
        <table class="general-table">
            <tr>
                <th>Log ID</th>
                <th>Log Action</th>
                <th>Date Logged</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Log Action 1</td>
                <td>02/16/2023</td>
            </tr>
        </table>
    </div>
</body>
</html>