<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
?>
<?php
    include_once('classes/ClaimTransactionDetail.php');
    include_once('classes/ClaimTransaction.php');
    include_once('classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $claimTransactionDetail = ClaimTransactionDetail::GetObjectByKey($Conn,$_GET['Id']);
    try {
        $claimTransaction = ClaimTransaction::GetObjectByKey($Conn,$claimTransactionDetail->ClaimTransaction);
        if($claimTransaction->Status !=0){throw new Exception("only detail of transaction with status 'entered' can be deleted");}
       ClaimTransactionDetail::Delete($Conn, $_GET['Id']);
       $Conn->Commit();
       header('location:viewclaim.php?Id='.$claimTransactionDetail->ClaimTransaction);
    } catch (Exception $e) {
       include('error_handler.php');
    }
?>