<?php
    include('header.php');
?>
<?php
include_once('../classes/ClaimType.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ClaimType = ClaimType::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="view_data">
<h3>Edit Claim Type</h3>
<div class="form_add">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmUpdateClaimType").validationEngine();
        });
    </script>
<form action="processeditclaimtype.php" method="POST" name="frmUpdateClaimType" id="frmUpdateClaimType">
   <input type="hidden" name="Id" value="<?php echo $ClaimType->get_Id();?>">
    <div>Code : <br><input class="validate[required]" type="text" name="Code" value="<?php echo $ClaimType->Code; ?>" ></div>
    <div>Name : <br><input class="validate[required]" type="text" name="Name" value="<?php echo $ClaimType->Name; ?>" ></div>
    <div>Is Active : <br><input type="checkbox" name="IsActive"  <?php if($ClaimType->IsActive){echo "Checked";}else{echo "";} ?>></div>

   <input type="submit" value="save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>