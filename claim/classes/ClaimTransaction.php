<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php include_once('ClaimTransactionDetail.php'); ?>
<?php
class ClaimTransaction extends BaseObject{
   const TABLENAME = 'ClaimTransaction';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $Travel;
    public $Employee;
    public $Status;
    public $SubmissionNote;
    public $ApprovalNote;
    public $RejectionNote;
    public $ClaimDate;
    public $ProcessedDate;

    const STATUS_ENTERED = 0;
    const STATUS_SUBMITTED = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;
    public static function getStatusOptions(){
        return array(
        self::STATUS_ENTERED =>'Entered',
        self::STATUS_SUBMITTED =>'Submitted',
        self::STATUS_APPROVED =>'Approved',
        self::STATUS_REJECTED =>'Rejected',
        );
    }
    public function getStatusText(){
        $tmpStatusOptions = ClaimTransaction::getStatusOptions();
        return isset($tmpStatusOptions[$this->Status]) ? $tmpStatusOptions[$this->Status] : "unknown status {$this->Status}";
    }
   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Travel,Employee,Status,SubmissionNote,ApprovalNote,RejectionNote,ClaimDate,ProcessedDate,LockField) VALUES('".$mySQLi->real_escape_string($this->Travel)."','".$mySQLi->real_escape_string($this->Employee)."','".$mySQLi->real_escape_string($this->Status)."','".$mySQLi->real_escape_string($this->SubmissionNote)."','".$mySQLi->real_escape_string($this->ApprovalNote)."','".$mySQLi->real_escape_string($this->RejectionNote)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->ClaimDate))."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->ProcessedDate))."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Travel = '".$mySQLi->real_escape_string($this->Travel)."', Employee = '".$mySQLi->real_escape_string($this->Employee)."', Status = '".$mySQLi->real_escape_string($this->Status)."', SubmissionNote = '".$mySQLi->real_escape_string($this->SubmissionNote)."', ApprovalNote = '".$mySQLi->real_escape_string($this->ApprovalNote)."', RejectionNote = '".$mySQLi->real_escape_string($this->RejectionNote)."', ClaimDate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->ClaimDate))."', ProcessedDate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->ProcessedDate))."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_ClaimTransactionDetail($page=0,$totalitem=0){
       return ClaimTransactionDetail::LoadCollection($this->get_mySQLi(),"ClaimTransaction = ".$this->Id,'Id ASC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpClaimTransaction = new ClaimTransaction($mySQLi);
               $tmpClaimTransaction->Id = $row['Id'];
               $tmpClaimTransaction->Travel = $row['Travel'];
               $tmpClaimTransaction->Employee = $row['Employee'];
               $tmpClaimTransaction->Status = $row['Status'];
               $tmpClaimTransaction->SubmissionNote = $row['SubmissionNote'];
               $tmpClaimTransaction->ApprovalNote = $row['ApprovalNote'];
               $tmpClaimTransaction->RejectionNote = $row['RejectionNote'];
               $tmpClaimTransaction->ClaimDate = strtotime($row['ClaimDate']);
               $tmpClaimTransaction->ProcessedDate = strtotime($row['ProcessedDate']);

               $tmpClaimTransaction->LockField = $row['LockField'];
               return $tmpClaimTransaction;
           }
           else
           {
               return false;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function LoadCollection($mySQLi, $Criteria = '1 = 1',$sort='',$page=0,$totalitem=0){
       $tmpQuery = "SELECT  * FROM ".self::TABLENAME." WHERE ".$mySQLi->real_escape_string($Criteria);
       if ($sort != ''){ $tmpQuery .= " "."ORDER BY ".$sort; }
       if ($page > 0 && $totalitem > 0){
           $start = ($page-1) * $totalitem;
           $tmpQuery .= " LIMIT ".$start.",".$totalitem;
       }
       if ($result = $mySQLi->query($tmpQuery)){
           $ClaimTransactions = array();
           while ($row = $result->fetch_array()){
               $tmpClaimTransaction = new ClaimTransaction($mySQLi);
               $tmpClaimTransaction->Id = $row['Id'];
               $tmpClaimTransaction->LockField = $row['LockField'];
               $tmpClaimTransaction->Travel = $row['Travel'];
               $tmpClaimTransaction->Employee = $row['Employee'];
               $tmpClaimTransaction->Status = $row['Status'];
               $tmpClaimTransaction->SubmissionNote = $row['SubmissionNote'];
               $tmpClaimTransaction->ApprovalNote = $row['ApprovalNote'];
               $tmpClaimTransaction->RejectionNote = $row['RejectionNote'];
               $tmpClaimTransaction->ClaimDate = strtotime($row['ClaimDate']);
               $tmpClaimTransaction->ProcessedDate = strtotime($row['ProcessedDate']);

               $ClaimTransactions[] = $tmpClaimTransaction;
           }
           return $ClaimTransactions;
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function Delete($mySQLi,$Id){
       if ($result = $mySQLi->query("DELETE FROM ".self::TABLENAME." WHERE Id=".$mySQLi->real_escape_string($Id))){
           if ($mySQLi->affected_rows == 0){
               throw new ObjectNotFoundException;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
}
?>