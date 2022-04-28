<?php
require_once('../../connection/db.php');

ini_set('max_execution_time', 3600); //3600 seconds = 60 minutes

$fromdate=date("Y-m-d", strtotime($_POST['fromdate']));
$todate=date("Y-m-d", strtotime($_POST['todate']));
$customer=$_POST['customer'];

if(!empty($customer)){
    $queryconcat=" IN (SELECT `refcode` FROM `tbl_customer` WHERE `status`=1 AND `tbl_customer_idtbl_customer`='".$customer."')";
}
else{
    $queryconcat=" IN (SELECT `refcode` FROM `tbl_customer` WHERE `status`=1 GROUP BY `tbl_customer_idtbl_customer`)";
}

$sqltest="SELECT SUM(`total`)*15/100 AS `totaltwo`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level2`".$queryconcat." AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate' GROUP BY `tbl_customer_idtbl_customer`";
$resulttest=$conn->query($sqltest);
while($rowtest=$resulttest->fetch_assoc()){
    $commissionarraytwo[]=$rowtest['tbl_customer_idtbl_customer'].'='.$rowtest['totaltwo'];
}

$sqltestthree="SELECT SUM(`total`)*5/100 AS `totalthree`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level3`".$queryconcat." AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate' GROUP BY `tbl_customer_idtbl_customer`";
$resulttestthree=$conn->query($sqltestthree);
while($rowtestthree=$resulttestthree->fetch_assoc()){
    $commissionarraythree[]=$rowtestthree['tbl_customer_idtbl_customer'].'='.$rowtestthree['totalthree'];
}

$sqltestfour="SELECT SUM(`total`)*5/100 AS `totalfour`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level4`".$queryconcat." AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate' GROUP BY `tbl_customer_idtbl_customer`";
$resulttestfour=$conn->query($sqltestfour);
while($rowtestfour=$resulttestfour->fetch_assoc()){
    $commissionarrayfour[]=$rowtestfour['tbl_customer_idtbl_customer'].'='.$rowtestfour['totalfour'];
}

$sqltestfive="SELECT SUM(`total`)*5/100 AS `totalfive`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level5`".$queryconcat." AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate' GROUP BY `tbl_customer_idtbl_customer`";
$resulttestfive=$conn->query($sqltestfive);
while($rowtestfive=$resulttestfive->fetch_assoc()){
    $commissionarrayfive[]=$rowtestfive['tbl_customer_idtbl_customer'].'='.$rowtestfive['totalfive'];
}

$sqltestsix="SELECT SUM(`total`)*5/100 AS `totalsix`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level6`".$queryconcat." AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate' GROUP BY `tbl_customer_idtbl_customer`";
$resulttestsix=$conn->query($sqltestsix);
while($rowtestsix=$resulttestsix->fetch_assoc()){
    $commissionarraysix[]=$rowtestsix['tbl_customer_idtbl_customer'].'='.$rowtestsix['totalsix'];
}

$obj=new stdClass();
$obj->leveltwocom=$commissionarraytwo;
$obj->levelthreecom=$commissionarraythree;
$obj->levelfourcom=$commissionarrayfour;
$obj->levelfivecom=$commissionarrayfive;
$obj->levelsixcom=$commissionarraysix;

echo json_encode($obj);