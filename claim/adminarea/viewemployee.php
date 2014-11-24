<?php
    include('header.php');
?>
<?php
include_once('../classes/Employee.php');
include_once('../classes/Helper.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Employee = Employee::GetObjectByKey($Conn, $_GET['Id']);
?><div class="view_data">
<p><b>Code : </b><?php echo $Employee->Code; ?></p>
<p><b>Name : </b><?php echo $Employee->Name; ?></p>
<p><b>User Name : </b><?php echo $Employee->UserName; ?></p>
<p><b>Is Active : </b><?php echo Helper::getBooleanTextValue($Employee->IsActive); ?></p>
<p><b>Change Password On Log In : </b><?php echo Helper::getBooleanTextValue($Employee->ChangePasswordOnLogIn); ?></p>
<a href="employee.php">back</a>
<a href="editemployee.php?Id=<?php echo $Employee->get_Id(); ?>">edit</a></div>
<?php
    include('footer.php');
?>