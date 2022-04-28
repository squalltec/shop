<?php 
ini_set('max_execution_time', 6200); //3600 seconds = 60 minutes
require_once('../connection/db.php');

// $deleteuserprivilege="DELETE FROM `tbl_user_privilege` WHERE `tbl_user_idtbl_user` NOT IN (1,2)";
// $conn->query($deleteuserprivilege);

// $deleteuser="DELETE FROM `tbl_user` WHERE `idtbl_user` NOT IN (1,2)";
// $conn->query($deleteuser);

// 2021-02-06
// $insertmenu="INSERT INTO `tbl_menu_list`(`menu`, `status`) VALUES ('Order Commission Info', '1')";
// $conn->query($insertmenu);

//2021-02-10
// $updateaccout="UPDATE `tbl_user` SET `status`='1', `password`='827ccb0eea8a706c4c34a16891f84e7b' WHERE `idtbl_user`=64";
// $conn->query($updateaccout);

//2021-02-12
// $updateorder="UPDATE `tbl_order` SET `acceptstatus`='0', `paystatus`='0', `shipstatus`='0', `deliverystatus`='0', `status`='2' WHERE `idtbl_order`='29'";
// $conn->query($updateorder);

// $updateorderdetail="UPDATE `tbl_order_detail` SET `status`='3' WHERE `tbl_order_idtbl_order`='29'";
// $conn->query($updateorderdetail);

// $updateorderdelivery="UPDATE `tbl_order_delivery` SET `status`='3' WHERE `tbl_order_idtbl_order`='29'";
// $conn->query($updateorderdelivery);

// 2021-02-27
// $insertmenu="INSERT INTO `tbl_menu_list`(`menu`, `status`) VALUES ('Up Liner', '1')";
// $conn->query($insertmenu);

// 2021-03-04
// $sql="SELECT `firstname`, `lastname`, `refcode` FROM `tbl_customer` WHERE `idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level2`='HER036' AND `status`=1) AND `status`=1 AND `tbl_user_idtbl_user` IN (SELECT `idtbl_user` FROM `tbl_user` WHERE `status`=1 AND `tbl_user_type_idtbl_user_type`=4)";
// $result =$conn-> query($sql); 

// while($row = $result-> fetch_assoc()){
    
//     echo $row['firstname'].' '.$row['refcode'].'<br>';
// }
// $updatedatetime=date('Y-m-d h:i:s');

// $lvl1='';
// $lvl2='';
// $lvl3='';
// $lvl4='';
// $lvl5='';

// $sql="SELECT * FROM `tbl_cutomer_level` WHERE `tbl_customer_idtbl_customer` IN (SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='HER0924' AND `status`=1) AND `status`=1";
// $result =$conn-> query($sql); 
// while($row = $result-> fetch_assoc()){
//     $lvl1=$row['level1'];
//     $lvl2=$row['level2'];
//     $lvl3=$row['level3'];
//     $lvl4=$row['level4'];
//     $lvl5=$row['level5'];
// }

// $insertlevel="INSERT INTO `tbl_cutomer_level`(`level1`, `level2`, `level3`, `level4`, `level5`, `level6`, `status`, `updatedatetime`, `tbl_customer_idtbl_customer`, `tbl_user_idtbl_user`) VALUES ('HER0971','$lvl1','$lvl2','$lvl3','$lvl4','$lvl5','1','$updatedatetime','971','1004')";
// $conn->query($insertlevel);

// $updateorder="UPDATE `tbl_order` SET `tbl_customer_idtbl_customer`='460' WHERE `idtbl_order`=316";
// $conn->query($updateorder);

// $updatecustomer="UPDATE `tbl_customer` SET `email`='harithmanchanayake94@gmail.com', `firstname`='Harith', `lastname`='Manchanayake' WHERE `idtbl_customer`='462'";
// $conn->query($updatecustomer);

// $update="UPDATE `tbl_customer` SET `status`='3' WHERE `idtbl_customer`=471";
// $conn->query($update);

// 2021-03-05

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level2`='HER0112',`level3`='HER0111',`level4`='HER02',`level5`='HER01',`level6`='' WHERE `tbl_customer_idtbl_customer`='136'";
// $conn->query($updatelevel);

// 2021-04-05

// $updatecustomer="UPDATE `tbl_customer` SET `email`='thiliniwathsalav@gmail.com' WHERE `idtbl_customer`=971";
// $conn->query($updatecustomer);

// $sql="SELECT `idtbl_cutomer_level` FROM `tbl_cutomer_level` WHERE `tbl_customer_idtbl_customer`=1653";
// $result =$conn-> query($sql); 

// while($row = $result-> fetch_assoc()){
    
//     echo $row['idtbl_cutomer_level'].'<br>';
// }

// $updatelevel="UPDATE `tbl_customer` SET `status`='3' WHERE `idtbl_customer`=978";
// $conn->query($updatelevel);

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level2`='HER0971',`level3`='HER0924',`level4`='HER0647',`level5`='HER036',`level6`='HER026' WHERE `tbl_customer_idtbl_customer`='1653'";
// $conn->query($updatelevel);

// 2021-04-06

// $update="UPDATE `tbl_order` SET `status`='1' WHERE `idtbl_order`=1137";
// $conn->query($update);

//2021-04-24

// $fromdate='2021-04-01';
// $todate='2021-04-24';

// $i=1;

// $data='';
// $data.='{"data": [';

// $sqlcustomerlist="SELECT `firstname`, `lastname`, `refcode`, `idtbl_customer` FROM `tbl_customer` WHERE `status`=1";
// $resultcustomerlist=$conn->query($sqlcustomerlist);

// $totalrows=$resultcustomerlist->num_rows;

// while($rowcustomerlist=$resultcustomerlist->fetch_assoc()){ 
//     $customerrefcode=$rowcustomerlist['refcode'];
//     $customerID=$rowcustomerlist['idtbl_customer'];

//     $sqltwolvl="SELECT SUM(`total`)*15/100 AS `totaltwo` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level2`='$customerrefcode' AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
//     $resulttwolvl=$conn->query($sqltwolvl);
//     $rowtwolvl=$resulttwolvl->fetch_assoc();

//     $sqlthreelvl="SELECT SUM(`total`)*5/100 AS `totalthree` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level3`='$customerrefcode' AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
//     $resultthreelvl=$conn->query($sqlthreelvl);
//     $rowthreelvl=$resultthreelvl->fetch_assoc();

//     $sqlfourlvl="SELECT SUM(`total`)*5/100 AS `totalfour` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level4`='$customerrefcode' AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
//     $resultfourlvl=$conn->query($sqlfourlvl);
//     $rowfourlvl=$resultfourlvl->fetch_assoc();

//     $sqlfivelvl="SELECT SUM(`total`)*2.5/100 AS `totalfive` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level5`='$customerrefcode' AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
//     $resultfivelvl=$conn->query($sqlfivelvl);
//     $rowfivelvl=$resultfivelvl->fetch_assoc();

//     $sqlsixlvl="SELECT SUM(`total`)*2.5/100 AS `totalsix` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level6`='$customerrefcode' AND `status`=1) AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
//     $resultsixlvl=$conn->query($sqlsixlvl);
//     $rowsixlvl=$resultsixlvl->fetch_assoc();

//     $sqldropship="SELECT SUM(`discount`) AS `discount` FROM `tbl_order` WHERE `orderdate` BETWEEN '$fromdate' AND '$todate' AND `acceptstatus`='1' AND `status`='1' AND `tbl_customer_idtbl_customer`='$customerID' AND `dropdiscountstatus`='1'";
//     $resultdropship=$conn->query($sqldropship);
//     $rowdropship=$resultdropship->fetch_assoc();

//     $totalcom=$rowtwolvl['totaltwo']+$rowthreelvl['totalthree']+$rowfourlvl['totalfour']+$rowfivelvl['totalfive']+$rowsixlvl['totalsix']+$rowdropship['discount'];

//     $sqlbank="SELECT * FROM `tbl_customer_bank` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1";
//     $resultbank=$conn->query($sqlbank);
//     $rowbank=$resultbank->fetch_assoc();

