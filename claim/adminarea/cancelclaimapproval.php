<?php
    include('checklogin.php');
?>
<?php
    include_once('../classes/ClaimTransaction.php');
    include_once('../classes/Travel.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();

try {
    $claimTransaction = ClaimTransaction::GetObjectByKey($Conn,$_GET['Id']);
    $travel = Travel::GetObjectByKey($Conn,$claimTransaction->Travel);
    if($travel->Closed){throw new Exception('Travel already closed');}
    $claimTransaction->ApprovalNote = "";
    $claimTransaction->RejectionNote = "";
    $claimTransaction->Status = ClaimTransaction::STATUS_SUBMITTED;
    $claimTransaction->Update();
    $Conn->Commit();
    header('location:claimapproval.php');
    } catch (Exception $e) {
       include('../error_handler.php');
    }
?>