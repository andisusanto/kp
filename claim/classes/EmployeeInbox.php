<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class EmployeeInbox extends BaseObject{
   const TABLENAME = 'EmployeeInbox';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $Message;
    public $IsRead;
    public $Subject;
    public $Employee;
    public $ViewDetailLink;
    public $ReceivedDate;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Message,IsRead,Subject,Employee,ViewDetailLink,ReceivedDate,LockField) VALUES('".$mySQLi->real_escape_string($this->Message)."','".$mySQLi->real_escape_string($this->IsRead)."','".$mySQLi->real_escape_string($this->Subject)."','".$mySQLi->real_escape_string($this->Employee)."','".$mySQLi->real_escape_string($this->ViewDetailLink)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->ReceivedDate))."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Message = '".$mySQLi->real_escape_string($this->Message)."', IsRead = '".$mySQLi->real_escape_string($this->IsRead)."', Subject = '".$mySQLi->real_escape_string($this->Subject)."', Employee = '".$mySQLi->real_escape_string($this->Employee)."', ViewDetailLink = '".$mySQLi->real_escape_string($this->ViewDetailLink)."', ReceivedDate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->ReceivedDate))."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpEmployeeInbox = new EmployeeInbox($mySQLi);
               $tmpEmployeeInbox->Id = $row['Id'];
               $tmpEmployeeInbox->Message = $row['Message'];
               $tmpEmployeeInbox->IsRead = $row['IsRead'];
               $tmpEmployeeInbox->Subject = $row['Subject'];
               $tmpEmployeeInbox->Employee = $row['Employee'];
               $tmpEmployeeInbox->ViewDetailLink = $row['ViewDetailLink'];
               $tmpEmployeeInbox->ReceivedDate = strtotime($row['ReceivedDate']);

               $tmpEmployeeInbox->LockField = $row['LockField'];
               return $tmpEmployeeInbox;
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
           $EmployeeInboxs = array();
           while ($row = $result->fetch_array()){
               $tmpEmployeeInbox = new EmployeeInbox($mySQLi);
               $tmpEmployeeInbox->Id = $row['Id'];
               $tmpEmployeeInbox->LockField = $row['LockField'];
               $tmpEmployeeInbox->Message = $row['Message'];
               $tmpEmployeeInbox->IsRead = $row['IsRead'];
               $tmpEmployeeInbox->Subject = $row['Subject'];
               $tmpEmployeeInbox->Employee = $row['Employee'];
               $tmpEmployeeInbox->ViewDetailLink = $row['ViewDetailLink'];
               $tmpEmployeeInbox->ReceivedDate = strtotime($row['ReceivedDate']);

               $EmployeeInboxs[] = $tmpEmployeeInbox;
           }
           return $EmployeeInboxs;
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