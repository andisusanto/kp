<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Grade.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   Grade::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:grade.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>