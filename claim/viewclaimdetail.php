<?php
include_once('classes/ClaimTransactionDetail.php');
include_once('classes/GlobalFunction.php');
include_once('classes/ClaimType.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ClaimTransactionDetail = ClaimTransactionDetail::GetObjectByKey($Conn, $_GET['Id']);
?>

<?php $title = 'View Claim Detail'; ?>
<?php include('header.php');?>

<div class="view_data">

    <p><div><b>Claim Type : </b><?php $ClaimType = ClaimType::GetObjectByKey($Conn,$ClaimTransactionDetail->ClaimType);echo $ClaimType->Name; ?></div></p>
    <p><div><b>Note : </b><?php echo $ClaimTransactionDetail->Note; ?></div></p>
    <p><div><b>TransDate : </b><?php echo date('Y-M-d',$ClaimTransactionDetail->TransDate); ?></div></p>
    <p><div><b>Quantity : </b><?php echo $ClaimTransactionDetail->Quantity; ?></div></p>
    <p><div><b>Amount : </b><?php echo GlobalFunction::getIndonesianMoneyString($ClaimTransactionDetail->Amount); ?></div></p>
    <p><div><b>ProcessedAmount : </b><?php echo GlobalFunction::getIndonesianMoneyString($ClaimTransactionDetail->ProcessedAmount); ?></div></p>
<p><b>Attachment</b></p>
<?php if($ClaimTransactionDetail->Attachment!=NULL) {
?>
    <img src="asset/images/claimtransactiondetail/<?php echo $ClaimTransactionDetail->Attachment; ?>" alt="<?php echo $ClaimTransactionDetail->Attachment; ?>" width="300"/>
<?php }
else
{
echo "No Attachment";
}
?><br>
    <a href="viewclaim.php?Id=<?php echo $ClaimTransactionDetail->ClaimTransaction;?>">Back</a>
</div>
<?php include('footer.php');?>
