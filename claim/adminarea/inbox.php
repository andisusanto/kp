<?php
    include('header.php');
?>
<?php
include_once('../classes/Connection.php');
include_once('../classes/AdminInbox.php');
$Conn = Connection::get_DefaultConnection();
$adminInboxs = AdminInbox::LoadCollection($Conn,'1=1','ReceivedDate DESC');
?>
<div class="view_data">
<h3>Notifications</h3>
<table id="datatable" class="display">
    <thead>
        <tr>
            <th>Subject</th>
            <th>Message</th>
            <th>Received Date</th>
            <th>Action</th>
        </tr>    
    </thead>
    <tbody>
        <?php
            foreach($adminInboxs as $adminInbox){
                ?>
                    <tr>
                        <td><?php if($adminInbox->IsRead) { echo $adminInbox->Subject;} else {?> <b> <?php echo $adminInbox->Subject;?></b> <?php } ?></td>
                        <td><?php echo $adminInbox->Message; ?></td>
                        <td><?php echo date('Y-M-d',$adminInbox->ReceivedDate); ?></td>
                        <td><a href="inboxdetail.php?Id=<?php echo $adminInbox->get_Id(); ?>">View</a></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>
</div>
<?php
    include('footer.php');
?>