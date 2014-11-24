<?php
    session_start();
    if(!isset($_SESSION['CurrentEmployeeId'])){
        header('location:login.php');
    }
?>