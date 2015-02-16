<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
?>
<?php
    include_once('classes/EmployeeInbox.php');
    include_once('classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    
    <link rel="stylesheet" type="text/css" href="css/weefer_claim.css">
    <link rel="stylesheet" type="text/css" href="jquery/datatable/css/jquery.dataTables.min.css">
    <link type="text/css" rel="stylesheet" href="jquery/formValidation/css/validationEngine.jquery.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jquery-ui-1.11.2/jquery-ui.min.css"/>
    <script src="jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="jquery/jquery-ui-1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <script src="jquery/formValidation/js/jquery.validationEngine.js" type="text/javascript"></script>
    <script src="jquery/formValidation/js/languages/jquery.validationEngine-en.js" type="text/javascript"></script>

  </head>
  <body>
    <div class="navigation">
      
      <ul>
        <li><a href="index.php"><img src="asset/images/logo.png"></a></li>
          <li><a href="newclaim.php">New Claim</a></li>
          <li><a href="myclaimhistory.php">History</a></li>
            <?php $count = count(EmployeeInbox::LoadCollection($Conn,"Employee = ".$_SESSION['CurrentEmployeeId']." AND IsRead = 0"));?>
          <li><a href="inbox.php"><?php echo ($count > 0) ? "<b>Notification(".$count.")</b>" : "Notification" ; ?></a></li>
          <li><a href="logout.php">Log Out</a></li>
      </ul>

    </div>