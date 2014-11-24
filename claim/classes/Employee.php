<?php include_once('UserBase.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Employee extends UserBase{
   const TABLENAME = 'Employee';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $IsActive;
    public $Code;
    public $Name;
    public $ChangePasswordOnLogIn;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(StoredPassword,IsActive,Code,UserName,Name,ChangePasswordOnLogIn,LockField) VALUES('".$mySQLi->real_escape_string($this->StoredPassword)."','".$mySQLi->real_escape_string($this->IsActive)."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->UserName)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->ChangePasswordOnLogIn)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET StoredPassword = '".$mySQLi->real_escape_string($this->StoredPassword)."', IsActive = '".$mySQLi->real_escape_string($this->IsActive)."', Code = '".$mySQLi->real_escape_string($this->Code)."', UserName = '".$mySQLi->real_escape_string($this->UserName)."', Name = '".$mySQLi->real_escape_string($this->Name)."', ChangePasswordOnLogIn = '".$mySQLi->real_escape_string($this->ChangePasswordOnLogIn)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_ClaimTransaction($page=0,$totalitem=0){
       return ClaimTransaction::LoadCollection($this->get_mySQLi(),"Employee = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_TravelEmployee($page=0,$totalitem=0){
       return TravelEmployee::LoadCollection($this->get_mySQLi(),"Employee = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpEmployee = new Employee($mySQLi);
               $tmpEmployee->Id = $row['Id'];
               $tmpEmployee->StoredPassword = $row['StoredPassword'];
               $tmpEmployee->IsActive = $row['IsActive'];
               $tmpEmployee->Code = $row['Code'];
               $tmpEmployee->UserName = $row['UserName'];
               $tmpEmployee->Name = $row['Name'];
               $tmpEmployee->ChangePasswordOnLogIn = $row['ChangePasswordOnLogIn'];

               $tmpEmployee->LockField = $row['LockField'];
               return $tmpEmployee;
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
   public static function GetObjectByUserName($mySQLi, $UserName){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE UserName = '".$mySQLi->real_escape_string($UserName)."' LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpEmployee = new Employee($mySQLi);
               $tmpEmployee->Id = $row['Id'];
               $tmpEmployee->StoredPassword = $row['StoredPassword'];
               $tmpEmployee->IsActive = $row['IsActive'];
               $tmpEmployee->Code = $row['Code'];
               $tmpEmployee->UserName = $row['UserName'];
               $tmpEmployee->Name = $row['Name'];
               $tmpEmployee->ChangePasswordOnLogIn = $row['ChangePasswordOnLogIn'];

               $tmpEmployee->LockField = $row['LockField'];
               return $tmpEmployee;
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
           $Employees = array();
           while ($row = $result->fetch_array()){
               $tmpEmployee = new Employee($mySQLi);
               $tmpEmployee->Id = $row['Id'];
               $tmpEmployee->LockField = $row['LockField'];
               $tmpEmployee->StoredPassword = $row['StoredPassword'];
               $tmpEmployee->IsActive = $row['IsActive'];
               $tmpEmployee->Code = $row['Code'];
               $tmpEmployee->UserName = $row['UserName'];
               $tmpEmployee->Name = $row['Name'];
               $tmpEmployee->ChangePasswordOnLogIn = $row['ChangePasswordOnLogIn'];

               $Employees[] = $tmpEmployee;
           }
           return $Employees;
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