<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/ClaimRule.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   ClaimRule::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:claimrule.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>