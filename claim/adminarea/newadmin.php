<?php
    include('header.php');
?>
<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<div class="view_data">
   <a class="backlink" href="admin.php?Id=<?php echo $_GET['Id']; ?>">back</a><br/><br/>
<h3>New Admin</h3>
<div class="form_add">
    <script type="text/javascript">
            $(document).ready(function () {
                $("#frmAddAdmin").validationEngine();
            });
    </script>
<form action="processnewadmin.php" method="POST" name="frmAddAdmin" id="frmAddAdmin">
    <div>UserName : <br><input class="validate[required]" type="text" name="UserName">    </div>
    <div>Password : <br><input class="validate[required]" type="password" name="Password">    </div>
    <div>IsActive : <br><input type="checkbox" name="IsActive">    </div>

   <input type="submit" value="save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>