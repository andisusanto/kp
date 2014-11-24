<?php
    include('header.php');
?>
<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();

?>
<div class="view_data">
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
    <div>Is Active : <br><input type="checkbox" name="IsActive">    </div>
    <div>User Name : <br><input class="validate[required]" type="text" name="UserName">    </div>
    <div>Password : <br><input class="validate[required]" type="password" name="Password">    </div>
    <div>Change Password On Log In : <br><input type="checkbox" name="ChangePasswordOnLogIn">    </div>

   <input type="submit" value="save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>