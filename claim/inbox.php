<?php $title = 'inbox'; ?>
<?php
    include('header.php');
?>
<?php
include_once('classes/Connection.php');
include_once('classes/EmployeeInbox.php');
$Conn = Connection::get_DefaultConnection();
$employeeInboxs = EmployeeInbox::LoadCollection($Conn,'Employee = '.$_SESSION['CurrentEmployeeId'],'ReceivedDate DESC');
?>
<div class="view_data">
<h3>Inbox</h3>
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
            foreach($employeeInboxs as $employeeInbox){
                ?>
                    <tr>
                        <td><?php if($employeeInbox->IsRead) { echo $employeeInbox->Subject;} else {?> <b> <?php echo $employeeInbox->Subject;?></b> <?php } ?></td>
                        <td><?php echo $employeeInbox->Message; ?></td>
                        <td><?php echo date('Y-M-d',$employeeInbox->ReceivedDate); ?></td>
                        <td><a href="processopeninbox.php?Id=<?php echo $employeeInbox->get_Id(); ?>">View</a></td>
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