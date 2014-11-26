<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Admin.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Admin = new Admin($Conn);
    $Admin->UserName = $_POST['UserName'];
    $Admin->IsActive = ($_POST['IsActive'] == 'on') ? 1 : 0;
    $Admin->SetPassword($_POST['Password']);

    $Admin->Save();
    $Conn->Commit();
    header('location:admin.php');
}catch (Exception $e) {
   include('../error_handler.php');
}
?>