<?php
    include('header.php');
?>
<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<div class="view_data">
   <a class="backlink" href="claimtype.php?Id=<?php echo $_GET['Id']; ?>">back</a><br/><br/>
<h3>New Claim type</h3>
<div class="form_add">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmAddClaimType").validationEngine();
        });
    </script>
<form action="processnewclaimtype.php" method="POST" name="frmAddClaimType" id="frmAddClaimType">
    <div>Code : <br><input class="validate[required]" type="text" name="Code">    </div>
    <div>Name : <br><input class="validate[required]" type="text" name="Name">    </div>
    <div>IsActive : <br><input type="checkbox" name="IsActive">    </div>

   <input type="submit" value="save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>