//     if($totalcom>0){
//         if($i>1){
//             $data.=',';
//         }
//         $data.='{
//             "count": "'.$i.'",
//             "name": "'.$rowcustomerlist['firstname'].' '.$rowcustomerlist['lastname'].'",
//             "level2": "'.number_format($rowtwolvl['totaltwo'], 2).'",
//             "level3": "'.number_format($rowthreelvl['totalthree'], 2).'",
//             "level4": "'.number_format($rowfourlvl['totalfour'], 2).'",
//             "level5": "'.number_format($rowfivelvl['totalfive'], 2).'",
//             "level6": "'.number_format($rowsixlvl['totalsix'], 2).'",
//             "drop": "'.number_format($rowdropship['discount'], 2).'",
//             "account": "'.$rowbank['accountno'].'",
//             "accname": "'.$rowbank['accountname'].'",
//             "bank": "'.$rowbank['bank'].'",
//             "branch": "'.$rowbank['branch'].'"
//         }';
//     }
//     $i++;
// }
// $data.=']}';

// echo $data;

// $sqlsum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE MONTH(`orderdate`)=4 AND `status`=1";
// $resultsum=$conn->query($sqlsum);
// $rowsum=$resultsum->fetch_assoc();
// echo $rowsum['total'];

// 2021-05-18

// $update="UPDATE `tbl_order` SET `status`='1' WHERE `idtbl_order`=3171";
// $conn->query($update);

$updatedatetime=date('Y-m-d h:i:s');
$userID=1;

// $update="UPDATE `tbl_cutomer_commission` SET `status`='3' WHERE `idtbl_cutomer_commission`=31888";
// $conn->query($update);

// $sqlorder="SELECT `idtbl_order`, `orderdate`, `total`, `discount`, `dropdiscountstatus`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `idtbl_order` NOT IN (SELECT `orderid` FROM `tbl_cutomer_commission` GROUP BY `orderid`)";
// $resultorder=$conn->query($sqlorder);
// while($roworder=$resultorder->fetch_assoc()){
//     $cusID=$roworder['tbl_customer_idtbl_customer'];
//     $ordertotal=$roworder['total'];
//     $orderdate=$roworder['orderdate'];
//     $dropshipstatus=$roworder['dropdiscountstatus'];
//     $discount=$roworder['discount'];
//     $orderid=$roworder['idtbl_order'];

//     $sqlcuslevel="SELECT `level2`, `level3`, `level4`, `level5`, `level6` FROM `tbl_cutomer_level` WHERE `status`=1 AND `tbl_customer_idtbl_customer`='$cusID'";
//     $resultcuslevel=$conn->query($sqlcuslevel);
//     $rowcuslevel=$resultcuslevel->fetch_assoc();

//     $lvl2=$rowcuslevel['level2'];
//     $lvl3=$rowcuslevel['level3'];
//     $lvl4=$rowcuslevel['level4'];
//     $lvl5=$rowcuslevel['level5'];
//     $lvl6=$rowcuslevel['level6'];

//     if(!empty($lvl2)){
//         $sqlcuslvltwo="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl2'";
//         $resultcuslvltwo=$conn->query($sqlcuslvltwo);
//         $rowcuslvltwo=$resultcuslvltwo->fetch_assoc();

//         $lvltwocom=$ordertotal*15/100;
//         $lvltwocusid=$rowcuslvltwo['idtbl_customer'];

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$orderdate','$lvltwocusid','2','$lvltwocom','1','$updatedatetime','$userID')";
//         $conn->query($insertcommission);
//     }
//     else{
//         $lvltwocom=0;
//         $lvltwocusid=0;
//     }

//     if(!empty($lvl3)){
//         $sqlcuslvlthree="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl3'";
//         $resultcuslvlthree=$conn->query($sqlcuslvlthree);
//         $rowcuslvlthree=$resultcuslvlthree->fetch_assoc();

//         $lvlthreecom=$ordertotal*5/100;
//         $lvlthreecusid=$rowcuslvlthree['idtbl_customer'];

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$orderdate','$lvlthreecusid','3','$lvlthreecom','1','$updatedatetime','$userID')";
//         $conn->query($insertcommission);
//     }
//     else{
//         $lvlthreecom=0;
//         $lvlthreecusid=0;
//     }
    
//     if(!empty($lvl4)){
//         $sqlcuslvlfour="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl4'";
//         $resultcuslvlfour=$conn->query($sqlcuslvlfour);
//         $rowcuslvlfour=$resultcuslvlfour->fetch_assoc();

//         $lvlfourcom=$ordertotal*5/100;
//         $lvlfourcusid=$rowcuslvlfour['idtbl_customer'];

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$orderdate','$lvlfourcusid','4','$lvlfourcom','1','$updatedatetime','$userID')";
//         $conn->query($insertcommission);
//     }
//     else{
//         $lvlfourcom=0;
//         $lvlfourcusid=0;
//     }

//     if(!empty($lvl5)){
//         $sqlcuslvlfive="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl5'";
//         $resultcuslvlfive=$conn->query($sqlcuslvlfive);
//         $rowcuslvlfive=$resultcuslvlfive->fetch_assoc();

//         $lvlfivecom=$ordertotal*2.5/100;
//         $lvlfivecusid=$rowcuslvlfive['idtbl_customer'];

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$orderdate','$lvlfivecusid','5','$lvlfivecom','1','$updatedatetime','$userID')";
//         $conn->query($insertcommission);
//     }
//     else{
//         $lvlfivecom=0;
//         $lvlfivecusid=0;
//     }

//     if(!empty($lvl6)){
//         $sqlcuslvlsix="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl6'";
//         $resultcuslvlsix=$conn->query($sqlcuslvlsix);
//         $rowcuslvlsix=$resultcuslvlsix->fetch_assoc();

//         $lvlsixcom=$ordertotal*2.5/100;
//         $lvlsixcusid=$rowcuslvlsix['idtbl_customer'];

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$orderdate','$lvlsixcusid','6','$lvlsixcom','1','$updatedatetime','$userID')";
//         $conn->query($insertcommission);
//     }
//     else{
//         $lvlsixcom=0;
//         $lvlsixcusid=0;
//     }

//     if($dropshipstatus==1){
//         $dropshipcom=$discount;
//         $dropshipcusid=$cusID;

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$orderdate','$dropshipcusid','0','$dropshipcom','1','$updatedatetime','$userID')";
//         $conn->query($insertcommission);
//     }
//     else{
//         $dropshipcom=0;
//         $dropshipcusid=0;
//     }
// }

// $from='2021-04-01';
// $to='2021-04-30';

// $arraycuslist=array();

// $sqlcustomerlist="SELECT `level2`, `level3`, `level4`, `level5`, `level6` FROM `tbl_cutomer_level` WHERE `tbl_customer_idtbl_customer` IN (SELECT DISTINCT(`tbl_customer_idtbl_customer`) AS `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `idtbl_order` IN (SELECT `tbl_order_idtbl_order` FROM `tbl_commission` WHERE `status`=1) AND `status`=1 AND `orderdate` BETWEEN '$from' AND '$to') AND `status`=1";
// $resultcustomerlist=$conn->query($sqlcustomerlist);
// while($rowcustomerlist=$resultcustomerlist->fetch_assoc()){
//     $arraycuslist[]=$rowcustomerlist['level2'];
//     $arraycuslist[]=$rowcustomerlist['level3'];
//     $arraycuslist[]=$rowcustomerlist['level4'];
//     $arraycuslist[]=$rowcustomerlist['level5'];
//     $arraycuslist[]=$rowcustomerlist['level6'];
// }

// $arraycuslist=array_unique($arraycuslist);

// sort($arraycuslist, SORT_STRING);

// $clength = count($arraycuslist);
// for($x = 0; $x < $clength; $x++) {
//   echo $arraycuslist[$x];
//   echo "<br>";
// }

// $sqldropship="SELECT SUM(`dropship`) AS `dropship` FROM `tbl_commission` WHERE `dropshipcus`='2329' AND `status`=1 AND `orderdate` BETWEEN '$from' AND '$to'";
// $resultdropship=$conn->query($sqldropship);
// $rowdropship=$resultdropship->fetch_assoc();

// echo $rowdropship['dropship'];

//2021-05-23

