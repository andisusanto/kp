<?php
    include('checklogin.php');
?>
<?php
    include_once('../classes/Employee.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
try {
   $Employee = Employee::GetObjectByKey($Conn, $_POST['Id']);
    $Employee->IsActive = ($_POST['IsActive'] == 'on') ? 1 : 0;
    $Employee->Code = $_POST['Code'];
    $Employee->UserName = $_POST['UserName'];
    $Employee->Name = $_POST['Name'];
    $Employee->Grade = $_POST['Grade'];
    $Employee->ChangePasswordOnLogIn = ($_POST['ChangePasswordOnLogIn'] == 'on') ? 1 : 0;
    if(isset($_POST['Password'])){$Employee->SetPassword($_POST['Password']);}
   $Employee->Update();
   $Conn->Commit();
   header('location:viewemployee.php?Id='.$Employee->get_Id());
} catch (Exception $e) {
   include('../error_handler.php');
}
?>