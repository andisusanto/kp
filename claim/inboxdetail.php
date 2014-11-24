<?php $title = 'inbox detail'; ?>
<?php
    include('header.php');
?>
<?php
include_once('classes/Connection.php');
include_once('classes/EmployeeInbox.php');
$Conn = Connection::get_DefaultConnection();
$employeeInbox = EmployeeInbox::GetObjectByKey($Conn,$_GET['Id']);
?>
<div class="view_data">
    <div>Subject : <?php echo $employeeInbox->Subject; ?></div>
    <div>Message : <?php echo $employeeInbox->Message; ?></div>
    <div><a href="<?php echo $employeeInbox->ViewDetailLink; ?>">View</a></div>
</div>
<?php 
    $employeeInbox->IsRead = 1;
    $employeeInbox->Update();
    $Conn->Commit();
?>
<?php
    include('footer.php');
?>