<?php
    include('header.php');
?>
<?php
           include_once('../classes/Helper.php');
           include_once('../classes/ClaimRule.php');
           include_once('../classes/ClaimType.php');
           include_once('../classes/Grade.php');
           include_once('../classes/GlobalFunction.php');
           include_once('../classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
$ClaimRule = ClaimRule::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="view_data">
<p><b>Claim Type : </b><?php $ClaimType = ClaimType::GetObjectByKey($Conn,$ClaimRule->ClaimType);  echo $ClaimType->Name; ?></p>
<p><b>Grade : </b><?php $Grade = Grade::GetObjectByKey($Conn,$ClaimRule->Grade);  echo $Grade->Name; ?></p>
<p><b>Max Amount : </b><?php echo GlobalFunction::getIndonesianMoneyString($ClaimRule->MaxAmount); ?></p>
<a href="claimrule.php">Back</a>
<a href="editclaimrule.php?Id=<?php echo $ClaimRule->get_Id(); ?>">Edit</a></div>
<?php
    include('footer.php');
?>