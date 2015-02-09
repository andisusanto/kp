<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Grade.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Grade = Grade::GetObjectByKey($Conn, $_POST['Id']);
    $Grade->Name = $_POST['Name'];

    $Grade->Update();
    $Conn->Commit();
    header('location:viewgrade.php?Id='.$Grade->get_Id());
} catch (Exception $e) {
    include('../error_handler.php');
}
?>