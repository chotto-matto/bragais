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
    <title>Document</title>
    <link rel="stylesheet" href="css/account-management.css">
</head>
<body>
    <section class="wrapper title">
        <h1>Account Management</h1>
        <hr>
    </section>
    <section class="wrapper content">
        <div class="table-wrapper">
            <table>
                <tr>
                    <th>Employee ID</th>
                    <th>Agent No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Display Name</th>
                    <th>Email</th>
                    <th>Employee Access</th>
                    <th>Action</th>
                </tr>
                <?php
                    displayEmployees($con);
                ?>
            </table>
        </div>
    </section>
</body>
</html>