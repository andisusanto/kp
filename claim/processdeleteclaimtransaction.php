<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
?>
<?php
    include_once('classes/ClaimTransaction.php');
    include_once('classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    try{
        $ClaimTransaction = ClaimTransaction::GetObjectByKey($Conn, $_GET['Id']);
        if($ClaimTransaction->Employee != $_SESSION['CurrentEmployeeId']){throw new Exception('you have no authority to access this object');}
        if($ClaimTransaction->Status != 0){throw new Exception("only transaction with status 'entered' can be submmited");}
        ClaimTransaction::Delete($Conn, $_GET['Id']);
        $Conn->Commit();
        header('location:myclaimhistory.php');
    }catch (Exception $e) {
       include('error_handler.php');
    }
?>