// $sqllevlupdate="UPDATE `tbl_cutomer_level` SET `level4`='HER02',`level5`='HER01' WHERE `level3`='HER05853'";
// $conn->query($sqllevlupdate);

// 31-05-2021 01-06-2021

// $update="UPDATE `tbl_customer` SET `phone`='0775269929', `email`='dananjanirukshika04@gmail.com', `address`='25/2, Rajawella 2', `city`='Rajawella' WHERE `idtbl_customer`=1007";
// $conn->query($update);

// $updatebank="UPDATE `tbl_customer_bank` SET `bank`='BOC', `bankcode`='7010', `branch`='Digana', `branchcode`='273', `accountno`='84051034', `accountname`='R M D R Bandara' WHERE `tbl_customer_idtbl_customer`=1007";
// $conn->query($updatebank);

// 06-06-2021

// $update="DELETE FROM `tbl_user_codes` WHERE `status`=3";
// $conn->query($update);

//07-06-2021

// $update="UPDATE `tbl_customer` SET `phone`='0786577010' WHERE `idtbl_customer`=11908";
// $conn->query($update);

// 2021-06-15
// $insertmenu="UPDATE `tbl_menu_list` SET `menu`='Order Tracking' WHERE `idtbl_menu_list`=17";
// $conn->query($insertmenu);

// $updateorder="UPDATE `tbl_order` SET `status`='1' WHERE `idtbl_order`=5401";
// $conn->query($updateorder);

//2021-06-18
// $updatedatetime=date('Y-m-d h:i:s');
// $filename='city_zone.csv';

// $file = fopen($filename, 'r');
// $i=0;
// while (($line = fgetcsv($file)) !== FALSE) {
//     // print_r($line);
//     $city=$line[1];

//     $insert="INSERT INTO `tbl_city`(`city`, `status`, `updatedatetime`) VALUES ('$city','1','$updatedatetime')";
//     $conn->query($insert);
// }
// fclose($file);

//2021-06-18

// $updatedatetime=date('Y-m-d h:i:s');
// $userID=1;

// $sqlmem="SELECT `level1`, `updatedatetime`, `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `status`=1";
// $resultmem=$conn->query($sqlmem);
// while($rowmem=$resultmem->fetch_assoc()){
//     $customermainID=$rowmem['tbl_customer_idtbl_customer'];
//     $refcode=$rowmem['level1'];

//     $sqlcusjoin="SELECT `joindate` FROM `tbl_customer` WHERE `idtbl_customer`='$customermainID'";
//     $resultcusjoin=$conn->query($sqlcusjoin);
//     $rowcusjoin=$resultcusjoin->fetch_assoc();

//     $customerjoindate=date("Y-m-d", strtotime($rowcusjoin['joindate']));
//     $joindate=date("Y-m-d", strtotime($rowmem['updatedatetime']));
//     $next1date=date("Y-m-d", strtotime($joindate . ' +1 month'));
//     $next3date=date("Y-m-d", strtotime($joindate . ' +3 month'));

//     $lvl2saletot=0;
//     $lvl3saletot=0;
//     $lvl4saletot=0;
//     $lvl5saletot=0;
//     $lvl6saletot=0;
//     $lvl2completedate='';
//     $lvl3completedate='';
//     $lvl4completedate='';
//     $lvl5completedate='';
//     $lvl6completedate='';

//     $sqllvl2="SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level2`='$refcode' AND `status`=1 AND `updatedatetime` BETWEEN '$joindate' AND '$next1date'";
//     $resultlvl2=$conn->query($sqllvl2);
//     if($resultlvl2->num_rows>=15){
//         while($rowlvl2=$resultlvl2->fetch_assoc()){
//             if($lvl2saletot<45000){
//                 $customerID=$rowlvl2['tbl_customer_idtbl_customer'];

//                 $sqlordersum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$joindate' AND '$next1date'";
//                 $resultordersum=$conn->query($sqlordersum);
//                 $rowordersum=$resultordersum->fetch_assoc();

//                 $sqlorderdate="SELECT `orderdate` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 ORDER BY `idtbl_order` DESC LIMIT 1";
//                 $resultorderdate=$conn->query($sqlorderdate);
//                 $roworderdate=$resultorderdate->fetch_assoc();

//                 $lvl2saletot=$lvl2saletot+$rowordersum['total'];
//                 if($lvl2saletot>=45000){
//                     $lvl2completedate=$roworderdate['orderdate'];
//                 }
//             }
//         }
//     }
//     // echo $lvl2completedate.' - '.$lvl2saletot.'<br>';
//     if($lvl2saletot<45000){
//         $sqllvl2="SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level2`='$refcode' AND `status`=1 AND `updatedatetime` BETWEEN '$joindate' AND '$next3date'";
//         $resultlvl2=$conn->query($sqllvl2);
//         if($resultlvl2->num_rows>=5){
//             while($rowlvl2=$resultlvl2->fetch_assoc()){
//                 if($lvl2saletot<45000){
//                     $customerID=$rowlvl2['tbl_customer_idtbl_customer'];

//                     $sqlordersum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$joindate' AND '$next3date'";
//                     $resultordersum=$conn->query($sqlordersum);
//                     $rowordersum=$resultordersum->fetch_assoc();
//                     $sqlorderdate="SELECT `orderdate` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 ORDER BY `idtbl_order` DESC LIMIT 1";
//                     $resultorderdate=$conn->query($sqlorderdate);
//                     $roworderdate=$resultorderdate->fetch_assoc();

//                     $lvl2saletot=$lvl2saletot+$rowordersum['total'];
//                     if($lvl2saletot>=45000){
//                         $lvl2completedate=$roworderdate['orderdate'];
//                     }
//                 }
//             }
//         }
//     }
    
//     if(!empty($lvl2completedate)){
//         $insert="INSERT INTO `tbl_cutomer_position`(`joindate`, `promotedate`, `promotepositioncate`, `promoteposition`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_customer_idtbl_customer`) VALUES ('$customerjoindate','$lvl2completedate','1','Junior Team Leader','1','$updatedatetime','$userID','$customermainID')";
//         $conn->query($insert);
//     }

//     // echo $lvl2threemonth.'<br>';
//     if(!empty($lvl2completedate)){
//         $joindate=date("Y-m-d", strtotime($lvl2completedate));
//         $next1date=date("Y-m-d", strtotime($joindate . ' +1 month'));
//         $next3date=date("Y-m-d", strtotime($joindate . ' +3 month'));

//         $sqllvl3="SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level3`='$refcode' AND `status`=1 AND `updatedatetime` BETWEEN '$joindate' AND '$next1date'";
//         $resultlvl3=$conn->query($sqllvl3);
//         if($resultlvl3->num_rows>=75){
//             while($rowlvl3=$resultlvl3->fetch_assoc()){
//                 if($lvl3saletot<150000){
//                     $customerID=$rowlvl3['tbl_customer_idtbl_customer'];

//                     $sqlordersum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$joindate' AND '$next1date'";
//                     $resultordersum=$conn->query($sqlordersum);
//                     $rowordersum=$resultordersum->fetch_assoc();

//                     $sqlorderdate="SELECT `orderdate` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 ORDER BY `idtbl_order` DESC LIMIT 1";
//                     $resultorderdate=$conn->query($sqlorderdate);
//                     $roworderdate=$resultorderdate->fetch_assoc();

//                     $lvl3saletot=$lvl3saletot+$rowordersum['total'];
//                     if($lvl3saletot>=150000){
//                         $lvl3completedate=$roworderdate['orderdate'];
//                     }
//                 }
//             }
//         }

//         if($lvl3saletot<150000){
//             $sqllvl3="SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level3`='$refcode' AND `status`=1 AND `updatedatetime` BETWEEN '$joindate' AND '$next3date'";
//             $resultlvl3=$conn->query($sqllvl3);
//             if($resultlvl3->num_rows>=25){
//                 while($rowlvl3=$resultlvl3->fetch_assoc()){
//                     if($lvl3saletot<150000){
//                         $customerID=$rowlvl3['tbl_customer_idtbl_customer'];

