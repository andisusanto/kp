<?php
    include_once('checklogin.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="css/weefer_claim.css">
    <title>Home</title>
  </head>
  <body><div class="form_login">
    <div class="title"><img alt="logo" src="asset/images/logo.png"> Employee Claim Portal</div>
      <form method="post" action="processchangepasswordonlogin.php">
          <p>Password :<br>
          <input type="password" name="txtPassword" placeholder="Password"/></p>
          <p>Confirm Password :<br>
          <input type="password" name="txtConfirmPassword" placeholder="Password"/></p>
          <input type="submit"/>
      </form></div>
  </body>
</html>