<?php
    include('header.php');
?><div class="view_data">
<h3>List of employee</h3>
<a href="newemployee.php">Add New</a>

<table id="datatable" class="display">
   <thead>
       <tr>
            <th>Code</th>
            <th>Name</th>
            <th>User Name</th>
            <th>Is Active</th>
            <th>Change Password On Log In</th>

           <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('../classes/Helper.php');
           include_once('../classes/Employee.php');
           include_once('../classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $Employees = Employee::LoadCollection($Conn);
           foreach($Employees as $Employee){ ?>
       <tr>
                <td><?php echo $Employee->Code; ?></td>
                <td><?php echo $Employee->Name; ?></td>
                <td><?php echo $Employee->UserName; ?></td>
                <td><?php echo Helper::getBooleanTextValue($Employee->IsActive); ?></td>
                <td><?php echo Helper::getBooleanTextValue($Employee->ChangePasswordOnLogIn); ?></td>

               <td>
                   <div>
                       <a href="viewemployee.php?Id=<?php echo $Employee->get_Id(); ?>">View</a>
                       <a href="processdeleteemployee.php?Id=<?php echo $Employee->get_Id(); ?>">Delete</a>
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