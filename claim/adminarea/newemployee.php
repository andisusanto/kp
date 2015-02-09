<?php
    include('header.php');
?>
<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();

?>
<div class="view_data">
   <a class="backlink" href="employee.php?Id=<?php echo $_GET['Id']; ?>">Back</a><br/><br/>
<h3>New Employee</h3>
<div class="form_add">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmAddEmployee").validationEngine();
        });
    </script>
<form action="processnewemployee.php" method="POST" name="frmAddEmployee" id="frmAddEmployee">
    <div>Code : <br><input class="validate[required]" type="text" name="Code">    </div>
    <div>Name : <br><input class="validate[required]" type="text" name="Name">    </div>
    <div>Grade : <br>
    <select class="validate[required]" name="Grade">
       <?php
           include_once('../classes/Grade.php');
           $Grades = Grade::LoadCollection($Conn);
           foreach ($Grades as $Grade)
           {
           ?>
               <option value=" <?php echo $Grade->get_Id();?>"> <?php echo $Grade->Name;?></option>
           <?php
           }
           ?>
       ?>
       </select>
    </div>
    <div>Is Active : <br><input type="checkbox" name="IsActive">    </div>
    <div>User Name : <br><input class="validate[required]" type="text" name="UserName">    </div>
    <div>Password : <br><input class="validate[required]" type="password" name="Password">    </div>
    <div>Change Password On Log In : <br><input type="checkbox" name="ChangePasswordOnLogIn">    </div>

   <input type="submit" value="Save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>