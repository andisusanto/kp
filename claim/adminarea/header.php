<?php
    include('checklogin.php');
?>
<?php
    include_once('../classes/AdminInbox.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Area</title>
    <link rel="stylesheet" type="text/css" href="css/weefer_claim.css">
    <link rel="stylesheet" type="text/css" href="../jquery/datatable/css/jquery.dataTables.min.css">
    <link type="text/css" rel="stylesheet" href="../jquery/formValidation/css/validationEngine.jquery.css"/>
    <link type="text/css" rel="stylesheet" href="../jquery/jquery-ui-1.11.2/jquery-ui.min.css"/>
    <script src="../jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="../jquery/jquery-ui-1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../jquery/formValidation/js/jquery.validationEngine.js" type="text/javascript"></script>
    <script src="../jquery/formValidation/js/languages/jquery.validationEngine-en.js" type="text/javascript"></script>
  </head>
  <body>
    <div class="navigation">
      
      <ul>
        <li><a href="index.php"><img src="../asset/images/logo.png"></a></li>
     
          <li><a href="admin.php">Admin</a></li>
          <li><a href="travel.php">Travel</a></li>
          <li><a href="grade.php">Grade</a></li>
          <li><a href="employee.php">Employee</a></li>
          <li><a href="claimtype.php">Claim Type</a></li>
          <li><a href="claimrule.php">Claim Rule</a></li>
          <li><a href="claimapproval.php">Claim Approval</a></li>
          <?php $count = count(AdminInbox::LoadCollection($Conn,"IsRead = 0"));?>
          <li><a href="inbox.php"><?php echo ($count > 0) ? "<b>Inbox(".$count.")</b>" : "Inbox" ; ?></a></li>
          <li><a href="report.php">Report</a></li>
          <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>