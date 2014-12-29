<?php
    include('header.php');
?>
<?php
include_once('../classes/Travel.php');
include_once('../classes/Helper.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Travel = Travel::GetObjectByKey($Conn, $_GET['Id']);
?><div class="view_data">
<p><b>Name : </b><?php echo $Travel->Name; ?></p>
<p><b>Start Date : </b><?php echo date('Y-M-d',$Travel->StartDate); ?></p>
<p><b>Until Date : </b><?php echo date('Y-M-d',$Travel->UntilDate); ?></p>
<p><b>Closed : </b><?php echo Helper::getBooleanTextValue($Travel->Closed); ?></p>
<a href="travel.php">Back</a>
<a href="edittravel.php?Id=<?php echo $Travel->get_Id(); ?>">Edit</a></div>
<?php
    include('footer.php');
?>