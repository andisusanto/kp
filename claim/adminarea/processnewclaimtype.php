<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/ClaimType.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $ClaimType = new ClaimType($Conn);
   $ClaimType->Code = $_POST['Code'];
$ClaimType->IsActive = ($_POST['IsActive'] == 'on') ? 1 : 0;
$ClaimType->Name = $_POST['Name'];

   $ClaimType->Save();
   $Conn->Commit();
    header('location:claimtype.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>