//                         $sqlordersum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$joindate' AND '$next3date'";
//                         $resultordersum=$conn->query($sqlordersum);
//                         $rowordersum=$resultordersum->fetch_assoc();
//                         $sqlorderdate="SELECT `orderdate` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 ORDER BY `idtbl_order` DESC LIMIT 1";
//                         $resultorderdate=$conn->query($sqlorderdate);
//                         $roworderdate=$resultorderdate->fetch_assoc();

//                         $lvl3saletot=$lvl3saletot+$rowordersum['total'];
//                         if($lvl3saletot>=150000){
//                             $lvl3completedate=$roworderdate['orderdate'];
//                         }
//                     }
//                 }
//             }
//         }
//         // echo $lvl3completedate.' - '.$lvl3saletot.'<br>';
//         if(!empty($lvl3completedate)){
//             $insert="INSERT INTO `tbl_cutomer_position`(`joindate`, `promotedate`, `promotepositioncate`, `promoteposition`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_customer_idtbl_customer`) VALUES ('$customerjoindate','$lvl3completedate','2','Team Leader','1','$updatedatetime','$userID','$customermainID')";
//             $conn->query($insert);
//         }
//     }

//     if(!empty($lvl3completedate)){
//         $joindate=date("Y-m-d", strtotime($lvl3completedate));
//         $next1date=date("Y-m-d", strtotime($joindate . ' +1 month'));
//         $next3date=date("Y-m-d", strtotime($joindate . ' +3 month'));

//         $sqllvl4="SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level4`='$refcode' AND `status`=1 AND `updatedatetime` BETWEEN '$joindate' AND '$next1date'";
//         $resultlvl4=$conn->query($sqllvl4);
//         if($resultlvl4->num_rows>=375){
//             while($rowlvl4=$resultlvl4->fetch_assoc()){
//                 if($lvl4saletot<1050000){
//                     $customerID=$rowlvl4['tbl_customer_idtbl_customer'];

//                     $sqlordersum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$joindate' AND '$next1date'";
//                     $resultordersum=$conn->query($sqlordersum);
//                     $rowordersum=$resultordersum->fetch_assoc();

//                     $sqlorderdate="SELECT `orderdate` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 ORDER BY `idtbl_order` DESC LIMIT 1";
//                     $resultorderdate=$conn->query($sqlorderdate);
//                     $roworderdate=$resultorderdate->fetch_assoc();

//                     $lvl4saletot=$lvl4saletot+$rowordersum['total'];
//                     if($lvl4saletot>=1050000){
//                         $lvl4completedate=$roworderdate['orderdate'];
//                     }
//                 }
//             }
//         }

//         if($lvl4saletot<1050000){
//             $sqllvl4="SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level4`='$refcode' AND `status`=1 AND `updatedatetime` BETWEEN '$joindate' AND '$next3date'";
//             $resultlvl4=$conn->query($sqllvl4);
//             if($resultlvl4->num_rows>=125){
//                 while($rowlvl4=$resultlvl4->fetch_assoc()){
//                     if($lvl4saletot<1050000){
//                         $customerID=$rowlvl4['tbl_customer_idtbl_customer'];

//                         $sqlordersum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$joindate' AND '$next3date'";
//                         $resultordersum=$conn->query($sqlordersum);
//                         $rowordersum=$resultordersum->fetch_assoc();
//                         $sqlorderdate="SELECT `orderdate` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 ORDER BY `idtbl_order` DESC LIMIT 1";
//                         $resultorderdate=$conn->query($sqlorderdate);
//                         $roworderdate=$resultorderdate->fetch_assoc();

//                         $lvl4saletot=$lvl4saletot+$rowordersum['total'];
//                         if($lvl4saletot>=1050000){
//                             $lvl4completedate=$roworderdate['orderdate'];
//                         }
//                     }
//                 }
//             }
//         }
//         // echo $lvl4completedate.' - '.$lvl4saletot.'<br>';
//         if(!empty($lvl4completedate)){
//             $insert="INSERT INTO `tbl_cutomer_position`(`joindate`, `promotedate`, `promotepositioncate`, `promoteposition`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_customer_idtbl_customer`) VALUES ('$customerjoindate','$lvl4completedate','3','Senior Team Leader','1','$updatedatetime','$userID','$customermainID')";
//             $conn->query($insert);
//         }
//     }
// }

// $sqlmem="SELECT `level1`, `updatedatetime`, `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `status`=1";
// $resultmem=$conn->query($sqlmem);
// while($rowmem=$resultmem->fetch_assoc()){
//     $customermainID=$rowmem['tbl_customer_idtbl_customer'];
//     $refcode=$rowmem['level1'];
    
//     $sqlcusjoin="SELECT `joindate` FROM `tbl_customer` WHERE `idtbl_customer`='$customermainID'";
//     $resultcusjoin=$conn->query($sqlcusjoin);
//     $rowcusjoin=$resultcusjoin->fetch_assoc();

//     $customerjoindate=date("Y-m-d", strtotime($rowcusjoin['joindate']));

//     $lvl2saletot=0;
//     $lvl3saletot=0;
//     $lvl4saletot=0;
//     $lvl5saletot=0;
//     $lvl6saletot=0;
//     $lvl2completedate='';
//     $lvl3completedate='';
//     $lvl4completedate='';
//     $lvl5completedate='';
//     $lvl6completedate='';

//     $sqlposleader="SELECT `promotedate` FROM `tbl_cutomer_position` WHERE `status`=1 AND `tbl_customer_idtbl_customer`='$customermainID' AND `promotepositioncate`=3";
//     $resultposleader=$conn->query($sqlposleader);
//     $rowposleader=$resultposleader->fetch_assoc();

//     if(!empty($rowposleader['promotedate'])){
//         $joindate=date("Y-m-d", strtotime($rowposleader['promotedate']));
//         $next1date=date("Y-m-d", strtotime($joindate . ' +1 month'));
//         $next3date=date("Y-m-d", strtotime($joindate . ' +3 month'));

//         $sqllvl5="SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level5`='$refcode' AND `status`=1 AND `updatedatetime` BETWEEN '$joindate' AND '$next1date'";
//         $resultlvl5=$conn->query($sqllvl5);
//         if($resultlvl5->num_rows>=375){
//             while($rowlvl5=$resultlvl5->fetch_assoc()){
//                 if($lvl5saletot<1875000){
//                     $customerID=$rowlvl5['tbl_customer_idtbl_customer'];

//                     $sqlordersum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$joindate' AND '$next1date'";
//                     $resultordersum=$conn->query($sqlordersum);
//                     $rowordersum=$resultordersum->fetch_assoc();

//                     $sqlorderdate="SELECT `orderdate` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 ORDER BY `idtbl_order` DESC LIMIT 1";
//                     $resultorderdate=$conn->query($sqlorderdate);
//                     $roworderdate=$resultorderdate->fetch_assoc();

//                     $lvl5saletot=$lvl5saletot+$rowordersum['total'];

//                     if($lvl5saletot>=1875000){
//                         $lvl5completedate=$roworderdate['orderdate'];
//                     }
//                 }
//             }
//         }

//         if($lvl5saletot<1875000){
//             $sqllvl5="SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level5`='$refcode' AND `status`=1 AND `updatedatetime` BETWEEN '$joindate' AND '$next3date'";
//             $resultlvl5=$conn->query($sqllvl5);
//             if($resultlvl5->num_rows>=625){
//                 while($rowlvl5=$resultlvl5->fetch_assoc()){
//                     if($lvl5saletot<1875000){
//                         $customerID=$rowlvl5['tbl_customer_idtbl_customer'];

//                         $sqlordersum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$joindate' AND '$next3date'";
//                         $resultordersum=$conn->query($sqlordersum);
//                         $rowordersum=$resultordersum->fetch_assoc();
//                         $sqlorderdate="SELECT `orderdate` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 ORDER BY `idtbl_order` DESC LIMIT 1";
//                         $resultorderdate=$conn->query($sqlorderdate);
//                         $roworderdate=$resultorderdate->fetch_assoc();

