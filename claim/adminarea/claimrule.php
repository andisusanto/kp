<?php
    include('header.php');
?><div class="view_data">
<h3>List of claimrule</h3>
<a href="newclaimrule.php">Add New</a>

<table id="datatable" class="display">
   <thead>
       <tr>
            <th>ClaimType</th>
            <th>Grade</th>
            <th>MaxAmount</th>
            <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('../classes/Helper.php');
           include_once('../classes/ClaimRule.php');
           include_once('../classes/Grade.php');
           include_once('../classes/GlobalFunction.php');
           include_once('../classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $ClaimRules = ClaimRule::LoadCollection($Conn, '1=1', 'Id ASC');
           foreach($ClaimRules as $ClaimRule){ ?>
       <tr>
                <td><?php $Employee = Employee::GetObjectByKey($Conn,$ClaimRule->Employee);  echo $Employee->Name; ?></td>
                <td><?php $Grade = Grade::GetObjectByKey($Conn,$ClaimRule->Grade);  echo $Grade->Name; ?></td>
                <td><?php echo GlobalFunction::getIndonesianMoneyString($ClaimRule->MaxAmount); ?></td>

               <td>
                   <div>
                       <a href="viewclaimrule.php?Id=<?php echo $ClaimRule->get_Id(); ?>">View</a>
                       <a href="processdeleteclaimrule.php?Id=<?php echo $ClaimRule->get_Id(); ?>">Delete</a>
                   </div>
               </td>
       </tr>
           <?php } ?>
   </tbody>
</table>
</div>
<?php
    include('footer.php');
?>