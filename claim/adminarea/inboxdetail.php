<?php
    include('header.php');
?>
<?php
include_once('../classes/Connection.php');
include_once('../classes/AdminInbox.php');
$Conn = Connection::get_DefaultConnection();
$adminInbox = AdminInbox::GetObjectByKey($Conn,$_GET['Id']);
?>
<div class="view_data">
    <div>Subject : <?php echo $adminInbox->Subject; ?></div>
    <div>Message : <?php echo $adminInbox->Message; ?></div>
    <div><a href="<?php echo $adminInbox->ViewDetailLink; ?>">View</a></div>
</div>
<?php
    include('footer.php');
?>