<?php
include_once('classes/ClaimTransactionDetail.php');
include_once('classes/ClaimType.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ClaimTransactionDetail = ClaimTransactionDetail::GetObjectByKey($Conn, $_GET['Id']);
?>

<?php $title = 'view claim detail'; ?>
<?php include('header.php');?>

<div class="view_data">

    <div>ClaimType :<?php $ClaimType = ClaimType::GetObjectByKey($Conn,$ClaimTransactionDetail->ClaimType);echo $ClaimType->Name; ?></div>
    <div>Note : <?php echo $ClaimTransactionDetail->Note; ?></div>
    <div>TransDate :<?php echo date('Y-M-d',$ClaimTransactionDetail->TransDate); ?></div>
    <div>Amount : <?php echo $ClaimTransactionDetail->Amount; ?></div>
<p>attachment</p>
<?php if($ClaimTransactionDetail->Attachment!=NULL) {
?>
    <img src="asset/images/claimtransactiondetail/<?php echo $ClaimTransactionDetail->Attachment; ?>" alt="<?php echo $ClaimTransactionDetail->Attachment; ?>" width="300"/>
<?php }?><br>
    <a href="viewclaim.php?Id=<?php echo $ClaimTransactionDetail->ClaimTransaction;?>">back</a>
</div>
<?php include('footer.php');?>
