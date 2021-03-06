<?php
include_once('../classes/ClaimTransactionDetail.php');
include_once('../classes/GlobalFunction.php');
include_once('../classes/ClaimType.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ClaimTransactionDetail = ClaimTransactionDetail::GetObjectByKey($Conn, $_GET['Id']);
?>

<?php include('header.php');?>

<div class="view_data">
   <a class="backlink" href="viewclaim.php?Id=<?php echo $ClaimTransactionDetail->ClaimTransaction; ?>">Back</a><br/><br/>

    <p><b>ClaimType : </b><?php $ClaimType = ClaimType::GetObjectByKey($Conn,$ClaimTransactionDetail->ClaimType);echo $ClaimType->Name; ?></p>
    <p><b>Note : </b><?php echo $ClaimTransactionDetail->Note; ?></p>
    <p><b>TransDate : </b><?php echo date('Y-M-d',$ClaimTransactionDetail->TransDate); ?></p>
    <p><b>Amount : </b><?php echo GlobalFunction::getIndonesianMoneyString($ClaimTransactionDetail->Amount); ?></p>
    <p><b>Processed Amount : </b><?php echo GlobalFunction::getIndonesianMoneyString($ClaimTransactionDetail->ProcessedAmount); ?></p>

<?php if($ClaimTransactionDetail->Attachment!=NULL) {
?>
    <h4>attachment :</h4>
    <img src="../asset/images/claimtransactiondetail/<?php echo $ClaimTransactionDetail->Attachment; ?>" alt="<?php echo $ClaimTransactionDetail->Attachment; ?>" width="300"/>
<?php }?>
</div>
<?php include('footer.php');?>
