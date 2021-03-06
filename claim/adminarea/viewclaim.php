<?php
include_once('../classes/ClaimTransaction.php');
include_once('../classes/GlobalFunction.php');
include_once('../classes/Employee.php');
include_once('../classes/Travel.php');
include_once('../classes/ClaimType.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ClaimTransaction = ClaimTransaction::GetObjectByKey($Conn, $_GET['Id']);
?>
<?php include('header.php');?>
<div class="view_data">
   <a class="backlink" href="claimapproval.php">Back</a><br/><br/>
<table>
<tr>
<td>
    <p><b>Employee : </b><?php $employee = Employee::GetObjectByKey($Conn,$ClaimTransaction->Employee); echo $employee->Name;?></p>
    <p><b>Travel : </b><?php $travel = Travel::GetObjectByKey($Conn,$ClaimTransaction->Travel); echo $travel->Name;?></p>
    <p><b>Claim Date : </b><?php echo date('Y-M-d',$ClaimTransaction->ClaimDate); ?></p>
    <p><b>Status : </b><?php echo $ClaimTransaction->getStatusText(); ?></p>
    <p><div><b>Processed Date : </b><?php if($ClaimTransaction->ProcessedDate != strtotime('0000-00-00 00:00:00')) echo date('Y-M-d',$ClaimTransaction->ProcessedDate); ?></div></p>
    <p><b>Submission Note : </b><?php echo $ClaimTransaction->SubmissionNote; ?></p>
    <p><b>Approval Note : </b><?php echo $ClaimTransaction->ApprovalNote; ?></p>
    <p><b>Rejection Note : </b><?php echo $ClaimTransaction->RejectionNote; ?></p><br>
</td>
<td>
<?php if($ClaimTransaction->Status == 1) { ?>
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
   
    
    
<table id="datatable">
        <thead>
            <tr>
                <th>Claim Type</th>
                <th>Note</th>
                <th>TransDate</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>ProcessedAmount</th>
                <th>Action</th>
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
                <td><?php echo $detail->Quantity; ?></td>
                <td><?php echo GlobalFunction::getIndonesianMoneyString($detail->Amount); ?></td>
                <td><?php echo GlobalFunction::getIndonesianMoneyString($detail->ProcessedAmount); ?></td>
                <td>
                    <a href="viewclaimdetail.php?Id=<?php echo $detail->get_Id();?>">View</a>
                </td>
            </tr>
            <?php
        }
    ?>  
    </tbody>
</table>
</div>
<?php include('footer.php');?>