<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
?>
<?php
    include_once('classes/ClaimTransaction.php');
    include_once('classes/Travel.php');
    include_once('classes/Connection.php');
    $employeeId = $_SESSION['CurrentEmployeeId'];
    $Conn = Connection::get_DefaultConnection();
    $ClaimTransactions = ClaimTransaction::LoadCollection($Conn,"Employee = ".$employeeId, "ClaimDate DESC");
?>

<?php $title = 'My Claim History';?>
<?php include('header.php');?>
<div class="view_data">
<h3>History</h3>
      <table id="datatable" class="display">
        <thead>
            <tr>
                <th>Travel</th>
                <th>Claim Date</th>
                <th>Status</th>
                <th>Submission Note</th>
                <th>Approval Note</th>
                <th>Rejection Note</th>
                <th>Action</th>
            </tr>
        </thead>
          <tbody>
              <?php
                  foreach($ClaimTransactions as $claimTransaction){
                      $Id = $claimTransaction->get_Id();
              ?>
              <tr>
                  <td><?php $travel = Travel::GetObjectByKey($Conn,$claimTransaction->Travel); echo $travel->Name;?></td>
                  <td><?php if($claimTransaction->ClaimDate != strtotime('0000-00-00 00:00:00')) echo date('Y-M-d',$claimTransaction->ClaimDate);?></td>
                  <td><?php echo $claimTransaction->getStatusText();?></td>
                  <td><?php echo $claimTransaction->SubmissionNote;?></td>
                  <td><?php echo $claimTransaction->ApprovalNote;?></td>
                  <td><?php echo $claimTransaction->RejectionNote;?></td>
                  <td><a href="viewclaim.php?Id=<?php echo $Id;?>">View</a>
                      <?php if($claimTransaction->Status ==0){ ?>
                        <a href="processdeleteclaimtransaction.php?Id=<?php echo $Id;?>">Delete</a>
                        <a href="submitclaimtransaction.php?Id=<?php echo $Id;?>">Submit</a>
                      <?php
                            }
                            else
                            {
                                if($claimTransaction->Status==1){
                                ?>
                                    <a href="cancelclaimtransaction.php?Id=<?php echo $Id;?>">Cancel</a>
                                <?php
                                }
                            }
                      ?>
                  </td>
              </tr>
              <?php
                  }
              ?>
          </tbody>
      </table>
</div>
<?php include('footer.php');?>