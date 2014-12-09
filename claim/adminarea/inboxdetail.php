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
   <a class="backlink" href="inbox.php">back</a><br/><br/>
<h3><?php echo $adminInbox->Subject; ?></h3>
    <p><div><b>Received Date : </b><?php echo date('Y-M-d',$adminInbox->ReceivedDate); ?></div></p>
    <p><div><b>Message : </b><?php echo $adminInbox->Message; ?></div></p>
    <div><a href="<?php echo $adminInbox->ViewDetailLink; ?>">Open</a></div>
</div>
<?php
    include('footer.php');
?>