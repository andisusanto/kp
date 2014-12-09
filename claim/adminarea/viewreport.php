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
            <table>
                <thead>
                    <tr>
                        <tr>
                            <td>Employee</td>
                            <td>Travel</td>
                            <td>Claim Date</td>
                            <td>Note</td>
                            <td>Processed Date</td>
                            <td>Claim Amount</td>
                        </tr>
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
                <?
                }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">TOTAL</td>
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