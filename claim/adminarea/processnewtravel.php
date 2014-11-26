<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Travel.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Travel = new Travel($Conn);
   $Travel->StartDate = strtotime($_POST['StartDate']);
$Travel->UntilDate = strtotime($_POST['UntilDate']);
$Travel->Closed = ($_POST['Closed'] == 'on') ? 1 : 0;
$Travel->Name = $_POST['Name'];

   $Travel->Save();
   $Conn->Commit();
    header('location:travel.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>