//                         $lvl5saletot=$lvl5saletot+$rowordersum['total'];
//                         if($lvl5saletot>=1875000){
//                             $lvl5completedate=$roworderdate['orderdate'];
//                         }
//                     }
//                 }
//             }
//         }
//         // echo $lvl5completedate.' - '.$lvl5saletot.'<br>';
//         $sqlcheck="SELECT`idtbl_cutomer_position` FROM `tbl_cutomer_position` WHERE `status`=1 AND `promotepositioncate`=3 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level2`='$refcode' AND `status`=1)";
//         $resultcheck=$conn->query($sqlcheck);
//         $rowcheck=$resultcheck->fetch_assoc();
//         if($resultcheck->num_rows>0){
//             $count=$resultcheck->num_rows;
//         }
//         else{
//             $count=0;
//         }
        
//         if(!empty($lvl5completedate) && $count>=4){
//             $insert="INSERT INTO `tbl_cutomer_position`(`joindate`, `promotedate`, `promotepositioncate`, `promoteposition`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_customer_idtbl_customer`) VALUES ('$customerjoindate','$lvl5completedate','4','Assistant Manager','1','$updatedatetime','$userID','$customermainID')";
//             $conn->query($insert);
//         }
//     }
// }

// $sqlmem="SELECT `level1`, `updatedatetime`, `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `status`=1";
// $resultmem=$conn->query($sqlmem);
// while($rowmem=$resultmem->fetch_assoc()){
//     $customermainID=$rowmem['tbl_customer_idtbl_customer'];
//     $refcode=$rowmem['level1'];
    
//     $sqlcusjoin="SELECT `joindate` FROM `tbl_customer` WHERE `idtbl_customer`='$customermainID'";
//     $resultcusjoin=$conn->query($sqlcusjoin);
//     $rowcusjoin=$resultcusjoin->fetch_assoc();

//     $customerjoindate=date("Y-m-d", strtotime($rowcusjoin['joindate']));

//     $lvl2saletot=0;
//     $lvl3saletot=0;
//     $lvl4saletot=0;
//     $lvl5saletot=0;
//     $lvl6saletot=0;
//     $lvl2completedate='';
//     $lvl3completedate='';
//     $lvl4completedate='';
//     $lvl5completedate='';
//     $lvl6completedate='';
//     $seniorteamcount=0;
//     $assimanegerteamcount=0;

//     $sqlposleader="SELECT `promotedate` FROM `tbl_cutomer_position` WHERE `status`=1 AND `tbl_customer_idtbl_customer`='$customermainID' AND `promotepositioncate`=4";
//     $resultposleader=$conn->query($sqlposleader);
//     $rowposleader=$resultposleader->fetch_assoc();
    
//     if(!empty($rowposleader['promotedate'])){
//         $joindate=date("Y-m-d", strtotime($rowposleader['promotedate']));
//         $next1date=date("Y-m-d", strtotime($joindate . ' +1 month'));
//         $next3date=date("Y-m-d", strtotime($joindate . ' +3 month'));

//         $sqllvl6="SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level6`='$refcode' AND `status`=1 AND `updatedatetime` BETWEEN '$joindate' AND '$next1date'";
//         $resultlvl6=$conn->query($sqllvl6);
//         if($resultlvl6->num_rows>=3125){
//             while($rowlvl6=$resultlvl6->fetch_assoc()){
//                 if($lvl6saletot<9375000){
//                     $customerID=$rowlvl6['tbl_customer_idtbl_customer'];

//                     $sqlordersum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$joindate' AND '$next1date'";
//                     $resultordersum=$conn->query($sqlordersum);
//                     $rowordersum=$resultordersum->fetch_assoc();

//                     $sqlorderdate="SELECT `orderdate` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 ORDER BY `idtbl_order` DESC LIMIT 1";
//                     $resultorderdate=$conn->query($sqlorderdate);
//                     $roworderdate=$resultorderdate->fetch_assoc();

//                     $lvl6saletot=$lvl6saletot+$rowordersum['total'];

//                     if($lvl6saletot>=9375000){
//                         $lvl6completedate=$roworderdate['orderdate'];
//                     }
//                 }
//             }
//         }

//         if($lvl6saletot<9375000){
//             $sqllvl6="SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level6`='$refcode' AND `status`=1 AND `updatedatetime` BETWEEN '$joindate' AND '$next3date'";
//             $resultlvl6=$conn->query($sqllvl6);
//             if($resultlvl6->num_rows>=3125){
//                 while($rowlvl6=$resultlvl6->fetch_assoc()){
//                     if($lvl6saletot<9375000){
//                         $customerID=$rowlvl6['tbl_customer_idtbl_customer'];

//                         $sqlordersum="SELECT SUM(`total`) AS `total` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$joindate' AND '$next3date'";
//                         $resultordersum=$conn->query($sqlordersum);
//                         $rowordersum=$resultordersum->fetch_assoc();
//                         $sqlorderdate="SELECT `orderdate` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1 AND `acceptstatus`=1 ORDER BY `idtbl_order` DESC LIMIT 1";
//                         $resultorderdate=$conn->query($sqlorderdate);
//                         $roworderdate=$resultorderdate->fetch_assoc();

//                         $lvl6saletot=$lvl6saletot+$rowordersum['total'];
//                         if($lvl6saletot>=9375000){
//                             $lvl6completedate=$roworderdate['orderdate'];
//                         }
//                     }
//                 }
//             }
//         }
//         // echo $lvl6completedate.' - '.$lvl6saletot.'<br>';
//         $sqlcheck="SELECT`idtbl_cutomer_position` FROM `tbl_cutomer_position` WHERE `status`=1 AND `promotepositioncate`=4 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level2`='$refcode' AND `status`=1)";
//         $resultcheck=$conn->query($sqlcheck);
//         $rowcheck=$resultcheck->fetch_assoc();
//         if($resultcheck->num_rows>0){
//             $count=$resultcheck->num_rows;
//         }
//         else{
//             $count=0;
//         }

//         if(!empty($lvl6completedate) && $count>=4){
//             $insert="INSERT INTO `tbl_cutomer_position`(`joindate`, `promotedate`, `promotepositioncate`, `promoteposition`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_customer_idtbl_customer`) VALUES ('$customerjoindate','$lvl6completedate','5','Manager','1','$updatedatetime','$userID','$customermainID')";
//             $conn->query($insert);
//         }
//     }
// }

// $sqlmem="SELECT `level1`, `updatedatetime`, `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `status`=1";
// $resultmem=$conn->query($sqlmem);
// while($rowmem=$resultmem->fetch_assoc()){
//     $customermainID=$rowmem['tbl_customer_idtbl_customer'];
//     $refcode=$rowmem['level1'];
    
//     $sqlcusjoin="SELECT `joindate` FROM `tbl_customer` WHERE `idtbl_customer`='$customermainID'";
//     $resultcusjoin=$conn->query($sqlcusjoin);
//     $rowcusjoin=$resultcusjoin->fetch_assoc();

//     $customerjoindate=date("Y-m-d", strtotime($rowcusjoin['joindate']));

//     $lvl2saletot=0;
//     $lvl3saletot=0;
//     $lvl4saletot=0;
//     $lvl5saletot=0;
//     $lvl6saletot=0;
//     $lvl2completedate='';
//     $lvl3completedate='';
//     $lvl4completedate='';
//     $lvl5completedate='';
//     $lvl6completedate='';
//     $seniorteamcount=0;
//     $assimanegerteamcount=0;

//     $sqlcheck="SELECT`idtbl_cutomer_position` FROM `tbl_cutomer_position` WHERE `status`=1 AND `promotepositioncate`=5 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level2`='$refcode' AND `status`=1)";
//     $resultcheck=$conn->query($sqlcheck);
//     $rowcheck=$resultcheck->fetch_assoc();
//     if($resultcheck->num_rows>0){
//         $count=$resultcheck->num_rows;
//     }
//     else{
//         $count=0;
//     }

//     $promotedate=date('Y-m-d');

//     if($count>=4){
//         $insert="INSERT INTO `tbl_cutomer_position`(`joindate`, `promotedate`, `promotepositioncate`, `promoteposition`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_customer_idtbl_customer`) VALUES ('$customerjoindate','$promotedate','6','Director','1','$updatedatetime','$userID','$customermainID')";
//         $conn->query($insert);
//     }
// }

// $sqlmem="SELECT `level1`, `updatedatetime`, `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `status`=1";
// $resultmem=$conn->query($sqlmem);
// while($rowmem=$resultmem->fetch_assoc()){
//     $customermainID=$rowmem['tbl_customer_idtbl_customer'];
//     $refcode=$rowmem['level1'];
    
