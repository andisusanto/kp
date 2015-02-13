<?php
    include('checklogin.php');
?>
<?php
    include_once('../classes/ClaimTransaction.php');
    include_once('../classes/ClaimTransactionDetail.php');
    include_once('../classes/ClaimRule.php');
    include_once('../classes/Employee.php');
    include_once('../classes/Travel.php');
    include_once('../classes/EmployeeInbox.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    try {
        $claimTransaction = ClaimTransaction::GetObjectByKey($Conn, $_POST['Id']);
        $employee = Employee::GetObjectByKey($Conn, $claimTransaction->Employee);
        $travel = Travel::GetObjectByKey($Conn,$claimTransaction->Travel);
        if($travel->Closed){throw new Exception('Travel already closed');}
        $employeeInbox = new EmployeeInbox($Conn);
        $employeeInbox->Employee = $claimTransaction->Employee;
        if($_POST['action']==2){
            $claimTransaction->ApprovalNote = $_POST['txtNote'];
            $claimTransaction->Status = ClaimTransaction::STATUS_APPROVED;
            $employeeInbox->Subject = 'Transaction ('.date('Y-M-d',$claimTransaction->ClaimDate).') approved';
            $employeeInbox->Message = 'your transaction at '.date('Y-M-d',$claimTransaction->ClaimDate).' has been approved, click open for more information!';
        }elseif($_POST['action']==3){
            $claimTransaction->RejectionNote = $_POST['txtNote'];
            $claimTransaction->Status = ClaimTransaction::STATUS_REJECTED;
            $employeeInbox->Subject = 'Transaction ('.date('Y-M-d',$claimTransaction->ClaimDate).') rejected';
            $employeeInbox->Message = 'your transaction at '.date('Y-M-d',$claimTransaction->ClaimDate).' has been rejected, click open for more information!';
        }
        $claimTransaction->ProcessedDate = strtotime(date('Y-m-d H:i:s'));

        $details = ClaimTransactionDetail::LoadCollection($Conn, "ClaimTransaction = '{$claimTransaction->get_Id()}'");
        foreach ($details as $detail)
        {
            $detail->ProcessedAmount = $detail->Amount;
            $claimRule = ClaimRule::GetObjectByCriteria($Conn, "ClaimType = '{$detail->ClaimType}' AND Grade = '{$employee->Grade}'");
            if ($claimRule)
            {
                $tmpMaxAmount = $claimRule->MaxAmount * $detail->Quantity;
                if($detail->Amount > $tmpMaxAmount)
                {
                    $detail->ProcessedAmount = $tmpMaxAmount;
                }
            }            
            $detail->Update();
        }
        
        $employeeInbox->ViewDetailLink = 'viewclaim.php?Id='.$claimTransaction->get_Id();
        $employeeInbox->ReceivedDate = strtotime(date('Y-m-d H:i:s'));
        $employeeInbox->IsRead = 0;
        $employeeInbox->Save();
        $claimTransaction->Update();
        $Conn->Commit();
        header('location:viewclaim.php?Id='.$claimTransaction->get_Id());
    } catch (Exception $e) {
       include('../error_handler.php');
    }
?>