<?php
session_start();
require_once('../../connection/db.php');

ini_set('max_execution_time', 3600); //3600 seconds = 60 minutes

$userID=$_SESSION['userid'];

// $fromdate=date("Y-m-d", strtotime($_POST['fromdate']));
// $todate=date("Y-m-d", strtotime($_POST['todate']));
// $customer=$_POST['customer'];
// $limit=$_POST["limit"];
// $start=$_POST["start"];
// $next=$start+$limit;
$fromdateget=$_POST['fromdate'].'-1';
$fromdate=date("n", strtotime($fromdateget));
$fromyear=date("Y", strtotime($fromdateget));
$showdate=date("m-Y", strtotime($fromdateget));

$paymonth=date("Y M", strtotime($fromdateget));
$paiddate=date("ym").'05';

if(empty($customer)){
    $sqlcustomercom="SELECT `u`.`customerid`,`u`.`lvl2totcom`,`u`.`lvl3totcom`,`u`.`lvl4totcom`,`u`.`lvl5totcom`,`u`.`lvl6totcom`,`u`.`lvldrop`,`u`.`returnprice`,`ua`.`firstname`,`ua`.`lastname`,`ub`.`accountname`,`ub`.`accountno`,`ub`.`bankcode`,`ub`.`branchcode`,`ub`.`bank`,`ub`.`branch` FROM `tbl_customer_monthly_commission` AS `u` LEFT JOIN `tbl_customer` AS `ua` ON `ua`.`idtbl_customer` = `u`.`customerid` LEFT JOIN `tbl_customer_bank` AS `ub` ON `ub`.`tbl_customer_idtbl_customer` = `u`.`customerid` WHERE `u`.`status` = 1 AND MONTH(`u`.`month`)='$fromdate' AND YEAR(`u`.`month`)='$fromyear'";
    $resultcustomercom=$conn->query($sqlcustomercom);
}
else{
    $sqlcustomercom="SELECT `ui`.`customerid`,`ua`.`firstname`,`ua`.`lastname`,`u`.`lvl2totcom`,`ub`.`lvl3totcom`,`uc`.`lvl4totcom`,`ud`.`lvl5totcom`,`ue`.`lvl6totcom`,`uf`.`lvldrop`,`ug`.`returnprice`,`uh`.`accountname`,`uh`.`accountno`,`uh`.`bankcode`,`uh`.`branchcode`,`uh`.`bank`,`uh`.`branch`FROM (SELECT`customerid`,`status` FROM`tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' GROUP BY `customerid` ORDER BY`customerid` ASC) `ui` LEFT JOIN `tbl_customer` AS `ua` ON `ua`.`idtbl_customer` = `ui`.`customerid` LEFT JOIN (SELECT`customerid`,`level`,SUM(`commission`) AS `lvl2totcom`,`status` FROM`tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level` = 2 GROUP BY `customerid` ORDER BY`customerid` ASC) `u` ON `u`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl3totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level` = 3 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ub` ON `ub`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl4totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level` = 4 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `uc` ON `uc`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl5totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level` = 5 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ud` ON `ud`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl6totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level` = 6 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ue` ON `ue`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvldrop`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level` = 0 GROUP BY `customerid`
    ORDER BY `customerid` ASC) AS `uf` ON `uf`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT SUM(`returnprice`) AS `returnprice`,`tbl_customer_idtbl_customer` FROM `tbl_order_return` WHERE `status` = 1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' GROUP BY `tbl_customer_idtbl_customer`) AS `ug` ON `ug`.`tbl_customer_idtbl_customer` = `ui`.`customerid` LEFT JOIN `tbl_customer_bank` AS `uh` ON `uh`.`tbl_customer_idtbl_customer` = `ui`.`customerid` WHERE `ui`.`status` = '1' AND `ui`.`customerid`='$customer' LIMIT 1";
    $resultcustomercom=$conn->query($sqlcustomercom);
}

$loadlist=array();

