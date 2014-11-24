<?php
    session_start();
    unset($_SESSION['CurrentEmployeeId']);
    unset($_SESSION['changepassword']);
    header('location:login.php');
?>