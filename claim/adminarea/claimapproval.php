<?php
    include('header.php');
?>
<?php
    include_once('../classes/ClaimTransaction.php');
    include_once('../classes/Employee.php');
    include_once('../classes/Travel.php');
    include_once('../classes/ClaimType.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $claimTransactions = ClaimTransaction::LoadCollection($Conn,'Status <> 0','ClaimDate DESC');
?><div class="view_data">
<h3>Approval list</h3>
<table id="datatable" class="display">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Travel</th>
            <th>Claim Date</th>
            <th>Status</th>
            <th>Submission Note</th>
            <th>Approval Note</th>
            <th>Rejection Note</th>
            <th>Action</th>
        </tr>    
    </thead>
    <tbody>
        <?php
            foreach($claimTransactions as $claimTransaction){
                ?>
                    <tr>
                        <td><?php $employee = Employee::GetObjectByKey($Conn, $claimTransaction->Employee); echo $employee->Name; ?></td>
                        <td><?php $Travel = Travel::GetObjectByKey($Conn, $claimTransaction->Travel); echo $Travel->Name; ?></td>
                        <td><?php echo date('Y-M-d',$claimTransaction->ClaimDate); ?></td>
                        <td><?php echo $claimTransaction->getStatusText(); ?></td>
                        <td><?php echo $claimTransaction->SubmissionNote; ?></td>
                        <td><?php echo $claimTransaction->ApprovalNote; ?></td>
                        <td><?php echo $claimTransaction->RejectionNote; ?></td>
                        <td> 
                            <a href="viewclaim.php?Id=<?php echo $claimTransaction->get_Id(); ?>">View</a>
                            <a href="cancelclaimapproval.php?Id=<?php echo $claimTransaction->get_Id(); ?>">Cancel</a>
                        </td>
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