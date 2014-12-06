<?php
    include('header.php');
?>
<?php
include_once('../classes/Admin.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Admin = Admin::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="view_data">
   <a class="backlink" href="viewadmin.php?Id=<?php echo $_GET['Id']; ?>">back</a><br/><br/>
<h3>Edit Admin</h3>
<div class="form_add">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmUpdateAdmin").validationEngine();
        });
    </script>
<form action="processeditadmin.php" method="POST" name="frmUpdateAdmin" id="frmUpdateAdmin">
   <input type="hidden" name="Id" value="<?php echo $Admin->get_Id();?>">
    <div>User Name : <br><input class="validate[required]" type="text" name="UserName" value="<?php echo $Admin->UserName; ?>" ></div>
    <div>Is Active : <br><input type="checkbox" name="IsActive"  <?php if($Admin->IsActive){echo "Checked";}else{echo "";} ?>></div>
   <input type="submit" value="save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>