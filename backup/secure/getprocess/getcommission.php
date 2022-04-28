<?php
session_start();
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];

// $fromdate='2021-05-01';
// $todate='2021-05-31';
// $customer='';
$fromdate=date("Y-m-d", strtotime($_POST['fromdate']));
$todate=date("Y-m-d", strtotime($_POST['todate']));
$customer=$_POST['customer'];
$limit=$_POST["limit"];
$start=$_POST["start"];
$next=$start+$limit;

$paymonth=date("Y M", strtotime($_POST['fromdate']));
$paiddate=date("ym").'05';

$j=1;

$arraycuslist=array();

if(empty($customer)){
    // $sqlcustomerlist="SELECT `level1`, `level2`, `level3`, `level4`, `level5`, `level6` FROM `tbl_cutomer_level` WHERE `tbl_customer_idtbl_customer` IN (SELECT DISTINCT(`tbl_customer_idtbl_customer`) AS `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `idtbl_order` IN (SELECT `tbl_order_idtbl_order` FROM `tbl_commission` WHERE `status`=1) AND `status`=1 AND `orderdate` BETWEEN '$fromdate' AND '$todate') AND `status`=1";
    $sqlcustomercom="SELECT SUM(`u`.`commission`) AS `totcom`, `u`.`customerid`, `u`.`level`, `ua`.`firstname`, `ua`.`lastname`, `ub`.* FROM `tbl_cutomer_commission` AS `u` LEFT JOIN `tbl_customer` AS `ua` ON `ua`.`idtbl_customer`=`u`.`customerid` LEFT JOIN `tbl_customer_bank` AS `ub` ON `ub`.`tbl_customer_idtbl_customer`=`u`.`customerid` WHERE `u`.`status`=1 AND `u`.`orderdate` BETWEEN '$fromdate' AND '$todate' GROUP BY `u`.`level`, `u`.`customerid` ORDER BY `u`.`customerid`, `u`.`level` ASC LIMIT $start, $next";
    $resultcustomercom=$conn->query($sqlcustomercom);
}
else{
    $sqlcustomercom="SELECT SUM(`u`.`commission`) AS `totcom`, `u`.`customerid`, `u`.`level`, `ua`.`firstname`, `ua`.`lastname`, `ub`.* FROM `tbl_cutomer_commission` AS `u` LEFT JOIN `tbl_customer` AS `ua` ON `ua`.`idtbl_customer`=`u`.`customerid` LEFT JOIN `tbl_customer_bank` AS `ub` ON `ub`.`tbl_customer_idtbl_customer`=`u`.`customerid` WHERE `u`.`status`=1 AND `u`.`orderdate` BETWEEN '$fromdate' AND '$todate' AND `u`.`customerid`='$customer' GROUP BY `u`.`level`, `u`.`customerid` ORDER BY `u`.`customerid`, `u`.`level` ASC";
    $resultcustomercom=$conn->query($sqlcustomercom);
}

$customerID=0;

$i=1;
$nettotal=0;
$lvlstatus2=0;
$lvlstatus3=0;
$lvlstatus4=0;
$lvlstatus5=0;
$lvlstatus6=0;
$dropstatus=0;
$comarray=array();

