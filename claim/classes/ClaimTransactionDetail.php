<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class ClaimTransactionDetail extends BaseObject{
   const TABLENAME = 'ClaimTransactionDetail';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $Note;
    public $Quantity;
    public $TransDate;
    public $Attachment;
    public $ClaimTransaction;
    public $Amount;
    public $ProcessedAmount;
    public $ClaimType;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Note,Quantity,TransDate,Attachment,ClaimTransaction,Amount,ProcessedAmount,ClaimType,LockField) VALUES('".$mySQLi->real_escape_string($this->Note)."','".$mySQLi->real_escape_string($this->Quantity)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->TransDate))."','".$mySQLi->real_escape_string($this->Attachment)."','".$mySQLi->real_escape_string($this->ClaimTransaction)."','".$mySQLi->real_escape_string($this->Amount)."','".$mySQLi->real_escape_string($this->ProcessedAmount)."','".$mySQLi->real_escape_string($this->ClaimType)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Note = '".$mySQLi->real_escape_string($this->Note)."', Quantity = '".$mySQLi->real_escape_string($this->Quantity)."', TransDate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->TransDate))."', Attachment = '".$mySQLi->real_escape_string($this->Attachment)."', ClaimTransaction = '".$mySQLi->real_escape_string($this->ClaimTransaction)."', Amount = '".$mySQLi->real_escape_string($this->Amount)."', ProcessedAmount = '".$mySQLi->real_escape_string($this->ProcessedAmount)."', ClaimType = '".$mySQLi->real_escape_string($this->ClaimType)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpClaimTransactionDetail = new ClaimTransactionDetail($mySQLi);
               $tmpClaimTransactionDetail->Id = $row['Id'];
               $tmpClaimTransactionDetail->Note = $row['Note'];
               $tmpClaimTransactionDetail->Quantity = $row['Quantity'];
               $tmpClaimTransactionDetail->TransDate = strtotime($row['TransDate']);
               $tmpClaimTransactionDetail->Attachment = $row['Attachment'];
               $tmpClaimTransactionDetail->ClaimTransaction = $row['ClaimTransaction'];
               $tmpClaimTransactionDetail->Amount = $row['Amount'];
               $tmpClaimTransactionDetail->ProcessedAmount = $row['ProcessedAmount'];
               $tmpClaimTransactionDetail->ClaimType = $row['ClaimType'];

               $tmpClaimTransactionDetail->LockField = $row['LockField'];
               return $tmpClaimTransactionDetail;
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
           $ClaimTransactionDetails = array();
           while ($row = $result->fetch_array()){
               $tmpClaimTransactionDetail = new ClaimTransactionDetail($mySQLi);
               $tmpClaimTransactionDetail->Id = $row['Id'];
               $tmpClaimTransactionDetail->LockField = $row['LockField'];
               $tmpClaimTransactionDetail->Note = $row['Note'];
               $tmpClaimTransactionDetail->Quantity = $row['Quantity'];
               $tmpClaimTransactionDetail->TransDate = strtotime($row['TransDate']);
               $tmpClaimTransactionDetail->Attachment = $row['Attachment'];
               $tmpClaimTransactionDetail->ClaimTransaction = $row['ClaimTransaction'];
               $tmpClaimTransactionDetail->Amount = $row['Amount'];
               $tmpClaimTransactionDetail->ProcessedAmount = $row['ProcessedAmount'];
               $tmpClaimTransactionDetail->ClaimType = $row['ClaimType'];

               $ClaimTransactionDetails[] = $tmpClaimTransactionDetail;
           }
           return $ClaimTransactionDetails;
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