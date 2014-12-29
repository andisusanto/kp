<?php
    include('checklogin.php');
?>
<?php
    include_once('../classes/ClaimTransaction.php');
    include_once('../classes/Travel.php');
    include_once('../classes/EmployeeInbox.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    try {
        $claimTransaction = ClaimTransaction::GetObjectByKey($Conn, $_POST['Id']);
        $travel = Travel::GetObjectByKey($Conn,$claimTransaction->Travel);
        if($travel->Closed){throw new Exception('Travel already closed');}
        $employeeInbox = new EmployeeInbox($Conn);
        $employeeInbox->Employee = $claimTransaction->Employee;
        if($_POST['action']==2){
            $claimTransaction->ApprovalNote = $_POST['txtNote'];
            $claimTransaction->Status = ClaimTransaction::STATUS_APPROVED;
            $employeeInbox->Subject = 'approved transaction';
            $employeeInbox->Message = 'your transaction at '.date('Y-M-d',$claimTransaction->ClaimDate).' has been approved, click open for more information!';
        }elseif($_POST['action']==3){
            $claimTransaction->RejectionNote = $_POST['txtNote'];
            $claimTransaction->Status = ClaimTransaction::STATUS_REJECTED;
            $employeeInbox->Subject = 'rejected transaction';
            $employeeInbox->Message = 'your transaction at '.date('Y-M-d',$claimTransaction->ClaimDate).' has been rejected, click open for more information!';
        }
        $claimTransaction->ProcessedDate = strtotime(date('Y-m-d H:i:s'));
        $employeeInbox->ViewDetailLink = 'viewclaim.php?Id='.$claimTransaction->get_Id();
        $employeeInbox->ReceivedDate = strtotime(date('Y-m-d H:i:s'));
        $employeeInbox->IsRead = 0;
        $employeeInbox->Save();
        $claimTransaction->Update();
        $Conn->Commit();
        header('location:claimapproval.php');
    } catch (Exception $e) {
       include('../error_handler.php');
    }
?>