//     $sqlcusjoin="SELECT `joindate` FROM `tbl_customer` WHERE `idtbl_customer`='$customermainID'";
//     $resultcusjoin=$conn->query($sqlcusjoin);
//     $rowcusjoin=$resultcusjoin->fetch_assoc();

//     $customerjoindate=date("Y-m-d", strtotime($rowcusjoin['joindate']));

//     $lvl2saletot=0;
//     $lvl3saletot=0;
//     $lvl4saletot=0;
//     $lvl5saletot=0;
//     $lvl6saletot=0;
//     $lvl2completedate='';
//     $lvl3completedate='';
//     $lvl4completedate='';
//     $lvl5completedate='';
//     $lvl6completedate='';
//     $seniorteamcount=0;
//     $assimanegerteamcount=0;

//     $sqlcheck="SELECT`idtbl_cutomer_position` FROM `tbl_cutomer_position` WHERE `status`=1 AND `promotepositioncate`=6 AND `tbl_customer_idtbl_customer` IN (SELECT `tbl_customer_idtbl_customer` FROM `tbl_cutomer_level` WHERE `level2`='$refcode' AND `status`=1)";
//     $resultcheck=$conn->query($sqlcheck);
//     $rowcheck=$resultcheck->fetch_assoc();
//     if($resultcheck->num_rows>0){
//         $count=$resultcheck->num_rows;
//     }
//     else{
//         $count=0;
//     }

//     $promotedate=date('Y-m-d');

//     if($count>=4){
//         $insert="INSERT INTO `tbl_cutomer_position`(`joindate`, `promotedate`, `promotepositioncate`, `promoteposition`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_customer_idtbl_customer`) VALUES ('$customerjoindate','$promotedate','7','Gold Director','1','$updatedatetime','$userID','$customermainID')";
//         $conn->query($insert);
//     }
// }

//19-06-2021
// 18003	Shanidha	Ruberu	HER0726	HER0394	HER0358	HER099	HER096

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level2`='HER01220',`level3`='HER0742',`level4`='HER025',`level5`='HER02',`level6`='HER01' WHERE `tbl_customer_idtbl_customer`='18003'";
// $conn->query($updatelevel);

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level3`='HER01220',`level4`='HER0742',`level5`='HER025',`level6`='HER02' WHERE `level2`='HER018003'";
// $conn->query($updatelevel);

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level4`='HER01220',`level5`='HER0742',`level6`='HER025' WHERE `level3`='HER018003'";
// $conn->query($updatelevel);

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level5`='HER01220',`level6`='HER0742' WHERE `level4`='HER018003'";
// $conn->query($updatelevel);

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level2`='HER041',`level3`='HER02',`level4`='HER01',`level5`='',`level6`='' WHERE `tbl_customer_idtbl_customer`='52'";
// $conn->query($updatelevel);

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level3`='HER041',`level4`='HER02',`level5`='HER01',`level6`='' WHERE `level2`='HER052'";
// $conn->query($updatelevel);

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level4`='HER041',`level5`='HER02',`level6`='HER01' WHERE `level3`='HER052'";
// $conn->query($updatelevel);

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level5`='HER041',`level6`='HER02' WHERE `level4`='HER052'";
// $conn->query($updatelevel);

// $updatelevel="UPDATE `tbl_cutomer_level` SET `level2`='HER018003',`level3`='HER01220',`level4`='HER0742',`level5`='HER025',`level6`='HER02' WHERE `tbl_customer_idtbl_customer`='18135'";
// $conn->query($updatelevel);

// $sql="SELECT `idtbl_cutomer_commission` FROM `tbl_cutomer_commission` WHERE `idtbl_cutomer_commission`>80038 GROUP BY `orderid`, `orderdate`, `customerid`, `level`, `commission`, `status`";
// $result=$conn->query($sql);
// while($row=$result->fetch_assoc()){
//     $record=$row['idtbl_cutomer_commission'];

//     $delete="DELETE FROM `tbl_cutomer_commission` WHERE `idtbl_cutomer_commission`='$record'";
//     $conn->query($delete);
// }

//2021-06-27

// $update="UPDATE `tbl_user_codes` SET `status`='3' WHERE `tbl_user_idtbl_user` IN (SELECT `idtbl_user` FROM `tbl_user` WHERE `username`='trilankapriyashan@gmail.com')";
// $conn->query($update);

// pickup_request function
  
// function pickup_request($api_key,$client_id,$recipient_name,$recipient_contact_no,$recipient_address,$recipient_city,$parcel_type,$cod_amount,$parcel_description,$order_id){
//     // curl post

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL,"https://fardardomestic.com/api/p_request_v1.02.php");
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS,
//     "client_id=$client_id&api_key=$api_key&recipient_name=$recipient_name&recipient_contact_no=$recipient_contact_no&recipient_address=$recipient_address&parcel_type=$parcel_type&recipient_city=$recipient_city&parcel_description=$parcel_description&cod_amount=$cod_amount&order_id=$order_id");
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     echo $server_output = curl_exec($ch);
//     curl_close ($ch);
// }

// //call set parcel variables


// $api_key = "api60d85c57826cb";
// $client_id = "3171";
// $recipient_name = "Test Member";
// $recipient_contact_no = "0761234567";
// $recipient_address = "kottawa,pannipitiya";
// $recipient_city = "nugegoda";
// $parcel_type = "1";
// $cod_amount = "120";
// $parcel_description = "Test";
// $order_id = "1234";


// //call pickup_request function


// pickup_request($api_key,$client_id,$recipient_name,$recipient_contact_no,$recipient_address,$recipient_city,$parcel_type,$cod_amount,$parcel_description,$order_id);

// $array='[{"status":204,"waybill_no":1798956}]';
// print_r(json_decode($array));

// 30-06-2021

// $updatecus="UPDATE `tbl_customer` SET `nicno`='945950668V' WHERE `tbl_user_idtbl_user`='16077'";
// $conn->query($updatecus);

// $updateuser="UPDATE `tbl_user` SET `nicno`='945950668V' WHERE `idtbl_user`='16077'";
// $conn->query($updateuser);

//01-07-2021

// mysqli_autocommit($conn,FALSE);

// $insert="INSERT INTO `tbl_cutomer_commission`(`commkey`, `orderid`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('27adab09faa51aa50318851a1fc79766','11','2021-02-07','2','2','940.95','1','2021-06-06 11:52:22','1')";
// if($conn->query($insert)==true){
//     echo 'Insert';
// }
// else{
//     echo 'Not Insert';
// }

// Rollback transaction
// mysqli_rollback($conn);

// $orderID=19582;

// $sql="UPDATE `tbl_order` SET `acceptstatus`='1' WHERE `idtbl_order`='$orderID'";
// $conn->query($sql);

// // Commision Calculation Start
// $sqlorder="SELECT `idtbl_order`, `orderdate`, `total`, `discount`, `dropdiscountstatus`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `idtbl_order`='$orderID'";
// $resultorder=$conn->query($sqlorder);
// while($roworder=$resultorder->fetch_assoc()){
//     $cusID=$roworder['tbl_customer_idtbl_customer'];
//     $ordertotal=$roworder['total'];
//     $orderdate=$roworder['orderdate'];
//     $dropshipstatus=$roworder['dropdiscountstatus'];
//     $discount=$roworder['discount'];
//     $orderid=$roworder['idtbl_order'];

//     $sqlcuslevel="SELECT `level2`, `level3`, `level4`, `level5`, `level6` FROM `tbl_cutomer_level` WHERE `status`=1 AND `tbl_customer_idtbl_customer`='$cusID'";
//     $resultcuslevel=$conn->query($sqlcuslevel);
//     $rowcuslevel=$resultcuslevel->fetch_assoc();

//     $lvl2=$rowcuslevel['level2'];
//     $lvl3=$rowcuslevel['level3'];
//     $lvl4=$rowcuslevel['level4'];
//     $lvl5=$rowcuslevel['level5'];
//     $lvl6=$rowcuslevel['level6'];

