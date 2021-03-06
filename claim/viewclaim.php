<?php
include_once('classes/ClaimTransaction.php');
include_once('classes/GlobalFunction.php');
include_once('classes/Employee.php');
include_once('classes/Travel.php');
include_once('classes/ClaimType.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ClaimTransaction = ClaimTransaction::GetObjectByKey($Conn, $_GET['Id']);
?>
<?php $title = 'View Claim'; ?>
<?php include('header.php');?>
<div class="view_data">
    <p><div><b>Travel : </b><?php $travel = Travel::GetObjectByKey($Conn,$ClaimTransaction->Travel); echo $travel->Name;?></div></p>
    <p><div><b>Status : </b><?php echo $ClaimTransaction->getStatusText(); ?></div></p>
    <p><div><b>Submission Note : </b><?php echo $ClaimTransaction->SubmissionNote; ?></div></p>
    <p><div><b>Approval Note : </b><?php echo $ClaimTransaction->ApprovalNote; ?></div></p>
    <p><div><b>Rejection Note : </b><?php echo $ClaimTransaction->RejectionNote; ?></div></p>
    <p><div><b>Claim Date : </b><?php if($ClaimTransaction->ClaimDate != strtotime('0000-00-00 00:00:00')) echo date('Y-M-d',$ClaimTransaction->ClaimDate); ?></div></p>
    <p><div><b>Processed Date : </b><?php if($ClaimTransaction->ProcessedDate != strtotime('0000-00-00 00:00:00')) echo date('Y-M-d',$ClaimTransaction->ProcessedDate); ?></div></p>
    <?php if($ClaimTransaction->Status == 0){?><a href="newclaimdetail.php?Claim=<?php echo  $ClaimTransaction->get_Id();?>">New Detail</a><a href="submitclaimtransaction.php?Id=<?php echo $ClaimTransaction->get_Id();?>">Submit</a><?php } ?>
<table id="datatable" class="display">
        <thead>
            <tr>
                <th>Claim Type</th>
                <th>Note</th>
                <th>TransDate</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Processed Amount</th>
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
                    <?php if($ClaimTransaction->Status == 0){?><a href="processdeleteclaimtransactiondetail.php?Id=<?php echo $detail->get_Id(); ?>">Delete</a><?php }?>
                </td>
            </tr>
            <?php
        }
    ?>  
    </tbody>

</table>
</div>
<?php include('footer.php');?>