<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
?>
<?php
    include_once('classes/Travel.php');
    include_once('classes/ClaimTransaction.php');
    include_once('classes/ClaimTransactionDetail.php');
    include_once('classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    try {
        $ClaimTransactionId = $_POST['ClaimTransaction'];
        $ClaimTransaction = ClaimTransaction::GetObjectByKey($Conn,$ClaimTransactionId);

        if ($ClaimTransaction->Employee != $_SESSION['CurrentEmployeeId']){throw new Exception('you have no authority to access this object');}
        if ($ClaimTransaction->Status != 0){throw new Exception("only transaction with status 'entered' can add new detail");}
        $Travel = Travel::GetObjectByKey($Conn,$ClaimTransaction->Travel);
        $transDate = strtotime($_POST['TransDate']);
        if($transDate < $Travel->StartDate || $transDate > $Travel->UntilDate){throw new Exception("transaction date out of travel date range : travel range ".date('Y-M-d',$Travel->StartDate)." - ".date('Y-M-d',$Travel->UntilDate));}
        $rnd = rand(0,99999);
        $uploaddir = 'asset/images/claimtransactiondetail/';
        $fileName = $_FILES['Attachment']['name'];
        if($fileName){
            $tmpName  = $_FILES['Attachment']['tmp_name'];
            $fileName = $rnd."-".$fileName;
            $uploadfile = $uploaddir.$fileName;
            move_uploaded_file($tmpName, $uploadfile);
        }
        $ClaimTransactionDetail = new ClaimTransactionDetail($Conn);
        $ClaimTransactionDetail->Note = $_POST['Note'];
        $ClaimTransactionDetail->TransDate = $transDate;
        $ClaimTransactionDetail->Attachment = $fileName;
        $ClaimTransactionDetail->ClaimTransaction = $ClaimTransactionId;
        $ClaimTransactionDetail->Amount = $_POST['Amount'];
        $ClaimTransactionDetail->ClaimType = $_POST['ClaimType'];

        $ClaimTransactionDetail->Save();
        $Conn->Commit();
        header('location:viewclaim.php?Id='.$ClaimTransactionDetail->ClaimTransaction);
    } catch (Exception $e) {
       include('error_handler.php');
    }
?>