//     if(!empty($lvl2)){
//         $sqlcuslvltwo="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl2'";
//         $resultcuslvltwo=$conn->query($sqlcuslvltwo);
//         $rowcuslvltwo=$resultcuslvltwo->fetch_assoc();

//         $lvltwocom=$ordertotal*15/100;
//         $lvltwocusid=$rowcuslvltwo['idtbl_customer'];

//         $commkey=md5($orderid.'_'.$lvltwocusid);

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvltwocusid','2','$lvltwocom','1','$updatedatetime','$userID')";
//         if($conn->query($insertcommission)==true){}
//         else{
//             mysqli_rollback($conn);

//             $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$orderID'";
//             $conn->query($sql);
//         }
//     }
//     else{
//         $lvltwocom=0;
//         $lvltwocusid=0;
//     }

//     if(!empty($lvl3)){
//         $sqlcuslvlthree="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl3'";
//         $resultcuslvlthree=$conn->query($sqlcuslvlthree);
//         $rowcuslvlthree=$resultcuslvlthree->fetch_assoc();

//         $lvlthreecom=$ordertotal*5/100;
//         $lvlthreecusid=$rowcuslvlthree['idtbl_customer'];

//         $commkey=md5($orderid.'_'.$lvlthreecusid);

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlthreecusid','3','$lvlthreecom','1','$updatedatetime','$userID')";
//         if($conn->query($insertcommission)==true){}
//         else{
//             mysqli_rollback($conn);

//             $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$orderID'";
//             $conn->query($sql);
//         }
//     }
//     else{
//         $lvlthreecom=0;
//         $lvlthreecusid=0;
//     }
    
//     if(!empty($lvl4)){
//         $sqlcuslvlfour="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl4'";
//         $resultcuslvlfour=$conn->query($sqlcuslvlfour);
//         $rowcuslvlfour=$resultcuslvlfour->fetch_assoc();

//         $lvlfourcom=$ordertotal*5/100;
//         $lvlfourcusid=$rowcuslvlfour['idtbl_customer'];

//         $commkey=md5($orderid.'_'.$lvlfourcusid);

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlfourcusid','4','$lvlfourcom','1','$updatedatetime','$userID')";
//         if($conn->query($insertcommission)==true){}
//         else{
//             mysqli_rollback($conn);

//             $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$orderID'";
//             $conn->query($sql);
//         }
//     }
//     else{
//         $lvlfourcom=0;
//         $lvlfourcusid=0;
//     }

//     if(!empty($lvl5)){
//         $sqlcuslvlfive="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl5'";
//         $resultcuslvlfive=$conn->query($sqlcuslvlfive);
//         $rowcuslvlfive=$resultcuslvlfive->fetch_assoc();

//         $lvlfivecom=$ordertotal*2.5/100;
//         $lvlfivecusid=$rowcuslvlfive['idtbl_customer'];

//         $commkey=md5($orderid.'_'.$lvlfivecusid);

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlfivecusid','5','$lvlfivecom','1','$updatedatetime','$userID')";
//         if($conn->query($insertcommission)==true){}
//         else{
//             mysqli_rollback($conn);

//             $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$orderID'";
//             $conn->query($sql);
//         }
//     }
//     else{
//         $lvlfivecom=0;
//         $lvlfivecusid=0;
//     }

//     if(!empty($lvl6)){
//         $sqlcuslvlsix="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl6'";
//         $resultcuslvlsix=$conn->query($sqlcuslvlsix);
//         $rowcuslvlsix=$resultcuslvlsix->fetch_assoc();

//         $lvlsixcom=$ordertotal*2.5/100;
//         $lvlsixcusid=$rowcuslvlsix['idtbl_customer'];

//         $commkey=md5($orderid.'_'.$lvlsixcusid);

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlsixcusid','6','$lvlsixcom','1','$updatedatetime','$userID')";
//         if($conn->query($insertcommission)==true){}
//         else{
//             mysqli_rollback($conn);

//             $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$orderID'";
//             $conn->query($sql);
//         }
//     }
//     else{
//         $lvlsixcom=0;
//         $lvlsixcusid=0;
//     }

//     if($dropshipstatus==1){
//         $dropshipcom=$discount;
//         $dropshipcusid=$cusID;

//         $commkey=md5($orderid.'_'.$dropshipcusid);

//         $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$dropshipcusid','0','$dropshipcom','1','$updatedatetime','$userID')";
//         if($conn->query($insertcommission)==true){}
//         else{
//             mysqli_rollback($conn);

//             $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$orderID'";
//             $conn->query($sql);
//         }
//     }
//     else{
//         $dropshipcom=0;
//         $dropshipcusid=0;
//     }
// }

//06-07-2021

// $sql="SELECT `idtbl_order` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=0 AND `idtbl_order` IN (SELECT `orderid` FROM `tbl_cutomer_commission` WHERE `status`=1 GROUP BY `orderid`)";
// $result=$conn->query($sql);
// while($row=$result->fetch_assoc()){
//     echo $row['idtbl_order'].'<br>';
// }

// $update="UPDATE `tbl_order` SET `acceptstatus`='1' WHERE `status`=1 AND `acceptstatus`=0 AND `idtbl_order` IN (SELECT `orderid` FROM `tbl_cutomer_commission` WHERE `status`=1 GROUP BY `orderid`)";
// $conn->query($update);

//13-07-2021
// $update="UPDATE `tbl_city` SET `colombostatus`='1' WHERE `idtbl_city` IN (50,53,56,64,73,81,883,95,98,112,114,126,133,152,154,162,165,106,185,189,201,202,204,212,207,221,231,242,246,268,295)";
// $conn->query($update);

// 14/07/2021

// $update="UPDATE `tbl_customer` SET `status`='1' WHERE `idtbl_customer`='14861'";
// $conn->query($update);

// $updateone="UPDATE `tbl_user` SET `status`='1' WHERE `idtbl_user` IN (SELECT `tbl_user_idtbl_user` FROM `tbl_customer` WHERE `idtbl_customer`='14861')";
// $conn->query($updateone);

// $sql="SELECT `idtbl_order` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `tbl_customer_idtbl_customer`=16643";
// $result=$conn->query($sql);
// while($row=$result->fetch_assoc()){
//     echo $row['idtbl_order'].'<br>';
// }

// $sql="SELECT SUM(`booklet`) AS `total` FROM `tbl_order` WHERE `acceptstatus`=1 AND `trackingnum`!='' AND  `status`=1";
// $result=$conn->query($sql);
// $row=$result->fetch_assoc();
    
// echo $row['total'];

// 2021-07-16

// $update="UPDATE `tbl_order` SET `acceptstatus` = '0' WHERE `tbl_order`.`idtbl_order` = 26173";
// $conn->query($update);

//2021-07-19

// $sql="SELECT `accountno`, `accountname`, `idtbl_customer_bank` FROM `tbl_customer_bank`";
// $result=$conn->query($sql);
// while($row=$result->fetch_assoc()){
//     $accountname=str_replace('.', '', $row['accountname']);
//     $accountname=str_replace("'", '`', $accountname);
//     $accountname=preg_replace("/(?![A-Z a-z 0-9])./", "", $accountname);

//     $accountname=strtoupper($accountname);

//     $accountID=$row['idtbl_customer_bank'];

//     $update="UPDATE `tbl_customer_bank` SET `accountname`='$accountname' WHERE `idtbl_customer_bank`='$accountID'";
//     $conn->query($update);
// }

//21-07-2021

// $update="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='31675'";
// $conn->query($update);

//22-07-2021 Commission calculate

// $sql="SELECT `idtbl_order` FROM `tbl_order` WHERE `idtbl_order` NOT IN (SELECT `orderid` FROM `tbl_cutomer_commission` WHERE `status`=1 GROUP BY `orderid`) AND `acceptstatus`=1 AND `status`=1 ORDER BY `idtbl_order` DESC";
// $result=$conn->query($sql);
// while($row=$result->fetch_assoc()){
//     echo $row['idtbl_order'].'<br>';

//     $record=$row['idtbl_order'];
//     // $record=31721;

