<?php
    include('header.php');
?>
<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>

<div class="view_data">
   <a class="backlink" href="grade.php?Id=<?php echo $_GET['Id']; ?>">Back</a><br/><br/>
<h3>New Grade</h3>
<div class="form_add">
    <script type="text/javascript">
            $(document).ready(function () {
                $("#frmAddGrade").validationEngine();
            });
    </script>
<form action="processnewgrade.php" method="POST" name="frmAddGrade" id="frmAddGrade">
    <div>Name : <br><input type="text" class="validate[required]" name="Name">    </div>

   <input type="submit" value="Save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>