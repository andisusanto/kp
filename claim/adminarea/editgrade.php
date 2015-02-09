<?php
    include('header.php');
?>
<?php
include_once('../classes/Grade.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Grade = Grade::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="view_data">
   <a class="backlink" href="viewgrade.php?Id=<?php echo $_GET['Id']; ?>">Back</a><br/><br/>
<h3>Edit Grade</h3>
<div class="form_add">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmUpdateGrade").validationEngine();
        });
    </script>
<form action="processeditgrade.php" method="POST" name="frmUpdateGrade" id="frmUpdateGrade">
    <input type="hidden" name="Id" value="<?php echo $Grade->get_Id();?>">
    <div>Name : <br><input class="validate[required]" type="text" name="Name" value="<?php echo $Grade->Name; ?>" ></div>
   <input type="submit" value="Save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>