<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Admin.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Admin = Admin::GetObjectByKey($Conn, $_POST['Id']);
   $Admin->UserName = $_POST['UserName'];
$Admin->IsActive = ($_POST['IsActive'] == 'on') ? 1 : 0;

   $Admin->Update();
   $Conn->Commit();
   header('location:viewadmin.php?Id='.$Admin->get_Id());
} catch (Exception $e) {
   include('../error_handler.php');
}
?>