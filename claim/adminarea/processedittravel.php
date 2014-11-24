<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Travel.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Travel = Travel::GetObjectByKey($Conn, $_POST['Id']);
    $Travel->StartDate = strtotime($_POST['StartDate']);
    $Travel->UntilDate = strtotime($_POST['UntilDate']);
    $Travel->Closed = ($_POST['Closed'] == 'on') ? 1 : 0;
    $Travel->Name = $_POST['Name'];

    $Travel->Update();
    $Conn->Commit();
    header('location:viewtravel.php?Id='.$Travel->get_Id());
} catch (Exception $e) {
    include('../error_handler.php');
}
?>