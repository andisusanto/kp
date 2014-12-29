<?php
    include('header.php');
?>
<?php
include_once('../classes/Admin.php');
include_once('../classes/Connection.php');
include_once('../classes/Helper.php');
$Conn = Connection::get_DefaultConnection();
$Admin = Admin::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="view_data">
<p><b>User Name : </b><?php echo $Admin->UserName; ?></p>
<p><b>Is Active : </b><?php echo Helper::getBooleanTextValue($Admin->IsActive); ?></p>
<a href="admin.php">Back</a>
<a href="editadmin.php?Id=<?php echo $Admin->get_Id(); ?>">Edit</a></div>
<?php
    include('footer.php');
?>