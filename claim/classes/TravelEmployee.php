<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class TravelEmployee extends BaseObject{
   const TABLENAME = 'TravelEmployee';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $Travel;
    public $Employee;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Travel,Employee,LockField) VALUES('".$mySQLi->real_escape_string($this->Travel)."','".$mySQLi->real_escape_string($this->Employee)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Travel = '".$mySQLi->real_escape_string($this->Travel)."', Employee = '".$mySQLi->real_escape_string($this->Employee)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpTravelEmployee = new TravelEmployee($mySQLi);
               $tmpTravelEmployee->Id = $row['Id'];
               $tmpTravelEmployee->Travel = $row['Travel'];
               $tmpTravelEmployee->Employee = $row['Employee'];

               $tmpTravelEmployee->LockField = $row['LockField'];
               return $tmpTravelEmployee;
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
           $TravelEmployees = array();
           while ($row = $result->fetch_array()){
               $tmpTravelEmployee = new TravelEmployee($mySQLi);
               $tmpTravelEmployee->Id = $row['Id'];
               $tmpTravelEmployee->LockField = $row['LockField'];
               $tmpTravelEmployee->Travel = $row['Travel'];
               $tmpTravelEmployee->Employee = $row['Employee'];

               $TravelEmployees[] = $tmpTravelEmployee;
           }
           return $TravelEmployees;
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