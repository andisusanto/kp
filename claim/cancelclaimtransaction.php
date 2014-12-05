<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
?>
<?php
    include_once('classes/Travel.php');
    include_once('classes/ClaimTransaction.php');
    include_once('classes/AdminInbox.php');
    include_once('classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    try {
       $ClaimTransaction = ClaimTransaction::GetObjectByKey($Conn, $_GET['Id']);
       $ClaimTransaction->Status = ClaimTransaction::STATUS_ENTERED;
       $ClaimTransaction->Update();
       $Conn->Commit();
       header('location:myclaimhistory.php');
    } catch (Exception $e) {
       include('error_handler.php');
    }
?>