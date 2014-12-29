<!--<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
  </head>
  <body>
      <form method="post" action="processlogin.php">
          <p>User Name :<br>
          <input type="text" name="txtUserName" placeholder="UserName"/></p>
          <p>Password :<br>
          <input type="password" name="txtPassword" placeholder="Password"/></p>
          <input type="submit" value="Log In"/>
      </form>
  </body>
</html>-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>

    <link rel="stylesheet" type="text/css" href="../css/weefer_claim.css">
    <link type="text/css" rel="stylesheet" href="../jquery/formValidation/css/validationEngine.jquery.css"/>
    <script src="../jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="../jquery/formValidation/js/jquery.validationEngine.js" type="text/javascript"></script>
    <script src="../jquery/formValidation/js/languages/jquery.validationEngine-en.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmLogIn").validationEngine();
        });
    </script>
  </head>
  <body>
    <div class="form_login">
      <div class="title"><img alt="logo" src="../asset/images/logo.png"> Admin Area</div>
      <form method="post" action="processlogin.php" id="frmLogIn">
          <p>User Name :<br>
          <input type="text" name="txtUserName" class="validate[required]" placeholder="UserName"/></p>
          <p>Password :<br>
          <input type="password" name="txtPassword" class="validate[required]" placeholder="Password"/></p>
          <input type="submit" value="Log In"/>
      </form>
    </div>
  </body>
</html>