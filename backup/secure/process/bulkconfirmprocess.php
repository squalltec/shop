<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:../index.php");}
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];
$updatedatetime=date('Y-m-d h:i:s');

$tabledata=json_decode($_POST['tabledata']);

foreach($tabledata as $rowtabledata){
    $orderID=$rowtabledata->orderid;

    $sql="UPDATE `tbl_order` SET `acceptstatus`='1' WHERE `idtbl_order`='$orderID'";
    $conn->query($sql);

    // Commision Calculation Start
    $sqlorder="SELECT `idtbl_order`, `orderdate`, `total`, `discount`, `dropdiscountstatus`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `idtbl_order`='$orderID'";
    $resultorder=$conn->query($sqlorder);
    while($roworder=$resultorder->fetch_assoc()){
        $cusID=$roworder['tbl_customer_idtbl_customer'];
        $ordertotal=$roworder['total'];
        $orderdate=$roworder['orderdate'];
        $dropshipstatus=$roworder['dropdiscountstatus'];
        $discount=$roworder['discount'];
        $orderid=$roworder['idtbl_order'];

        $sqlcuslevel="SELECT `level2`, `level3`, `level4`, `level5`, `level6` FROM `tbl_cutomer_level` WHERE `status`=1 AND `tbl_customer_idtbl_customer`='$cusID'";
        $resultcuslevel=$conn->query($sqlcuslevel);
        $rowcuslevel=$resultcuslevel->fetch_assoc();

        $lvl2=$rowcuslevel['level2'];
        $lvl3=$rowcuslevel['level3'];
        $lvl4=$rowcuslevel['level4'];
        $lvl5=$rowcuslevel['level5'];
        $lvl6=$rowcuslevel['level6'];

        if(!empty($lvl2)){
            $sqlcuslvltwo="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl2'";
            $resultcuslvltwo=$conn->query($sqlcuslvltwo);
            $rowcuslvltwo=$resultcuslvltwo->fetch_assoc();

            $lvltwocom=$ordertotal*15/100;
            $lvltwocusid=$rowcuslvltwo['idtbl_customer'];

            $commkey=md5($orderid.'_'.$lvltwocusid);

            $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvltwocusid','2','$lvltwocom','1','$updatedatetime','$userID')";
            $conn->query($insertcommission);
        }
        else{
            $lvltwocom=0;
            $lvltwocusid=0;
        }

        if(!empty($lvl3)){
            $sqlcuslvlthree="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl3'";
            $resultcuslvlthree=$conn->query($sqlcuslvlthree);
            $rowcuslvlthree=$resultcuslvlthree->fetch_assoc();

            $lvlthreecom=$ordertotal*5/100;
            $lvlthreecusid=$rowcuslvlthree['idtbl_customer'];

            $commkey=md5($orderid.'_'.$lvlthreecusid);

            $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlthreecusid','3','$lvlthreecom','1','$updatedatetime','$userID')";
            $conn->query($insertcommission);
        }
        else{
            $lvlthreecom=0;
            $lvlthreecusid=0;
        }
        
        if(!empty($lvl4)){
            $sqlcuslvlfour="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl4'";
            $resultcuslvlfour=$conn->query($sqlcuslvlfour);
            $rowcuslvlfour=$resultcuslvlfour->fetch_assoc();

            $lvlfourcom=$ordertotal*5/100;
            $lvlfourcusid=$rowcuslvlfour['idtbl_customer'];

            $commkey=md5($orderid.'_'.$lvlfourcusid);

            $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlfourcusid','4','$lvlfourcom','1','$updatedatetime','$userID')";
            $conn->query($insertcommission);
        }
        else{
            $lvlfourcom=0;
            $lvlfourcusid=0;
        }

        if(!empty($lvl5)){
            $sqlcuslvlfive="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl5'";
            $resultcuslvlfive=$conn->query($sqlcuslvlfive);
            $rowcuslvlfive=$resultcuslvlfive->fetch_assoc();

            $lvlfivecom=$ordertotal*2.5/100;
            $lvlfivecusid=$rowcuslvlfive['idtbl_customer'];

            $commkey=md5($orderid.'_'.$lvlfivecusid);

            $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlfivecusid','5','$lvlfivecom','1','$updatedatetime','$userID')";
            $conn->query($insertcommission);
        }
        else{
            $lvlfivecom=0;
            $lvlfivecusid=0;
        }

        if(!empty($lvl6)){
            $sqlcuslvlsix="SELECT `idtbl_customer` FROM `tbl_customer` WHERE `refcode`='$lvl6'";
            $resultcuslvlsix=$conn->query($sqlcuslvlsix);
            $rowcuslvlsix=$resultcuslvlsix->fetch_assoc();

            $lvlsixcom=$ordertotal*2.5/100;
            $lvlsixcusid=$rowcuslvlsix['idtbl_customer'];

            $commkey=md5($orderid.'_'.$lvlsixcusid);

            $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$lvlsixcusid','6','$lvlsixcom','1','$updatedatetime','$userID')";
            $conn->query($insertcommission);
        }
        else{
            $lvlsixcom=0;
            $lvlsixcusid=0;
        }

        if($dropshipstatus==1){
            $dropshipcom=$discount;
            $dropshipcusid=$cusID;

            $commkey=md5($orderid.'_'.$dropshipcusid);

            $insertcommission="INSERT INTO `tbl_cutomer_commission`(`orderid`, `commkey`, `orderdate`, `customerid`, `level`, `commission`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$orderid','$commkey','$orderdate','$dropshipcusid','0','$dropshipcom','1','$updatedatetime','$userID')";
            $conn->query($insertcommission);
        }
        else{
            $dropshipcom=0;
            $dropshipcusid=0;
        }      
    }
    // Commision Calculation End
}