<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class ClaimRule extends BaseObject{
   const TABLENAME = 'ClaimRule';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $MaxAmount;
    public $Grade;
    public $ClaimType;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(MaxAmount,Grade,ClaimType,LockField) VALUES('".$mySQLi->real_escape_string($this->MaxAmount)."','".$mySQLi->real_escape_string($this->Grade)."','".$mySQLi->real_escape_string($this->ClaimType)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET MaxAmount = '".$mySQLi->real_escape_string($this->MaxAmount)."', Grade = '".$mySQLi->real_escape_string($this->Grade)."', ClaimType = '".$mySQLi->real_escape_string($this->ClaimType)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpClaimRule = new ClaimRule($mySQLi);
               $tmpClaimRule->Id = $row['Id'];
               $tmpClaimRule->MaxAmount = $row['MaxAmount'];
               $tmpClaimRule->Grade = $row['Grade'];
               $tmpClaimRule->ClaimType = $row['ClaimType'];

               $tmpClaimRule->LockField = $row['LockField'];
               return $tmpClaimRule;
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
   
   public static function GetObjectByCriteria($mySQLi, $Criteria){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE {$Criteria} LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpClaimRule = new ClaimRule($mySQLi);
               $tmpClaimRule->Id = $row['Id'];
               $tmpClaimRule->MaxAmount = $row['MaxAmount'];
               $tmpClaimRule->Grade = $row['Grade'];
               $tmpClaimRule->ClaimType = $row['ClaimType'];

               $tmpClaimRule->LockField = $row['LockField'];
               return $tmpClaimRule;
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
           $ClaimRules = array();
           while ($row = $result->fetch_array()){
               $tmpClaimRule = new ClaimRule($mySQLi);
               $tmpClaimRule->Id = $row['Id'];
               $tmpClaimRule->LockField = $row['LockField'];
               $tmpClaimRule->MaxAmount = $row['MaxAmount'];
               $tmpClaimRule->Grade = $row['Grade'];
               $tmpClaimRule->ClaimType = $row['ClaimType'];

               $ClaimRules[] = $tmpClaimRule;
           }
           return $ClaimRules;
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