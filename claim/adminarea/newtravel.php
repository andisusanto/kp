<?php
    include('header.php');
?>
<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>

<div class="view_data">
   <a class="backlink" href="travel.php?Id=<?php echo $_GET['Id']; ?>">back</a><br/><br/>
<h3>New Travel</h3>
<div class="form_add">
    <script type="text/javascript">
            $(document).ready(function () {
                $("#frmAddTravel").validationEngine();
            });
    </script>
<form action="processnewtravel.php" method="POST" name="frmAddTravel" id="frmAddTravel">
    <div>Name : <br><input type="text" class="validate[required]" name="Name">    </div>
    <div>Start Date : <br><input class="date validate[required]" type="text" name="StartDate">    </div>
    <div>Until Date : <br><input class="date validate[required]" type="text" name="UntilDate">    </div>
    <div>Closed : <br><input type="checkbox" name="Closed">    </div>

   <input type="submit" value="save">
</form>
</div>
</div>
<?php
    include('footer.php');
?>