<?php
    include('header.php');
?>
<div class="view_data">
<h3>List of travel</h3>
<a href="newtravel.php">Add New</a>

<table id="datatable" class="display">
   <thead>
       <tr>
            <th>Name</th>
            <th>Start Date</th>
            <th>Until Date</th>
            <th>Closed</th>

           <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('../classes/Helper.php');
           include_once('../classes/Travel.php');
           include_once('../classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $Travels = Travel::LoadCollection($Conn, '1=1', 'StartDate DESC');
           foreach($Travels as $Travel){ ?>
       <tr>
                <td><?php echo $Travel->Name; ?></td>
                <td><?php echo date('Y-M-d',$Travel->StartDate); ?></td>
                <td><?php echo date('Y-M-d',$Travel->UntilDate); ?></td>
                <td><?php echo Helper::getBooleanTextValue($Travel->Closed); ?></td>

               <td>
                   <div>
                       <a href="viewtravel.php?Id=<?php echo $Travel->get_Id(); ?>">View</a>
                       <a href="processdeletetravel.php?Id=<?php echo $Travel->get_Id(); ?>">Delete</a>
                       <?php
                       if($Travel->Closed)
                       {
                            ?>
                                <a href="processsettravelasopen.php?Id=<?php echo $Travel->get_Id(); ?>">Set as Open</a>
                            <?php
                       }
                       else
                       {
                            ?>
                                <a href="processsettravelasclose.php?Id=<?php echo $Travel->get_Id(); ?>">Set as Closed</a>
                            <?php
                       }
                       ?>
                   </div>
               </td>
       </tr>
           <?php } ?>
   </tbody>
</table></div>
<?php
    include('footer.php');
?>