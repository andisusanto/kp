<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Employee.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   Employee::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:employee.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>