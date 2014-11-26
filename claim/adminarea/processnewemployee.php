<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Employee.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Employee = new Employee($Conn);
   $Employee->SetPassword($_POST['Password']);
$Employee->IsActive = ($_POST['IsActive'] == 'on') ? 1 : 0;
$Employee->Code = $_POST['Code'];
$Employee->UserName = $_POST['UserName'];
$Employee->Name = $_POST['Name'];
$Employee->ChangePasswordOnLogIn = ($_POST['ChangePasswordOnLogIn'] == 'on') ? 1 : 0;

   $Employee->Save();
   $Conn->Commit();
    header('location:employee.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>