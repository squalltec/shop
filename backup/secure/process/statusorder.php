<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:../index.php");}
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];
if(!empty($_POST['recordreturnID'])){
    $record=$_POST['recordreturnID'];
    $returnprice=$_POST['returnprice'];
    $returnreason=$_POST['returnreason'];
}
else{
    $record=$_POST['recordID'];
}
$type=$_POST['type'];
$cancelreason=$_POST['cancelreason'];
$updatedatetime=date('Y-m-d h:i:s');

if($type==1){
    $sql="UPDATE `tbl_order` SET `paystatus`='1',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-check-circle';
        $actionObj->title='';
        $actionObj->message='Payment Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='success';

        echo $actionJSON=json_encode($actionObj);
    }
    else{
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-exclamation-triangle';
        $actionObj->title='';
        $actionObj->message='Record Error';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='danger';

        echo $actionJSON=json_encode($actionObj);
    }
}
else if($type==2){
    $sql="UPDATE `tbl_order` SET `shipstatus`='1',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-check-circle';
        $actionObj->title='';
        $actionObj->message='Shiped Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='success';

        echo $actionJSON=json_encode($actionObj);
    }
    else{
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-exclamation-triangle';
        $actionObj->title='';
        $actionObj->message='Record Error';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='danger';

        echo $actionJSON=json_encode($actionObj);
    }
}
else if($type==3){
    $sql="UPDATE `tbl_order` SET `deliverystatus`='1',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-check-circle';
        $actionObj->title='';
        $actionObj->message='Delivery Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='success';

        echo $actionJSON=json_encode($actionObj);
    }
    else{
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-exclamation-triangle';
        $actionObj->title='';
        $actionObj->message='Record Error';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='danger';

        echo $actionJSON=json_encode($actionObj);
    }
}
else if($type==4){
    $sql="UPDATE `tbl_order` SET `status`='2',`cancelreason`='$cancelreason',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        $sqlcommission="UPDATE `tbl_cutomer_commission` SET `status`='2',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `orderid`='$record'";
        $conn->query($sqlcommission);

        header("Location:../orderlist.php?action=7");
    }
    else{header("Location:../orderlist.php?action=5");}
}
else if($type==5){
    mysqli_rollback($conn);

    $sql="UPDATE `tbl_order` SET `acceptstatus`='1',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        // Commision Calculation Start
        $sqlorder="SELECT `idtbl_order`, `orderdate`, `total`, `discount`, `dropdiscountstatus`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `idtbl_order`='$record'";
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
                if($conn->query($insertcommission)==true){}
                else{
                    mysqli_rollback($conn);

                    $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
                    $conn->query($sql);
                }
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
                if($conn->query($insertcommission)==true){}
                else{
                    mysqli_rollback($conn);

                    $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
                    $conn->query($sql);
                }
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
                if($conn->query($insertcommission)==true){}
                else{
                    mysqli_rollback($conn);

                    $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
                    $conn->query($sql);
                }
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
                if($conn->query($insertcommission)==true){}
                else{
                    mysqli_rollback($conn);

                    $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
                    $conn->query($sql);
                }
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
                if($conn->query($insertcommission)==true){}
                else{
                    mysqli_rollback($conn);

                    $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
                    $conn->query($sql);
                }
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
                if($conn->query($insertcommission)==true){}
                else{
                    mysqli_rollback($conn);

                    $sql="UPDATE `tbl_order` SET `acceptstatus`='0' WHERE `idtbl_order`='$record'";
                    $conn->query($sql);
                }
            }
            else{
                $dropshipcom=0;
                $dropshipcusid=0;
            }      
        }
        // Commision Calculation End

        $actionObj=new stdClass();
        $actionObj->icon='fas fa-check';
        $actionObj->title='';
        $actionObj->message='Order Accept Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='success';

        echo $actionJSON=json_encode($actionObj);
    }
    else{
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-exclamation-triangle';
        $actionObj->title='';
        $actionObj->message='Record Error';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='danger';

        echo $actionJSON=json_encode($actionObj);
    }
}
else if($type==6){
    $sql="UPDATE `tbl_order` SET `callstatus`='1',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-check-circle';
        $actionObj->title='';
        $actionObj->message='Delivery Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='success';

        echo $actionJSON=json_encode($actionObj);
    }
    else{
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-exclamation-triangle';
        $actionObj->title='';
        $actionObj->message='Record Error';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='danger';

        echo $actionJSON=json_encode($actionObj);
    }
}
else if($type==7){
    $sql="UPDATE `tbl_order` SET `status`='1',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        $sqlcommission="UPDATE `tbl_cutomer_commission` SET `status`='1',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `orderid`='$record'";
        $conn->query($sqlcommission);

        $sqlreturn="UPDATE `tbl_order_return` SET `status`='2',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `tbl_order_idtbl_order`='$record'";
        $conn->query($sqlreturn);

        $actionObj=new stdClass();
        $actionObj->icon='fas fa-check-circle';
        $actionObj->title='';
        $actionObj->message='Reactive Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='success';

        echo $actionJSON=json_encode($actionObj);
    }
    else{
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-exclamation-triangle';
        $actionObj->title='';
        $actionObj->message='Record Error';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='danger';

        echo $actionJSON=json_encode($actionObj);
    }
}
else if($type==8){
    $sql="UPDATE `tbl_order` SET `returnstatus`='1',`status`='2',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        $sqlcommission="UPDATE `tbl_cutomer_commission` SET `status`='2',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `orderid`='$record'";
        $conn->query($sqlcommission);

        $sqlorder="SELECT `idtbl_order`, `orderdate`, `total`, `discount`, `dropdiscountstatus`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `idtbl_order`='$record'";
        $resultorder=$conn->query($sqlorder);
        $roworder=$resultorder->fetch_assoc();

        $customerID=$roworder['tbl_customer_idtbl_customer'];
        $orderdate=$roworder['orderdate'];
        $returndate=date('Y-m-d');

        $insertreturn="INSERT INTO `tbl_order_return`(`returndate`, `orderdate`, `comment`, `returnprice`, `status`, `updatedatetime`, `tbl_order_idtbl_order`, `tbl_user_idtbl_user`, `tbl_customer_idtbl_customer`) VALUES ('$returndate','$orderdate','$returnreason','$returnprice','1','$updatedatetime','$record','$userID','$customerID')";
        $conn->query($insertreturn);
        
        header("Location:../orderlist.php?action=8");
    }
    else{header("Location:../orderlist.php?action=5");}
}

?>