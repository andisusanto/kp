<?php
include_once('../classes/ClaimTransaction.php');
include_once('../classes/Employee.php');
include_once('../classes/Travel.php');
include_once('../classes/ClaimType.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ClaimTransaction = ClaimTransaction::GetObjectByKey($Conn, $_GET['Id']);
?>
<?php include('header.php');?>
<div class="view_data">
<table>
<tr>
<td>
    <p><b>Employee : </b><?php $employee = Employee::GetObjectByKey($Conn,$ClaimTransaction->Employee); echo $employee->Name;?></p>
    <p><b>Travel : </b><?php $travel = Travel::GetObjectByKey($Conn,$ClaimTransaction->Travel); echo $travel->Name;?></p>
    <p><b>Claim Date : </b><?php echo date('Y-M-d',$ClaimTransaction->ClaimDate); ?></p>
    <p><b>Status : </b><?php echo $ClaimTransaction->getStatusText(); ?></p>
    <p><b>Submission Note : </b><?php echo $ClaimTransaction->SubmissionNote; ?></p>
    <p><b>Approval Note : </b><?php echo $ClaimTransaction->ApprovalNote; ?></p>
    <p><b>Rejection Note : </b><?php echo $ClaimTransaction->RejectionNote; ?></p><br>
</td>
<td>
<?php if($ClaimTransaction->Status == 0) { ?>
    <h3>Approval</h3>
    <form method="post" action="processclaimapproval.php" name="frmClaimApproval" id="frmClaimApproval">
        <input type="hidden" name="Id" value="<?php echo $_GET['Id'];?>"/>
        <input type="radio" name="action" value="2" checked>Approve
        <input type="radio" name="action" value="3">Reject<br>
        Note : <br>
        <textarea name="txtNote"></textarea><br>
        <input type="submit" />
    </form>
<?php }?>
</td>
</tr>
</table>
   
    
    
<table>
        <thead>
            <tr>
                <th>ClaimType</th>
                <th>Note</th>
                <th>TransDate</th>
                <th>Amount</th>
                <th>Action</th>
                <?php if($ClaimTransaction->Status == 0){?><th>Action</th><?php } ?>
            </tr>
        </thead> 
    <tbody>
    <?php
        $Details = $ClaimTransaction->get_ClaimTransactionDetail();
        foreach($Details as $detail){
            ?>
            <tr>
                <td><?php $ClaimType = ClaimType::GetObjectByKey($Conn,$detail->ClaimType);echo $ClaimType->Name; ?></td>
                <td><?php echo $detail->Note; ?></td>
                <td><?php echo date('Y-M-d',$detail->TransDate); ?></td>
                <td><?php echo $detail->Amount; ?></td>
                <td>
                    <?php if($ClaimTransaction->Status == 0){?><a href="processdeleteclaimtransactiondetail.php?Id=<?php echo $detail->get_Id(); ?>">Delete</a><?php }?>
                    <a href="viewclaimdetail.php?Id=<?php echo $detail->get_Id();?>">view</a>
                </td>
            </tr>
            <?php
        }
    ?>  
    </tbody>
</table>
</div>
<?php include('footer.php');?>