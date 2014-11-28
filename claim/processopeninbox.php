<?php
    
    include_once('classes/Connection.php');
    include_once('classes/EmployeeInbox.php');
    $Conn = Connection::get_DefaultConnection();
    $employeeInbox = EmployeeInbox::GetObjectByKey($Conn,$_GET['Id']);
    $employeeInbox->IsRead = 1;
    $employeeInbox->Update();
    $Conn->Commit();
    header('location:inboxdetail.php?Id='.$_GET['Id']);
?>