//     $sqlorder="SELECT `idtbl_order`, `orderdate`, `total`, `discount`, `dropdiscountstatus`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `idtbl_order`='$record'";
//     $resultorder=$conn->query($sqlorder);
//     while($roworder=$resultorder->fetch_assoc()){
//         $cusID=$roworder['tbl_customer_idtbl_customer'];
//         $ordertotal=$roworder['total'];
//         $orderdate=$roworder['orderdate'];
//         $dropshipstatus=$roworder['dropdiscountstatus'];
//         $discount=$roworder['discount'];
//         $orderid=$roworder['idtbl_order'];

//         $sqlcuslevel="SELECT `level2`, `level3`, `level4`, `level5`, `level6` FROM `tbl_cutomer_level` WHERE `status`=1 AND `tbl_customer_idtbl_customer`='$cusID'";
//         $resultcuslevel=$conn->query($sqlcuslevel);
//         $rowcuslevel=$resultcuslevel->fetch_assoc();

//         $lvl2=$rowcuslevel['level2'];
//         $lvl3=$rowcuslevel['level3'];
//         $lvl4=$rowcuslevel['level4'];
//         $lvl5=$rowcuslevel['level5'];
//         $lvl6=$rowcuslevel['level6'];

//         if(!empty($lvl2)){
//             $sqlcuslvltwo="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl2'";
//             $resultcuslvltwo=$conn->query($sqlcuslvltwo);
//             $rowcuslvltwo=$resultcuslvltwo->fetch_assoc();

//             $lvltwocom=$ordertotal*15/100;
//             $lvltwocusid=$rowcuslvltwo['idtbl_customer'];

//             $commkey=md5($orderid.'_'.$lvltwocusid);

//             $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvltwocusid','2','$lvltwocom','1','$updatedatetime','$userID')";
//             if($conn->query($insertcommission)==true){}
//             else{
//                 mysqli_rollback($conn);

//                 $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
//                 $conn->query($sql);
//             }
//         }
//         else{
//             $lvltwocom=0;
//             $lvltwocusid=0;
//         }

//         if(!empty($lvl3)){
//             $sqlcuslvlthree="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl3'";
//             $resultcuslvlthree=$conn->query($sqlcuslvlthree);
//             $rowcuslvlthree=$resultcuslvlthree->fetch_assoc();

//             $lvlthreecom=$ordertotal*5/100;
//             $lvlthreecusid=$rowcuslvlthree['idtbl_customer'];

//             $commkey=md5($orderid.'_'.$lvlthreecusid);

//             $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlthreecusid','3','$lvlthreecom','1','$updatedatetime','$userID')";
//             if($conn->query($insertcommission)==true){}
//             else{
//                 mysqli_rollback($conn);

//                 $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
//                 $conn->query($sql);
//             }
//         }
//         else{
//             $lvlthreecom=0;
//             $lvlthreecusid=0;
//         }
        
//         if(!empty($lvl4)){
//             $sqlcuslvlfour="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl4'";
//             $resultcuslvlfour=$conn->query($sqlcuslvlfour);
//             $rowcuslvlfour=$resultcuslvlfour->fetch_assoc();

//             $lvlfourcom=$ordertotal*5/100;
//             $lvlfourcusid=$rowcuslvlfour['idtbl_customer'];

//             $commkey=md5($orderid.'_'.$lvlfourcusid);

//             $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlfourcusid','4','$lvlfourcom','1','$updatedatetime','$userID')";
//             if($conn->query($insertcommission)==true){}
//             else{
//                 mysqli_rollback($conn);

//                 $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
//                 $conn->query($sql);
//             }
//         }
//         else{
//             $lvlfourcom=0;
//             $lvlfourcusid=0;
//         }

//         if(!empty($lvl5)){
//             $sqlcuslvlfive="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl5'";
//             $resultcuslvlfive=$conn->query($sqlcuslvlfive);
//             $rowcuslvlfive=$resultcuslvlfive->fetch_assoc();

//             $lvlfivecom=$ordertotal*2.5/100;
//             $lvlfivecusid=$rowcuslvlfive['idtbl_customer'];

//             $commkey=md5($orderid.'_'.$lvlfivecusid);

//             $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlfivecusid','5','$lvlfivecom','1','$updatedatetime','$userID')";
//             if($conn->query($insertcommission)==true){}
//             else{
//                 mysqli_rollback($conn);

//                 $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
//                 $conn->query($sql);
//             }
//         }
//         else{
//             $lvlfivecom=0;
//             $lvlfivecusid=0;
//         }

//         if(!empty($lvl6)){
//             $sqlcuslvlsix="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl6'";
//             $resultcuslvlsix=$conn->query($sqlcuslvlsix);
//             $rowcuslvlsix=$resultcuslvlsix->fetch_assoc();

//             $lvlsixcom=$ordertotal*2.5/100;
//             $lvlsixcusid=$rowcuslvlsix['idtbl_customer'];

//             $commkey=md5($orderid.'_'.$lvlsixcusid);

//             $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlsixcusid','6','$lvlsixcom','1','$updatedatetime','$userID')";
//             if($conn->query($insertcommission)==true){}
//             else{
//                 mysqli_rollback($conn);

//                 $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
//                 $conn->query($sql);
//             }
//         }
//         else{
//             $lvlsixcom=0;
//             $lvlsixcusid=0;
//         }

//         if($dropshipstatus==1){
//             $dropshipcom=$discount;
//             $dropshipcusid=$cusID;

//             $commkey=md5($orderid.'_'.$dropshipcusid);

//             $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$dropshipcusid','0','$dropshipcom','1','$updatedatetime','$userID')";
//             if($conn->query($insertcommission)==true){}
//             else{
//                 mysqli_rollback($conn);

//                 $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
//                 $conn->query($sql);
//             }
//         }
//         else{
//             $dropshipcom=0;
//             $dropshipcusid=0;
//         }
//     }
// }

//27-07-2021

// $insertdata="INSERT INTO `tbl_customer_monthly_commission`(`month`, `customerid`, `lvl2totcom`, `lvl3totcom`, `lvl4totcom`, `lvl5totcom`, `lvl6totcom`, `lvldrop`, `returnprice`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) SELECT '2021-07-01' AS `month`, `ui`.`customerid`,`u`.`lvl2totcom`,`ub`.`lvl3totcom`,`uc`.`lvl4totcom`,`ud`.`lvl5totcom`,`ue`.`lvl6totcom`,`uf`.`lvldrop`,`ug`.`returnprice`, '1' AS `status`, '2021-07-27 10:30:00' AS `dattime`, '1' AS `user` FROM (SELECT`customerid`,`status` FROM`tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '2021-07-01' AND '2021-07-31' GROUP BY `customerid` ORDER BY`customerid` ASC) `ui` LEFT JOIN `tbl_customer` AS `ua` ON `ua`.`idtbl_customer` = `ui`.`customerid` LEFT JOIN (SELECT`customerid`,`level`,SUM(`commission`) AS `lvl2totcom`,`status` FROM`tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '2021-07-01' AND '2021-07-31' AND `level` = 2 GROUP BY `customerid` ORDER BY`customerid` ASC) `u` ON `u`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl3totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '2021-07-01' AND '2021-07-31' AND `level` = 3 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ub` ON `ub`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl4totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '2021-07-01' AND '2021-07-31' AND `level` = 4 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `uc` ON `uc`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl5totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '2021-07-01' AND '2021-07-31' AND `level` = 5 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ud` ON `ud`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl6totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '2021-07-01' AND '2021-07-31' AND `level` = 6 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ue` ON `ue`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvldrop`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '2021-07-01' AND '2021-07-31' AND `level` = 0 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `uf` ON `uf`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT SUM(`returnprice`) AS `returnprice`,`tbl_customer_idtbl_customer` FROM `tbl_order_return` WHERE `status` = 1 AND `orderdate` BETWEEN '2021-07-01' AND '2021-07-31' GROUP BY `tbl_customer_idtbl_customer`) AS `ug` ON `ug`.`tbl_customer_idtbl_customer` = `ui`.`customerid` LEFT JOIN `tbl_customer_bank` AS `uh` ON `uh`.`tbl_customer_idtbl_customer` = `ui`.`customerid` WHERE `ui`.`status` = '1'";
// $conn->query($insertdata);

// $insertmenu="INSERT INTO `tbl_menu_list`(`menu`, `status`) VALUES ('Day End', '1')";
// $conn->query($insertmenu);