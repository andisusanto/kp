<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class ClaimType extends BaseObject{
   const TABLENAME = 'ClaimType';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $Code;
    public $IsActive;
    public $Name;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Code,IsActive,Name,LockField) VALUES('".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->IsActive)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Code = '".$mySQLi->real_escape_string($this->Code)."', IsActive = '".$mySQLi->real_escape_string($this->IsActive)."', Name = '".$mySQLi->real_escape_string($this->Name)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_ClaimTransactionDetail($page=0,$totalitem=0){
       return ClaimTransactionDetail::LoadCollection($this->get_mySQLi(),"ClaimType = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpClaimType = new ClaimType($mySQLi);
               $tmpClaimType->Id = $row['Id'];
               $tmpClaimType->Code = $row['Code'];
               $tmpClaimType->IsActive = $row['IsActive'];
               $tmpClaimType->Name = $row['Name'];

               $tmpClaimType->LockField = $row['LockField'];
               return $tmpClaimType;
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
           $ClaimTypes = array();
           while ($row = $result->fetch_array()){
               $tmpClaimType = new ClaimType($mySQLi);
               $tmpClaimType->Id = $row['Id'];
               $tmpClaimType->LockField = $row['LockField'];
               $tmpClaimType->Code = $row['Code'];
               $tmpClaimType->IsActive = $row['IsActive'];
               $tmpClaimType->Name = $row['Name'];

               $ClaimTypes[] = $tmpClaimType;
           }
           return $ClaimTypes;
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