<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Grade.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Grade = new Grade($Conn);
$Grade->Name = $_POST['Name'];

   $Grade->Save();
   $Conn->Commit();
    header('location:grade.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>