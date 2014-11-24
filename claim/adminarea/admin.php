<?php
    include('header.php');
?>
<div class="view_data">
<h3>List of admin</h3>
<a href="newadmin.php">add new</a>
<table id="datatable" class="display">
   <thead>
       <tr>
            <th>User Name</th>
            <th>Is Active</th>
            <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('../classes/Helper.php');
           include_once('../classes/Admin.php');
           include_once('../classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $Admins = Admin::LoadCollection($Conn);
           foreach($Admins as $Admin){ ?>
       <tr>
                <td><?php echo $Admin->UserName; ?></td>
                <td><?php echo Helper::getBooleanTextValue($Admin->IsActive); ?></td>
               <td>
                   <div>
                       <a href="viewadmin.php?Id=<?php echo $Admin->get_Id(); ?>">view</a>
                       <a href="processdeleteadmin.php?Id=<?php echo $Admin->get_Id(); ?>">delete</a>
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