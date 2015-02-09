<?php
    include('header.php');
?>
<div class="view_data">
<h3>List of grade</h3>
<a href="newgrade.php">Add New</a>

<table id="datatable" class="display">
   <thead>
       <tr>
            <th>Name</th>
           <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('../classes/Helper.php');
           include_once('../classes/Grade.php');
           include_once('../classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $Grades = Grade::LoadCollection($Conn);
           foreach($Grades as $Grade){ ?>
       <tr>
                <td><?php echo $Grade->Name; ?></td>

               <td>
                   <div>
                       <a href="viewgrade.php?Id=<?php echo $Grade->get_Id(); ?>">View</a>
                       <a href="processdeletegrade.php?Id=<?php echo $Grade->get_Id(); ?>">Delete</a>
                   </div>
               </td>
       </tr>
           <?php } ?>
   </tbody>
</table></div>
<?php
    include('footer.php');
?>