if($resultcustomercom->num_rows>0){
    while($rowcustomercom=$resultcustomercom->fetch_assoc()){
        $accountname=str_replace('.', '', $rowcustomercom['accountname']);
        $accountname=str_replace("'", '`', $accountname);
        $accountname=preg_replace("/(?![A-Z a-z 0-9])./", "", $accountname);

        $strlength=strlen($accountname);
        if($strlength<20){
            $accountname=str_pad($accountname, 20, ' ');
        }
        else{
            $accountname=substr($accountname, 0, 20);
        }

        $accountname=strtoupper($accountname);

        $bankname=preg_replace("/(?![A-Z a-z 0-9])./", "", $rowcustomercom['bank']);
        $bankname=str_replace("'", '`', $bankname);

        $branchname=preg_replace("/(?![A-Z a-z 0-9])./", "", $rowcustomercom['branch']);
        $branchname=str_replace("'", '`', $branchname);

        $firstname=preg_replace("/(?![A-Z a-z 0-9])./", "", $rowcustomercom['firstname']);
        $firstname=str_replace("'", '`', $firstname);

        $lastname=preg_replace("/(?![A-Z a-z 0-9])./", "", $rowcustomercom['lastname']);
        $lastname=str_replace("'", '`', $lastname);

        if($rowcustomercom['lvl2totcom']!=null){$lvl2com=$rowcustomercom['lvl2totcom'];}else{$lvl2com=0;}
        if($rowcustomercom['lvl3totcom']!=null){$lvl3com=$rowcustomercom['lvl3totcom'];}else{$lvl3com=0;}
        if($rowcustomercom['lvl4totcom']!=null){$lvl4com=$rowcustomercom['lvl4totcom'];}else{$lvl4com=0;}
        if($rowcustomercom['lvl5totcom']!=null){$lvl5com=$rowcustomercom['lvl5totcom'];}else{$lvl5com=0;}
        if($rowcustomercom['lvl6totcom']!=null){$lvl6com=$rowcustomercom['lvl6totcom'];}else{$lvl6com=0;}
        if($rowcustomercom['lvldrop']!=null){$lvldrop=$rowcustomercom['lvldrop'];}else{$lvldrop=0;}
        if($rowcustomercom['returnprice']!=null){$returnprice=$rowcustomercom['returnprice'];}else{$returnprice=0;}
        $bankcode=$rowcustomercom['bankcode'];
        $branchcode=$rowcustomercom['branchcode'];

        $nettotal=($lvl2com+$lvl3com+$lvl4com+$lvl5com+$lvl6com+$lvldrop)-($returnprice+15);

        if($rowcustomercom['accountno']!=null){
            $accountno=str_replace('-', '', $rowcustomercom['accountno']);
            $accountno=str_replace('.', '', $accountno);
            $accountno=str_replace(' ', '', $accountno);
            $accountno='000000000000'.$accountno;
        }
        else{
            $accountno='000000000000';
        }

        $accountno=substr($accountno, -12);

        $objcom=new stdClass();
        $objcom->customerid=$rowcustomercom['customerid'];
        $objcom->name=$firstname.' '.$lastname;
        $objcom->account=$accountno;
        $objcom->accname=$accountname;
        $objcom->bank=$bankname;
        $objcom->bankcode=sprintf('%04d', $rowcustomercom['bankcode']);
        $objcom->branch=$branchname;
        $objcom->branchcode=sprintf('%03d', $rowcustomercom['branchcode']);
        $objcom->paymonth=$paymonth;
        $objcom->paiddate=$paiddate;

        $objcom->level2=number_format($lvl2com,2);
        $objcom->level3=number_format($lvl3com,2);
        $objcom->level4=number_format($lvl4com,2);
        $objcom->level5=number_format($lvl5com,2);
        $objcom->level6=number_format($lvl6com,2);
        $objcom->lvldrop=number_format($lvldrop,2);
        $objcom->returnprice=number_format($returnprice,2);

        $objcom->total=number_format($nettotal, 2);
        $objcom->banktotal=sprintf('%012d', number_format((float)$nettotal, 2, '', ''));

        array_push($loadlist, $objcom);
    }
}
?>
<table class="table table-striped table-bordered table-sm small nowrap" id="dataTable">
    <thead>
        <tr>
            <th nowrap>#</th>
            <th nowrap>Customer</th>
            <th nowrap class="text-right">Level 2</th>
            <th nowrap class="text-right">Level 3</th>
            <th nowrap class="text-right">Level 4</th>
            <th nowrap class="text-right">Level 5</th>
            <th nowrap class="text-right">Level 6</th>
            <th nowrap class="text-right table-danger">Drop Ship</th>
            <th nowrap class="text-right table-danger">Return</th>
            <th nowrap class="text-right">Total</th>
            <th nowrap class="text-left">Format 1</th>
            <th nowrap class="text-left">Bank Code</th>
            <th nowrap class="text-left">Branch Code</th>
            <th nowrap class="text-left">Account No</th>
            <th nowrap class="text-left">Name</th>
            <th nowrap class="text-left">Format 2</th>
            <th nowrap class="text-left">Format 3</th>
            <th nowrap class="text-left">Format 4</th>
            <th nowrap class="text-left">Format 5</th>
            <th nowrap class="text-left">Bank Total</th>
            <th nowrap class="text-left">Format 6</th>
            <th nowrap class="text-left">Format 7</th>
            <th nowrap class="text-left">Format 8</th>
            <th nowrap class="text-left">Format 9</th>
            <th nowrap class="text-left">Format 10</th>
            <th nowrap class="text-left">Format 11</th>
            <th nowrap class="text-left">Format 12</th>
            <th nowrap class="text-left">Format 13</th>
            <th nowrap class="text-left">Format 14</th>
            <th nowrap class="text-left">Bank</th>
            <th nowrap class="text-left">Branch</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    if(count($loadlist)>0){
        foreach($loadlist as $rowlist){
            if($rowlist->total>0 && $rowlist->account!='000000000000' && ctype_digit($rowlist->account)){
    ?>
    <tr>
        <td nowrap><?php echo $rowlist->customerid; ?></td>
        <td nowrap><?php echo $rowlist->name; ?></td>
        <td nowrap><?php echo $rowlist->level2; ?></td>
        <td nowrap><?php echo $rowlist->level3; ?></td>
        <td nowrap><?php echo $rowlist->level4; ?></td>
        <td nowrap><?php echo $rowlist->level5; ?></td>
        <td nowrap><?php echo $rowlist->level6; ?></td>
        <td nowrap><?php echo $rowlist->lvldrop; ?></td>
        <td nowrap><?php echo $rowlist->returnprice; ?></td>
        <td nowrap><?php echo $rowlist->total; ?></td>
        <td nowrap>0000</td>
        <td nowrap><?php echo $rowlist->bankcode; ?></td>
        <td nowrap><?php echo $rowlist->branchcode; ?></td>
        <td nowrap><?php echo $rowlist->account; ?></td>
        <td nowrap><?php echo $rowlist->accname; ?></td>
        <td nowrap>23</td>
        <td nowrap>00</td>
        <td nowrap>0</td>
        <td nowrap>000000</td>
        <td nowrap><?php echo $rowlist->banktotal; ?></td>
        <td nowrap>SLR</td>
        <td nowrap>7010</td>
        <td nowrap>055</td>
        <td nowrap>000086265609</td>
        <td nowrap><?php echo str_pad('herb line', 20, ' '); ?></td>
        <td nowrap><?php echo str_pad('SALEINSENTIVE', 15, ' '); ?></td>
        <td nowrap><?php echo str_pad($rowlist->paymonth, 15, ' '); ?></td>
        <td nowrap><?php echo $rowlist->paiddate; ?></td>
        <td nowrap>000000</td>
        <td nowrap><?php echo $rowlist->bank; ?></td>
        <td nowrap><?php echo $rowlist->branch; ?></td>
    </tr>
    <?php }}} ?>
    </tbody>
</table>
