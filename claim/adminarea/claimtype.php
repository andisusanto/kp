<?php
    include('header.php');
?>
<?php
    include_once('../classes/Helper.php'); 
?>
<div class="view_data">
<h3>List of claim type</h3>
<a href="newclaimtype.php">Add New</a>
<table id="datatable" class="display">
   <thead>
       <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Is Active</th>

           <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('../classes/ClaimType.php');
           include_once('../classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $ClaimTypes = ClaimType::LoadCollection($Conn);
           foreach($ClaimTypes as $ClaimType){ ?>
       <tr>
                <td><?php echo $ClaimType->Code; ?></td>
                <td><?php echo $ClaimType->Name; ?></td>
                <td><?php echo Helper::getBooleanTextValue($ClaimType->IsActive); ?></td>

               <td>
                   <div>
                       <a href="viewclaimtype.php?Id=<?php echo $ClaimType->get_Id(); ?>">View</a>
                       <a href="processdeleteclaimtype.php?Id=<?php echo $ClaimType->get_Id(); ?>">Delete</a>
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