<?php
require_once('../../connection/db.php');

ini_set('max_execution_time', 3600); //3600 seconds = 60 minutes

$fromdate='01-05-2021';
$todate='18-05-2021';
$customer='';

$i=1;

// $data='';
// $data.='{"data": [';

if($customer==''){
    $sqlcustomerlist="SELECT `firstname`, `lastname`, `refcode`, `idtbl_customer` FROM `tbl_customer` WHERE `status`=1 ORDER BY idtbl_customer";
    $resultcustomerlist=$conn->query($sqlcustomerlist);
}
else{
    $sqlcustomerlist="SELECT `firstname`, `lastname`, `refcode`, `idtbl_customer` FROM `tbl_customer` WHERE `status`=1 AND `idtbl_customer`='$customer'";
    $resultcustomerlist=$conn->query($sqlcustomerlist);
}

$totalrows=$resultcustomerlist->num_rows;

while($rowcustomerlist=$resultcustomerlist->fetch_assoc()){ 
    $customerrefcode=$rowcustomerlist['refcode'];
    $customerID=$rowcustomerlist['idtbl_customer'];

    $sqltwolvl="SELECT SUM(`total`)*15/100 AS `totaltwo` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level2`='$customerrefcode' AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
    $resulttwolvl=$conn->query($sqltwolvl);
    $rowtwolvl=$resulttwolvl->fetch_assoc();

    $sqlthreelvl="SELECT SUM(`total`)*5/100 AS `totalthree` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level3`='$customerrefcode' AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
    $resultthreelvl=$conn->query($sqlthreelvl);
    $rowthreelvl=$resultthreelvl->fetch_assoc();

    $sqlfourlvl="SELECT SUM(`total`)*5/100 AS `totalfour` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level4`='$customerrefcode' AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
    $resultfourlvl=$conn->query($sqlfourlvl);
    $rowfourlvl=$resultfourlvl->fetch_assoc();

    $sqlfivelvl="SELECT SUM(`total`)*2.5/100 AS `totalfive` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level5`='$customerrefcode' AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
    $resultfivelvl=$conn->query($sqlfivelvl);
    $rowfivelvl=$resultfivelvl->fetch_assoc();

    $sqlsixlvl="SELECT SUM(`total`)*2.5/100 AS `totalsix` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level6`='$customerrefcode' AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
    $resultsixlvl=$conn->query($sqlsixlvl);
    $rowsixlvl=$resultsixlvl->fetch_assoc();

    $sqldropship="SELECT SUM(`discount`) AS `discount` FROM `tbl_order` WHERE `orderdate` BETWEEN '$fromdate' AND '$todate' AND `acceptstatus`='1' AND `status`='1' AND `tbl_customer_idtbl_customer`='$customerID' AND `dropdiscountstatus`='1'";
    $resultdropship=$conn->query($sqldropship);
    $rowdropship=$resultdropship->fetch_assoc();

    $totalcom=$rowtwolvl['totaltwo']+$rowthreelvl['totalthree']+$rowfourlvl['totalfour']+$rowfivelvl['totalfive']+$rowsixlvl['totalsix']+$rowdropship['discount'];

    $sqlbank="SELECT * FROM `tbl_customer_bank` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1";
    $resultbank=$conn->query($sqlbank);
    $rowbank=$resultbank->fetch_assoc();

    if($totalcom>0){
        if($i>1){
            $data.=',';
        }
        $data.='{
            "count": "'.$i.'",
            "name": "'.$rowcustomerlist['firstname'].' '.$rowcustomerlist['lastname'].'",
            "level2": "'.number_format($rowtwolvl['totaltwo'], 2).'",
            "level3": "'.number_format($rowthreelvl['totalthree'], 2).'",
            "level4": "'.number_format($rowfourlvl['totalfour'], 2).'",
            "level5": "'.number_format($rowfivelvl['totalfive'], 2).'",
            "level6": "'.number_format($rowsixlvl['totalsix'], 2).'",
            "drop": "'.number_format($rowdropship['discount'], 2).'",
            "total": "'.number_format($totalcom, 2).'",
            "account": "'.sprintf('%012d', $rowbank['accountno']).'",
            "accname": "'.$rowbank['accountname'].'",
            "bank": "'.$rowbank['bank'].'",
            "bankcode": "'.$rowbank['bankcode'].'",
            "branch": "'.$rowbank['branch'].'",
            "branchcode": "'.$rowbank['branchcode'].'",
            "banktotal": "'.sprintf('%012d', number_format((float)$totalcom, 2, '', '')).'"
        }';
    }
    $i++;

    echo $customerID.'--'.$customerrefcode.'=='.$rowtwolvl['totaltwo'].'<br>';
}
// $data.=']}';

// echo $_GET['callback']."(".$data.");";;
?>
