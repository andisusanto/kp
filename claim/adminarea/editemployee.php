<?php
    include('header.php');
?>
<?php
include_once('../classes/Employee.php');
include_once('../classes/Grade.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Employee = Employee::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="view_data">
   <a class="backlink" href="viewemployee.php?Id=<?php echo $_GET['Id']; ?>">Back</a><br/><br/>
<h3>Edit Employee</h3>
<div class="form_add">
    <script type="text/javascript">
            $(document).ready(function () {
                $("#frmUpdateEmployee").validationEngine();
            });
    </script>
<form action="processeditemployee.php" method="POST" name="frmUpdateEmployee" id="frmUpdateEmployee">
   <input type="hidden" name="Id" value="<?php echo $Employee->get_Id();?>">
    <div>Code : <br><input class="validate[required]" type="text" name="Code" value="<?php echo $Employee->Code; ?>" ></div>
    <div>Name : <br><input class="validate[required]" type="text" name="Name" value="<?php echo $Employee->Name; ?>" ></div>
    <div>Grade : <br>
    <select class="validate[required]" name="Grade">
       <?php
            $Grades = Grade::LoadCollection($Conn);
            foreach ($Grades as $Grade) {
       	    if($Employee->Grade==$Grade->get_Id()){
                $isSelected = 'selected';
            }else{
                $isSelected = '';
            }
                echo "<option value=".$Grade->get_Id()." $isSelected>".$Grade->Name."</option>";
            }
       ?>
       </select>
    </div>
    <div>Is Active : <br><input type="checkbox" name="IsActive"  <?php if($Employee->IsActive){echo "Checked";}else{echo "";} ?>></div>
    <div>User Name : <br><input class="validate[required]" type="text" name="UserName" value="<?php echo $Employee->UserName; ?>" ></div>
    <div>Password : <br><input type="password" name="Password">    </div>
    <div>Change Password On Log In : <br><input type="checkbox" name="ChangePasswordOnLogIn"  <?php if($Employee->ChangePasswordOnLogIn){echo "Checked";}else{echo "";} ?>></div>

   <input type="submit" value="Save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>