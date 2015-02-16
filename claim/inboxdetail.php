<?php $title = 'Notification Detail'; ?>
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
<h3>Notification Detail</h3>
<h3><?php echo $employeeInbox->Subject; ?></h3>
    <p><div><b>Received Date : </b><?php echo date('Y-M-d',$employeeInbox->ReceivedDate); ?></div></p>
    <p><div><b>Message : </b><?php echo $employeeInbox->Message; ?></div></p>
    <div><a href="<?php echo $employeeInbox->ViewDetailLink; ?>">Open</a></div>
</div>
<?php
    include('footer.php');
?>