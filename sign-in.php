<?php
    session_start();
    if (isset($_SESSION["employee_id"])) {
        header("location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="sign-in-container">
        <h1>Log In</h1>
        <form action="php/actions/login.php" method="post">
            <input type="text" name="EID" id="EID" placeholder="Employee ID"> <br>
            <input type="password" name="password" id="password" placeholder="Password"> <br>
            <button type="submit" name="submit" id="submit">Log In</button>
        </form>
        <a href="sign-up.php">Create Account</a>
    </div>
</body>
</html>