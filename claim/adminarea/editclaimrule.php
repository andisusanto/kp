<?php
    include('header.php');
?>
<?php
include_once('../classes/ClaimRule.php');
include_once('../classes/ClaimType.php');
include_once('../classes/Grade.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ClaimRule = ClaimRule::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="view_data">
   <a class="backlink" href="viewclaimrule.php?Id=<?php echo $_GET['Id']; ?>">Back</a><br/><br/>
<h3>Edit Claim Rule</h3>
<div class="form_add">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmUpdateClaimRule").validationEngine();
        });
    </script>
<form action="processeditclaimrule.php" method="POST" name="frmUpdateClaimRule" id="frmUpdateClaimRule">
   <input type="hidden" name="Id" value="<?php echo $ClaimRule->get_Id();?>" />
    <div>ClaimType :<br> 
    <select name="ClaimType">
       <?php
          $ClaimTypes = ClaimType::LoadCollection($Conn);
          foreach ($ClaimTypes as $ClaimType) {
       	if($ClaimRule->ClaimType==$ClaimType->get_Id()){
              $isSelected = 'selected';
          }else{
              $isSelected = '';
          }
               echo "<option value=".$ClaimType->get_Id()." $isSelected>".$ClaimType->Name."</option>";
           }
       ?>
       </select
    </div>
    <div>Grade :<br> 
    <select name="Grade">
       <?php
          $Grades = Grade::LoadCollection($Conn);
          foreach ($Grades as $Grade) {
       	if($ClaimRule->Grade==$Grade->get_Id()){
              $isSelected = 'selected';
          }else{
              $isSelected = '';
          }
               echo "<option value=".$Grade->get_Id()." $isSelected>".$Grade->Name."</option>";
           }
       ?>
       </select>
    </div>
    <div>MaxAmount :<br> <input type="text" name="MaxAmount" value="<?php echo $ClaimRule->MaxAmount; ?>" >    </div>

   <input type="submit" value="save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>