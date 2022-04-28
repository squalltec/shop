<?php
session_start();
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];

$fromdateget='1-'.$_POST['fromdate'];
$fromdate=date("n", strtotime($fromdateget));
$showdate=date("m-Y", strtotime($fromdateget));

$sqlmonthlytotal="SELECT SUM(`total`) AS `nettotal` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND MONTH(`orderdate`)='$fromdate'";
$resultmonthlytotal=$conn->query($sqlmonthlytotal);
$rowmonthlytotal=$resultmonthlytotal->fetch_assoc();

$sqlhighestsale="SELECT SUM(`total`) AS `saletotal`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `acceptstatus`=1 AND `status`=1 AND MONTH(`orderdate`)='$fromdate' GROUP BY `tbl_customer_idtbl_customer` ORDER BY `saletotal` DESC LIMIT 11";
$resulthighestsale=$conn->query($sqlhighestsale);

?>
<div class="row">
    <div class="col">
        <table class="table table-striped table-bordered table-sm" id="tablecommission">
            <thead>
                <tr>
                    <th>Month</th>
                    <th class="text-right">Monthly Total</th>
                    <th>Customer</th>
                    <th>Ref Code</th>
                    <th class="text-right">Sale Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($rowhighestsale=$resulthighestsale->fetch_assoc()){ 
                    $customerID=$rowhighestsale['tbl_customer_idtbl_customer'];

                    $sqlcustomer="SELECT `firstname`, `lastname`, `refcode` FROM `tbl_customer` WHERE `status`=1 AND `idtbl_customer`='$customerID'";
                    $resultcustomer=$conn->query($sqlcustomer);
                    $rowcustomer=$resultcustomer->fetch_assoc();
                ?>
                <tr>
                    <td><?php echo $showdate; ?></td>
                    <td class="text-right"><?php echo number_format($rowmonthlytotal['nettotal'], 2); ?></td>
                    <td><?php echo $rowcustomer['firstname'].' '.$rowcustomer['lastname'] ?></td>
                    <td><?php echo $rowcustomer['refcode']; ?></td>
                    <td class="text-right"><?php echo number_format($rowhighestsale['saletotal'], 2); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>