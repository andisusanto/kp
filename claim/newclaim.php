<?php $title = 'new claim'; ?>
<?php include('header.php'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#frmAddClaimTransaction").validationEngine();
    });
</script>
<div class="form_add">
<h3>New claim</h3>
<form action="processnewclaim.php" method="POST" name="frmAddClaimTransaction" id="frmAddClaimTransaction">
    <div>Travel : <br>
        <select name="Travel" class="validate[required]">
           <?php
                include_once('classes/Connection.php');
                $Conn = Connection::get_DefaultConnection();
               include_once('classes/Travel.php');
               $Travels = Travel::LoadCollection($Conn);
               foreach ($Travels as $Travel) { ?>
                   <option value="<?php echo $Travel->get_Id();?>"> <?php echo $Travel->Name;?></option>
           <?php }?>
       </select>
    </div>
    <div>Submission Note : <br><textarea class="validate[required]" style="width:50%;" name="SubmissionNote"></textarea></div>

   <input type="submit" value="save">
</form>
</div>
<?php include('footer.php');?>