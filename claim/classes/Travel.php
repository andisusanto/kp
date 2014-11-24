<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class Travel extends BaseObject{
   const TABLENAME = 'Travel';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $StartDate;
    public $UntilDate;
    public $Closed;
    public $Name;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(StartDate,UntilDate,Closed,Name,LockField) VALUES('".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->StartDate))."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->UntilDate))."','".$mySQLi->real_escape_string($this->Closed)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET StartDate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->StartDate))."', UntilDate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->UntilDate))."', Closed = '".$mySQLi->real_escape_string($this->Closed)."', Name = '".$mySQLi->real_escape_string($this->Name)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_TravelEmployee($page=0,$totalitem=0){
       return TravelEmployee::LoadCollection($this->get_mySQLi(),"Travel = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_ClaimTransaction($page=0,$totalitem=0){
       return ClaimTransaction::LoadCollection($this->get_mySQLi(),"Travel = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpTravel = new Travel($mySQLi);
               $tmpTravel->Id = $row['Id'];
               $tmpTravel->StartDate = strtotime($row['StartDate']);
               $tmpTravel->UntilDate = strtotime($row['UntilDate']);
               $tmpTravel->Closed = $row['Closed'];
               $tmpTravel->Name = $row['Name'];

               $tmpTravel->LockField = $row['LockField'];
               return $tmpTravel;
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
           $Travels = array();
           while ($row = $result->fetch_array()){
               $tmpTravel = new Travel($mySQLi);
               $tmpTravel->Id = $row['Id'];
               $tmpTravel->LockField = $row['LockField'];
               $tmpTravel->StartDate = strtotime($row['StartDate']);
               $tmpTravel->UntilDate = strtotime($row['UntilDate']);
               $tmpTravel->Closed = $row['Closed'];
               $tmpTravel->Name = $row['Name'];

               $Travels[] = $tmpTravel;
           }
           return $Travels;
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