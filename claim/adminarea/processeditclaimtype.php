<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/ClaimType.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $ClaimType = ClaimType::GetObjectByKey($Conn, $_POST['Id']);
   $ClaimType->Code = $_POST['Code'];
$ClaimType->IsActive = ($_POST['IsActive'] == 'on') ? 1 : 0;
$ClaimType->Name = $_POST['Name'];

   $ClaimType->Update();
   $Conn->Commit();
   header('location:viewclaimtype.php?Id='.$ClaimType->get_Id());
} catch (Exception $e) {
   include('../error_handler.php');
}
?>