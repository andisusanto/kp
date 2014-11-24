<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class AdminInbox extends BaseObject{
   const TABLENAME = 'AdminInbox';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $Subject;
    public $Message;
    public $ReceivedDate;
    public $IsRead;
    public $ViewDetailLink;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Subject,Message,ReceivedDate,IsRead,ViewDetailLink,LockField) VALUES('".$mySQLi->real_escape_string($this->Subject)."','".$mySQLi->real_escape_string($this->Message)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->ReceivedDate))."','".$mySQLi->real_escape_string($this->IsRead)."','".$mySQLi->real_escape_string($this->ViewDetailLink)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Subject = '".$mySQLi->real_escape_string($this->Subject)."', Message = '".$mySQLi->real_escape_string($this->Message)."', ReceivedDate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->ReceivedDate))."', IsRead = '".$mySQLi->real_escape_string($this->IsRead)."', ViewDetailLink = '".$mySQLi->real_escape_string($this->ViewDetailLink)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpAdminInbox = new AdminInbox($mySQLi);
               $tmpAdminInbox->Id = $row['Id'];
               $tmpAdminInbox->Subject = $row['Subject'];
               $tmpAdminInbox->Message = $row['Message'];
               $tmpAdminInbox->ReceivedDate = strtotime($row['ReceivedDate']);
               $tmpAdminInbox->IsRead = $row['IsRead'];
               $tmpAdminInbox->ViewDetailLink = $row['ViewDetailLink'];

               $tmpAdminInbox->LockField = $row['LockField'];
               return $tmpAdminInbox;
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
           $AdminInboxs = array();
           while ($row = $result->fetch_array()){
               $tmpAdminInbox = new AdminInbox($mySQLi);
               $tmpAdminInbox->Id = $row['Id'];
               $tmpAdminInbox->LockField = $row['LockField'];
               $tmpAdminInbox->Subject = $row['Subject'];
               $tmpAdminInbox->Message = $row['Message'];
               $tmpAdminInbox->ReceivedDate = strtotime($row['ReceivedDate']);
               $tmpAdminInbox->IsRead = $row['IsRead'];
               $tmpAdminInbox->ViewDetailLink = $row['ViewDetailLink'];

               $AdminInboxs[] = $tmpAdminInbox;
           }
           return $AdminInboxs;
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