<?php
    include('header.php');
?>
<?php
include_once('../classes/ClaimType.php');
include_once('../classes/Helper.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ClaimType = ClaimType::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="view_data">
<p><b>Code : </b><?php echo $ClaimType->Code; ?></p>
<p><b>Name : </b><?php echo $ClaimType->Name; ?></p>
<p><b>Is Active : </b><?php echo Helper::getBooleanTextValue($ClaimType->IsActive); ?></p>
<a href="claimtype.php">Back</a>
<a href="editclaimtype.php?Id=<?php echo $ClaimType->get_Id(); ?>">Edit</a></div>
<?php
    include('footer.php');
?>