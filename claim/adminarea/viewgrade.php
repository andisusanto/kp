<?php
    include('header.php');
?>
<?php
include_once('../classes/Grade.php');
include_once('../classes/Helper.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Grade = Grade::GetObjectByKey($Conn, $_GET['Id']);
?><div class="view_data">
<p><b>Name : </b><?php echo $Grade->Name; ?></p>
<a href="grade.php">Back</a>
<a href="editgrade.php?Id=<?php echo $Grade->get_Id(); ?>">Edit</a></div>
<?php
    include('footer.php');
?>