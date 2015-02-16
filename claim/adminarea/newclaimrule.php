<?php
    include('header.php');
?>
<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<div class="view_data">
   <a class="backlink" href="claimrule.php">Back</a><br/><br/>
<h3>New Claim Rule</h3>
<div class="form_add">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmAddClaimRule").validationEngine();
        });
    </script>
<form action="processnewclaimrule.php" method="POST" name="frmAddClaimRule" id="frmAddClaimRule">
    <div>ClaimType : <br> 
        <select name="ClaimType" class="validate[required]">
       <?php
           include_once('../classes/ClaimType.php');
           $ClaimTypes = ClaimType::LoadCollection($Conn);
           foreach ($ClaimTypes as $ClaimType) { ?>
               <option value=" <?php echo $ClaimType->get_Id();?>"> <?php echo $ClaimType->Name;?></option>
           <?php }?>
       </select>
    </div>
    <div>Grade : <br>
        <select name="Grade" class="validate[required]">
       <?php
           include_once('../classes/Grade.php');
           $Grades = Grade::LoadCollection($Conn);
           foreach ($Grades as $Grade) { ?>
               <option value=" <?php echo $Grade->get_Id();?>"> <?php echo $Grade->Name;?></option>
           <?php }?>
       </select>
    </div>
    <div>MaxAmount : <br><input class="validate[required,custom[integer,min[1]]]"  type="text" name="MaxAmount">    </div>
   <input type="submit" value="Save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>