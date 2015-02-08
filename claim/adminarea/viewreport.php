<?php
    include('checklogin.php');
?>
<?php
    include_once('../classes/AdminInbox.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Report</title>
    <link rel="stylesheet" type="text/css" href="css/report.css">
  </head>
  <body>

<?php
    include_once('../classes/Connection.php');
    include_once('../classes/GlobalFunction.php');
    $Conn = Connection::get_DefaultConnection();
    $orderString = $_POST['Order'] == 1 ? 'Employee, Travel' : 'Travel, Employee';
    $filterEmployee = $_POST['Employee'] > 0 ? "AND Employee = '".$_POST['Employee']."'
                                            " : '';
    $filterTravel = $_POST['Travel'] > 0 ? "AND Travel = '".$_POST['Travel']."'
                                            " : '';
    $query =
        "SELECT
	        Employee.Name AS Employee,
	        Travel.Name AS Travel,
	        ClaimTransaction.SubmissionNote AS Note,
	        ClaimTransaction.ClaimDate,
	        ClaimTransaction.ProcessedDate,
	        SUM(ClaimTransactionDetail.Amount) AS ClaimAmount
        FROM
	        `ClaimTransaction`
	        INNER JOIN `ClaimTransactionDetail` ON ClaimTransactionDetail.ClaimTransaction = ClaimTransaction.Id
	        INNER JOIN `Employee` ON ClaimTransaction.Employee = Employee.Id
	        INNER JOIN `Travel` ON ClaimTransaction.Travel = Travel.Id
        WHERE
	        ClaimTransaction.Status = 2
	        AND ClaimTransaction.ProcessedDate >= '".$_POST['StartDate']."'
	        AND ClaimTransaction.ProcessedDate <= '".$_POST['UntilDate']."'
            ".$filterEmployee.$filterTravel.
        "GROUP BY
	        Employee.Name,
	        Travel.Name,
	        ClaimTransaction.SubmissionNote,
	        ClaimTransaction.ClaimDate,
	        ClaimTransaction.ProcessedDate
        ORDER BY
        ".$orderString;
    if ($result = $Conn->query($query)){
            $total = 0.0;
            ?>
            <table cellspacing="0">
                <thead>
                        <tr>
                            <th colspan="6">
                                <p>
                                    <span style="font-size: 30px; font-weight: bold; text-decoration: underline">Claim Report By Period</span><br />
                                    <span style="font-size: 18px; font-style: italic;">Period: <?php echo date('d-M-Y',strtotime($_POST['StartDate'])); ?> - <?php echo date('d-M-Y',strtotime($_POST['UntilDate'])); ?></span>
                                </p>    
                            </th>
                        </tr>
                      
                        <tr class="tableheader">
                            <td style="width:10%">Employee</td>
                            <td style="width:13%">Travel</td>
                            <td style="width:10%">Claim Date</td>
                            <td style="width:45%">Note</td>
                            <td style="width:10%">Processed Date</td>
                            <td style="width:12%">Claim Amount</td>
                        </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $result->fetch_array())
                {
                $total += $row['ClaimAmount'];
                ?>
                    <tr>
                        <td><?php echo $row['Employee']; ?></td>
                        <td><?php echo $row['Travel']; ?></td>
                        <td><?php echo $row['ClaimDate']; ?></td>
                        <td><?php echo $row['Note']; ?></td>
                        <td><?php echo $row['ProcessedDate']; ?></td>
                        <td><?php echo GlobalFunction::getIndonesianMoneyString($row['ClaimAmount']); ?></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">GRAND TOTAL</td>
                        <td><?php echo GlobalFunction::getIndonesianMoneyString($total); ?></td>
                    </tr>
                </tfoot>
            </table>
            <?php
       }
       else
       {
           throw new InvalidQueryException;
       }
?>
</body>
</html>