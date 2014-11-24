<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/ClaimType.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   ClaimType::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:claimtype.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>