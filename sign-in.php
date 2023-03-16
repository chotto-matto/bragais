<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Log In</h1>
    <form action="php/actions/login.php" method="post">
        <label for="EID">Employee ID</label>
        <input type="text" name="EID" id="EID">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button type="submit" name="submit" id="submit">Log In</button>
    </form>
    <a href="sign-up.php">Create Account</a>
</body>
</html>