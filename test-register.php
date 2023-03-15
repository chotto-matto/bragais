<!--INDEX -->
<?php
    include 'php/config.php';
    include 'php/functions.php';
    session_start();
?>


<!DOCTYPE html>
<!-- Log In Page -->
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Bragais Office - Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="Assets\Logos\logoico.ico" />
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
    <script src="https://kit.fontawesome.com/e1f1d37ac4.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="icons.css" />
  <style>
    .body {
      background-color: #a131b8;
      font-family: "Roboto", sans-serif;
    }

    .logo {
      margin-left: auto;
      margin-right: auto;
      margin-top: 5%;
      margin-bottom: 50px;
      width: 25%;
      display: block;
    }

    .formborder {
      border-radius: 25px;
      background-color: white;
      border: 3px solid rgba(255, 255, 255, 0.547);
      box-shadow: 0px 10px 30px dimgray;
      padding: 40px;
      padding-top: 60pz;
      width: 25%;
      font-family: "Roboto", sans-serif;
      text-align: center;
      display: block;
      margin-left: auto;
      margin-right: auto;
      transition: all 0.5s ease-in;
    }

    .formborder:hover {
      transition: 0.5s;
      box-shadow: 0px 10px 60px dimgray;
    }

    input[type="text"],
    input[type="password"],
    select {
      width: 70%;
      padding: 12px 20px;
      margin: 10px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-sizing: border-box;
      font-family: "Roboto", sans-serif;
      font-size: 20px;
    }

    button{
        border-radius: 10px;
        border: 1px solid #a131b8;
        background-color: #b766c7;
        width: 100px;
        height: 50px;
        padding: 10px 16px;
        margin-top: 30px;
        cursor: pointer;
        font-family: "Roboto", sans-serif;
        font-size: 18px;
        color: white;
    }

    input[type="submit"]:hover,
    input[type="text"]:hover,
    input[type="password"]:hover {
      transition: 0.5s;
      box-shadow: 1px 5px 5px 0.5px rgba(53, 52, 52, 0.151);
      border-color: transparent;
    }

    #empID {
      margin-left: -5px;
    }

    i {
      color: #a131b8;
      vertical-align: middle;
    }
  </style>
</head>

<body class="body">
  <img class="logo" src="Assets/Logos/logowhite.png" />
  <div class="formborder">
    <div>
      <form action="php/actions/register.php" method="post">
        <div class="form-group">
            <div style="color:white; background-color:#a85db8; font-size:40px; border-radius:15px; height:60px; margin-top:-70px; padding-top:10px;">Register</div><br><br>
          <input type="text" name="employee-id" id="employee-id" class="form-control" placeholder="Employee ID">
          <input type="text" name="agent-no" id="agent-no" class="form-control" placeholder="Agent No.">
          <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
          <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name">
          <input type="text" name="display-name" id="display-name" class="form-control" placeholder="Display Name">
          <input type="text" name="email" id="email" class="form-control" placeholder="Email">
          

        </div>
        <input type="password" name="password" id="password" placeholder="Password">
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
        
        <div class="form-group">
            <button type="submit" name="submit" id="submit">Register</button> <br> <br>
            <a href="">Log In</a>
        </div>
      </form>

    </div>
  </div>
</body>

</html>