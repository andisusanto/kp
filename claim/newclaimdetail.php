<?php $title = 'new claim detail'; ?>
<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
?>
<?php
    include_once('classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
  
    <link rel="stylesheet" type="text/css" href="css/weefer_claim.css">
    <link type="text/css" rel="stylesheet" href="jquery/formValidation/css/validationEngine.jquery.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jquery-ui-1.11.2/jquery-ui.min.css"/>
    <script src="jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="jquery/jquery-ui-1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <script src="jquery/formValidation/js/jquery.validationEngine.js" type="text/javascript"></script>
    <script src="jquery/formValidation/js/languages/jquery.validationEngine-en.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmAddClaimTransactionDetail").validationEngine();
        });
    </script>
  </head>
  <body>
    <div class="navigation">
      <ul>
          <li><a href="login.php">log in</a></li>
          <li><a href="newclaim.php">new claim</a></li>
          <li><a href="myclaimhistory.php">history</a></li> 
      </ul>
    </div>

<div class="form_add">
<form action="processnewclaimdetail.php" method="POST" name="frmAddClaimTransactionDetail" id="frmAddClaimTransactionDetail" enctype="multipart/form-data">
    <input type="hidden" name="ClaimTransaction" value="<?php echo $_GET['Claim'];?>"/>
    <div>TransDate : <br><input type="text" class="validate[required] date" name="TransDate">    </div>
    <div>ClaimType : <br>
        <select name="ClaimType" class="validate[required]" >
           <?php
               include_once('classes/ClaimType.php');
               $ClaimTypes = ClaimType::LoadCollection($Conn);
               foreach ($ClaimTypes as $ClaimType) { ?>
                   <option value="<?php echo $ClaimType->get_Id();?>"> <?php echo $ClaimType->Name;?></option>
           <?php }?>
       </select>
    </div>
    <div>Amount : <br><input type="text" name="Amount" class="validate[required,custom[integer,min[1]]]" >    </div>
    <div>Note : <br><textarea name="Note" class="validate[required]" ></textarea></div>
    <div>Attachment : <br><input type="file" name="Attachment">    </div>

   <input type="submit" value="save">
</form>
</div>
<script type="text/javascript">
$(".date").datepicker();
</script>
<script type="text/javascript">
$(".date").datepicker("option","dateFormat","yy-mm-dd");
</script>
  </body>
</html>