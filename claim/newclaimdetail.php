<?php $title = 'new claim detail'; ?>
<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
?>
<?php
    include_once('classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
?>
<?php include('header.php'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmAddClaimTransactionDetail").validationEngine();
        });
    </script>
<div class="form_add">
<form action="processnewclaimdetail.php" method="POST" name="frmAddClaimTransactionDetail" id="frmAddClaimTransactionDetail" enctype="multipart/form-data">
    <input type="hidden" name="ClaimTransaction" value="<?php echo $_GET['Claim'];?>"/>
    <div>TransDate : <br><input type="text" class="validate[required] date" name="TransDate">    </div>
    <div>ClaimType : <br>
        <select name="ClaimType" class="validate[required]" >
           <?php
               include_once('classes/ClaimType.php');
               $ClaimTypes = ClaimType::LoadCollection($Conn);
               foreach ($ClaimTypes as $ClaimType) { ?>
                   <option value="<?php echo $ClaimType->get_Id();?>"> <?php echo $ClaimType->Name;?></option>
           <?php }?>
       </select>
    </div>
    <div>Amount : <br><input type="text" name="Amount" class="validate[required,custom[integer,min[1]]]" >    </div>
    <div>Note : <br><textarea name="Note" class="validate[required]" ></textarea></div>
    <div>Attachment : <br><input type="file" name="Attachment">    </div>

   <input type="submit" value="save">
</form>
<?php include('footer.php'); ?>