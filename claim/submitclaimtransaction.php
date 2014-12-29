<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
?>
<?php
    include_once('classes/Travel.php');
    include_once('classes/ClaimTransaction.php');
    include_once('classes/Employee.php');
    include_once('classes/AdminInbox.php');
    include_once('classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    try {
       $ClaimTransaction = ClaimTransaction::GetObjectByKey($Conn, $_GET['Id']);
       if($ClaimTransaction->Employee != $_SESSION['CurrentEmployeeId']){throw new Exception('you have no authority to access this object');}
       if($ClaimTransaction->Status != 0){throw new Exception("only transaction with status 'entered' can be submmited");}
       $Travel = Travel::GetObjectByKey($Conn,$ClaimTransaction->Travel);
       if($Travel->Closed == TRUE){throw new Exception("travel already closed");}
       $details = $ClaimTransaction->get_ClaimTransactionDetail();
       if (count($details) == 0){throw new Exception("transaction must have at least one detail");}
        $now = strtotime(date('Y-m-d H:i:s'));
       $ClaimTransaction->Status = ClaimTransaction::STATUS_SUBMITTED;
       $ClaimTransaction->ClaimDate = $now;
        $employee = Employee::GetObjectByKey($Conn,$ClaimTransaction->Employee);
        $adminInbox = new AdminInbox($Conn);
        $adminInbox->Subject = 'a request need your approval';
        $adminInbox->Message = 'a request from '.$employee->Name.' at '.date('Y-m-d',$now).' need approval. for more information click open!';
        $adminInbox->ViewDetailLink = 'viewclaim.php?Id='.$ClaimTransaction->get_Id();
        $adminInbox->ReceivedDate = $now;
        $adminInbox->IsRead = 0;
        $adminInbox->Save();
       $ClaimTransaction->Update();
       $Conn->Commit();
       header('location:myclaimhistory.php');
    } catch (Exception $e) {
       include('error_handler.php');
    }
?>