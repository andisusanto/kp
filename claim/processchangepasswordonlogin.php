<?php
    include_once('checklogin.php');
?>
<?php
    try{
        $password = $_POST['txtPassword'];
        $confirmpassword = $_POST['txtConfirmPassword'];
        if ($password == $confirmpassword){
            include_once('classes/Employee.php');
            include_once('classes/Connection.php');
            $Conn = Connection::get_DefaultConnection();
            $tmpEmployee = Employee::GetObjectByKey($Conn,$_SESSION['CurrentEmployeeId']);
            $tmpEmployee->SetPassword($password);
            $tmpEmployee->ChangePasswordOnLogIn = FALSE;
            $tmpEmployee->Update();
            $Conn->Commit();
            unset($_SESSION['changepassword']);
            header('location:index.php');
        }else{
            throw new Exception();
        }
    } catch (Exception $e) {
        include('error_handler.php');
    }

?>