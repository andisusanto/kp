<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/ClaimRule.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $ClaimRule = ClaimRule::GetObjectByKey($Conn, $_POST['Id']);
    $tmpClaimRule = ClaimRule::GetObjectByCriteria($Conn, "ClaimType = '{$_POST['ClaimType']}' AND Grade = '{$_POST['Grade']}'");
    if ($tmpClaimRule) throw new Exception('Object with same grade and claimtype already exists');
    $ClaimRule->MaxAmount = $_POST['MaxAmount'];
    $ClaimRule->Grade = $_POST['Grade'];
    $ClaimRule->ClaimType = $_POST['ClaimType'];

    $ClaimRule->Update();
    $Conn->Commit();
    header('location:viewclaimrule.php?Id='.$ClaimRule->get_Id());
} catch (Exception $e) {
   include('../error_handler.php');
}
?>