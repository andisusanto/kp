<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
?>
<?php
    include_once('classes/ClaimTransaction.php');
    include_once('classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    try {
        $ClaimTransaction = new ClaimTransaction($Conn);
        $ClaimTransaction->Travel = $_POST['Travel'];
        $ClaimTransaction->Employee = $_SESSION['CurrentEmployeeId'];
        $ClaimTransaction->Status = 0;
        $ClaimTransaction->SubmissionNote = $_POST['SubmissionNote'];
        $ClaimTransaction->ClaimDate = strtotime(date('Y-m-d H:i:s'));
        $ClaimTransaction->Save();
        $Conn->Commit();
        header('location:viewclaim.php?Id='.$ClaimTransaction->get_Id());
    } catch (Exception $e) {
       include('error_handler.php');
    }
?>