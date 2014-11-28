<?php
    
    include_once('../classes/Connection.php');
    include_once('../classes/AdminInbox.php');
    $Conn = Connection::get_DefaultConnection();
    $adminInbox = AdminInbox::GetObjectByKey($Conn,$_GET['Id']);
    $adminInbox->IsRead = 1;
    $adminInbox->Update();
    $Conn->Commit();
    header('location:inboxdetail.php?Id='.$_GET['Id']);
?>