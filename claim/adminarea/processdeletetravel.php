<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Travel.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   Travel::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:travel.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>