while($rowcustomercom=$resultcustomercom->fetch_assoc()){
    if($customerID!=$rowcustomercom['customerid']){
        if($customerID!=0){
            $nettotal=$nettotal-15;
            if($nettotal<0){$nettotal=0;}
            
            $objcom->total=number_format($nettotal, 2);
            $objcom->banktotal=sprintf('%012d', number_format((float)$nettotal, 2, '', ''));
            if($lvlstatus2==0){$objcom->level2=number_format(0, 2);}
            if($lvlstatus3==0){$objcom->level3=number_format(0, 2);}
            if($lvlstatus4==0){$objcom->level4=number_format(0, 2);}
            if($lvlstatus5==0){$objcom->level5=number_format(0, 2);}
            if($lvlstatus6==0){$objcom->level6=number_format(0, 2);}
            if($dropstatus==0){$objcom->drop=number_format(0, 2);}
            array_push($comarray, $objcom);
        }
        $nettotal=0;
        $lvlstatus2=0;
        $lvlstatus3=0;
        $lvlstatus4=0;
        $lvlstatus5=0;
        $lvlstatus6=0;
        $dropstatus=0;

        $accountname=str_replace('.', '', $rowcustomercom['accountname']);
        $accountname=str_replace("'", '`', $accountname);
        $accountname=preg_replace("/(?![A-Z a-z 0-9])./", "", $accountname);

        $strlength=strlen($accountname);
        if($strlength<20){
            $accountname=str_pad($accountname, 20, '-');
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

        $objcom=new stdClass();
        $objcom->customerid=$rowcustomercom['customerid'];
        $objcom->name=$firstname.' '.$lastname;
        $objcom->account=sprintf('%012d', $rowcustomercom['accountno']);
        $objcom->accname=$accountname;
        $objcom->bank=$bankname;
        $objcom->bankcode=sprintf('%04d', $rowcustomercom['bankcode']);
        $objcom->branch=$branchname;
        $objcom->branchcode=sprintf('%03d', $rowcustomercom['branchcode']);
        $objcom->paymonth=$paymonth;
        $objcom->paiddate=$paiddate;

        $customerID=$rowcustomercom['customerid'];
    }
    
    if($rowcustomercom['level']==2){$objcom->level2=number_format($rowcustomercom['totcom'],2);$nettotal=$nettotal+$rowcustomercom['totcom'];$lvlstatus2=1;}
    if($rowcustomercom['level']==3){$objcom->level3=number_format($rowcustomercom['totcom'],2);$nettotal=$nettotal+$rowcustomercom['totcom'];$lvlstatus3=1;}
    if($rowcustomercom['level']==4){$objcom->level4=number_format($rowcustomercom['totcom'],2);$nettotal=$nettotal+$rowcustomercom['totcom'];$lvlstatus4=1;}
    if($rowcustomercom['level']==5){$objcom->level5=number_format($rowcustomercom['totcom'],2);$nettotal=$nettotal+$rowcustomercom['totcom'];$lvlstatus5=1;}
    if($rowcustomercom['level']==6){$objcom->level6=number_format($rowcustomercom['totcom'],2);$nettotal=$nettotal+$rowcustomercom['totcom'];$lvlstatus6=1;}
    if($rowcustomercom['level']==0){$objcom->drop=number_format($rowcustomercom['totcom'],2);$nettotal=$nettotal+$rowcustomercom['totcom'];$dropstatus=1;}
        
    $customerretunID=$rowcustomercom['customerid'];
    $sqlcheckreturn="SELECT SUM(`returnprice`) AS `returnprice` FROM `tbl_order_return` WHERE `status`=1 AND `tbl_customer_idtbl_customer`='$customerretunID' AND `orderdate` BETWEEN '$fromdate' AND '$todate'";
    $resultcheckreturn=$conn->query($sqlcheckreturn);
    $rowcheckreturn=$resultcheckreturn->fetch_assoc();

    if($resultcheckreturn->num_rows>0){$returntotal=$rowcheckreturn['returnprice'];$nettotal=$nettotal-$returntotal;$objcom->returntot=number_format($returntotal,2);}
    else{$returntotal=0;$objcom->returntot=number_format($returntotal,2);}
    
    if($resultcustomercom->num_rows==$i){
        $nettotal=$nettotal-15;
        if($nettotal<0){$nettotal=0;}

        $objcom->total=number_format($nettotal, 2);
        $objcom->banktotal=sprintf('%012d', number_format((float)$nettotal, 2, '', ''));
        if($lvlstatus2==0){$objcom->level2=0;}
        if($lvlstatus3==0){$objcom->level3=0;}
        if($lvlstatus4==0){$objcom->level4=0;}
        if($lvlstatus5==0){$objcom->level5=0;}
        if($lvlstatus6==0){$objcom->level6=0;}
        if($dropstatus==0){$objcom->drop=0;}
        array_push($comarray, $objcom);
    }
    $i++;
}
// print_r($comarray);
// echo json_encode($comarray);
// echo '{"data": '.json_encode($comarray).'}';

?>