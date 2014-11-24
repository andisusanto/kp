<?php
    include_once('classes/Employee.php');
    include_once('classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $userName = $_POST['txtUserName'];
    $password = $_POST['txtPassword'];
    try{
        $employee = Employee::GetObjectByUserName($Conn,$userName);
        if($employee != NULL && $employee->ComparePassword($password)){
            session_start();
            $_SESSION['CurrentEmployeeId'] = $employee->get_Id();
            if($employee->ChangePasswordOnLogIn==TRUE){
                $_SESSION['changepassword'] = TRUE;
            }
            header('location:index.php');
        }else{
            throw new Exception("Username or password does not match!");
        }
    } catch (Exception $e) {
        include('error_handler.php');
    }
?>