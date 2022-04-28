<?php
session_start();
require_once('../../connection/db.php');

$customer=$_POST['customer'];
$commissionlist=json_decode($_POST['commissionlist']);
// print_r($commissionlist);
// echo count($commissionlist);
// $arraylist=array();

foreach($commissionlist->leveltwocom as $rowcomtwo){
    $explode=explode('=',$rowcomtwo);
    // print_r($explode);
    $arraylisttwo[] = array($explode[0] => $explode[1]);
    // array_push($arraylist, $explode);
}
print_r($arraylisttwo);

foreach($commissionlist->levelthreecom as $rowcomthree){
    $explode=explode('=',$rowcomthree);
    $arraylistthree[] = array($explode[0] => $explode[1]);
}
foreach($commissionlist->levelfourcom as $rowcomfour){
    $explode=explode('=',$rowcomfour);
    $arraylistfour[] = array($explode[0] => $explode[1]);
}
foreach($commissionlist->levelfivecom as $rowcomfive){
    $explode=explode('=',$rowcomfive);
    $arraylistfive[] = array($explode[0] => $explode[1]);
}
foreach($commissionlist->levelsixcom as $rowcomsix){
    $explode=explode('=',$rowcomsix);
    $arraylistsix[] = array($explode[0] => $explode[1]);
}

if($customer==''){
    $sqlcustomerlist="SELECT `firstname`, `lastname`, `refcode`, `idtbl_customer` FROM `tbl_customer` WHERE `status`=1";
    $resultcustomerlist=$conn->query($sqlcustomerlist);
}
else{
    $sqlcustomerlist="SELECT `firstname`, `lastname`, `refcode`, `idtbl_customer` FROM `tbl_customer` WHERE `status`=1 AND `idtbl_customer`='$customer'";
    $resultcustomerlist=$conn->query($sqlcustomerlist);
}

while($rowcustomerlist=$resultcustomerlist->fetch_assoc()){ 
    $customerID=$rowcustomerlist['idtbl_customer'];
    
    foreach($arraylisttwo as $twoarray){
        foreach ($twoarray as $key=>$value) {
            // echo $customerID;
            // if($key==$customerID){
            //     $totaltwolvl=$value;
            // }
            // else{
            //     $totaltwolvl=0;
            // }
        }
    }

    // echo $totaltwolvl.'<br>';

    // $totalcom=$rowtwolvl['totaltwo']+$rowthreelvl['totalthree']+$rowfourlvl['totalfour']+$rowfivelvl['totalfive']+$rowsixlvl['totalsix']+$rowdropship['discount'];

    // $sqlbank="SELECT * FROM `tbl_customer_bank` WHERE `tbl_customer_idtbl_customer`='$customerID' AND `status`=1";
    // $resultbank=$conn->query($sqlbank);
    // $rowbank=$resultbank->fetch_assoc();

}

// $sumArray = array();

// foreach ($arraylist as $k=>$subArray) {
//     foreach ($subArray as $key=>$value) {
//         if (isset($sumArray[$key])){
//             $sumArray[$key] += $value;
//         }
//         else{
//             $sumArray[$key] = $value;
//         }
//     }
// }

// print_r($sumArray);


// $totalarray = array ();
// foreach ($arraylist as $key => $value)
// {
//     if (isset($totalarray[$key]))
//     {
//         $totalarray[$key] += $value;
//     }
//     else
//     {
//         $totalarray[$key] = $value;
//     }
// }
// print_r($totalarray);

// // ini_set('max_execution_time', 3600); //3600 seconds = 60 minutes
// // This script will run for long and will exceed more than 100 seconds.

// // To make a fix, you need to send a header or data earlier than your "long-running process".
// // sending a header to fix the error is currently impossible in PHP versions at the moment.

// // sending a data.
// $spacer_size = 8; // increment me until it works
// // echo str_pad('', (1024 * $spacer_size), "\n"); // send 8kb of new line to browser (default), just make sure that this new line will not affect your code.
// // if you have output compression, make sure your data will reach >8KB.

// if(ob_get_level()) ob_end_clean(); // end output buffering

// sleep(3600);
// // echo "WOW, you waited me for 110 seconds.";

// $userID=$_SESSION['userid'];

// $fromdate=date("Y-m-d", strtotime($_POST['fromdate']));
// $todate=date("Y-m-d", strtotime($_POST['todate']));
// $customer=$_POST['customer'];

// $i=1;

// $data='';
// $data.='{"data": [';

// if($customer==''){
//     $sqlcustomerlist="SELECT `firstname`, `lastname`, `refcode`, `idtbl_customer` FROM `tbl_customer` WHERE `status`=1";
//     $resultcustomerlist=$conn->query($sqlcustomerlist);
// }
// else{
//     $sqlcustomerlist="SELECT `firstname`, `lastname`, `refcode`, `idtbl_customer` FROM `tbl_customer` WHERE `status`=1 AND `idtbl_customer`='$customer'";
//     $resultcustomerlist=$conn->query($sqlcustomerlist);
// }

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
//             "total": "'.number_format($totalcom, 2).'",
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
?>