<?php
    include('header.php');
?>
<?php
include_once('../classes/Travel.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Travel = Travel::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="view_data">
<h3>Edit Travel</h3>
<div class="form_add">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmUpdateTravel").validationEngine();
        });
    </script>
<form action="processedittravel.php" method="POST" name="frmUpdateTravel" id="frmUpdateTravel">
    <input type="hidden" name="Id" value="<?php echo $Travel->get_Id();?>">
    <div>Name : <br><input class="validate[required]" type="text" name="Name" value="<?php echo $Travel->Name; ?>" ></div>
    <div>Start Date : <br><input type="text" class="date validate[required]" name="StartDate" value="<?php echo date('Y-m-d',$Travel->StartDate); ?>" ></div>
    <div>Until Date : <br><input type="text" class="date validate[required]" name="UntilDate" value="<?php echo date('Y-m-d',$Travel->UntilDate); ?>" ></div>
    <div>Closed : <br><input type="checkbox" name="Closed"  <?php if($Travel->Closed){echo "Checked";}else{echo "";} ?>></div>

   <input type="submit" value="save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>