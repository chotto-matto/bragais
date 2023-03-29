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
</head>
<body>
    <h1>Sign Up</h1>
    <?php
        
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all of the fields</p>";
            }else if ($_GET["error"] == "invaliduid") {
                echo "<p>Choose a valid username</p>";
            }else if ($_GET["error"] == "passworddontmatch") {
                echo "<p>Passwords do not match</p>";
            }else if ($_GET["error"] == "usernametaken") {
                echo "<p>Email Exists</p>";
            }else if ($_GET["error"] == "stmtfailed") {
                echo "<p>Something went wrong, please try again.</p>";
            }else if ($_GET["error"] == "none") {
                echo "<p>You have signed up</p>";
            }
        }
    ?>
    <form action="php/actions/register.php" method="post">
        <label for="employee-id">Employee ID</label>
        <input type="text" id="employee-id" name="employee-id">
        <label for="agent-no">Agent Number</label>
        <input type="text" id="agent-no" name="agent-no">
        <label for="first-name">First Name</label>
        <input type="text" id="fname" name="fname">
        <label for="last-name">Last Name</label>
        <input type="text" id="lname" name="lname">
        <label for="display-name">Display Name</label>
        <input type="text" id="display-name" name="display-name">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password">
        <button type="submit" name="submit" id="submit">Sign Up</button>
    </form>
    <a href="sign-in.php">Already signed up?</a>
</body>
</html>