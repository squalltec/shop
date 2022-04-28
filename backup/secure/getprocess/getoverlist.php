<?php
session_start();
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];

$fromdate=date("Y-m-d", strtotime($_POST['fromdate']));
$todate=date("Y-m-d", strtotime($_POST['todate']));

$sqlcustomerlist="SELECT `firstname`, `lastname`, `refcode`, `idtbl_customer` FROM `tbl_customer` WHERE `status`=1";
$resultcustomerlist=$conn->query($sqlcustomerlist);
?>
<div class="row">
    <div class="col">
        <table class="table table-striped table-bordered table-sm" id="tablecommission">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Ref Code</th>
                    <th class="text-right">Sale Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($rowcustomerlist=$resultcustomerlist->fetch_assoc()){ 
                    $customerrefcode=$rowcustomerlist['refcode'];
                    $customerID=$rowcustomerlist['idtbl_customer'];

                    $sqltotalsale="SELECT SUM(`nettotal`) AS `nettotal` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer`='$customerID' AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
                    $resulttotalsale=$conn->query($sqltotalsale);
                    $rowtotalsale=$resulttotalsale->fetch_assoc();

                    if($rowtotalsale['nettotal']<1000 && $rowtotalsale['nettotal']>0){
                ?>
                <tr>
                    <td><?php echo $rowcustomerlist['firstname'].' '.$rowcustomerlist['lastname'] ?></td>
                    <td><?php echo $rowcustomerlist['refcode']; ?></td>
                    <td class="text-right"><?php echo number_format($rowtotalsale['nettotal'], 2); ?></td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>