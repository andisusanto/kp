<?php
    include('header.php');
?>
<?php
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    include_once('../classes/Travel.php');
    include_once('../classes/Employee.php');
?>
<div class="view_data">
<h3>Fill report parameters</h3>
<div class="form_add">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmReport").validationEngine();
        });
    </script>
<form action="viewreport.php" method="POST" name="frmReport" id="frmReport">
    <div>Start Date : <br><input class="validate[required] date" type="text" name="StartDate" /></div>
    <div>Until Date : <br><input class="validate[required] date" type="text" name="UntilDate" /></div>
    <div>Travel : <br>
        <select name="Travel">
            <option value="0">ALL</option>
           <?php
               $Travels = Travel::LoadCollection($Conn);
               foreach ($Travels as $Travel) { ?>
                   <option value="<?php echo $Travel->get_Id();?>"> <?php echo $Travel->Name;?></option>
           <?php }?>
       </select>
    </div>
    <div>Employee : <br>
        <select name="Employee">
            <option value="0">ALL</option>
           <?php
               $Employees = Employee::LoadCollection($Conn);
               foreach ($Employees as $Employee) { ?>
                   <option value="<?php echo $Employee->get_Id();?>"> <?php echo $Employee->Name;?></option>
           <?php }?>
       </select>
    </div>
    <div>Order : <br>
        <select name="Order">
            <option value="1">Employee Then Travel</option>
            <option value="1">Travel Then Employee</option>
       </select>
    </div>
   <input type="submit" value="View Report">
</form>
</div>
</div>
<?php
    include('footer.php');
?>