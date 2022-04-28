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
    $sql="UPDATE `tbl_order` SET `paystatus`='1',`updatedatetime`='$updatedatetime',`updateuser`='$userID' WHERE `idtbl_order`='$record'";
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
    $sql="UPDATE `tbl_order` SET `shipstatus`='1',`updatedatetime`='$updatedatetime',`updateuser`='$userID' WHERE `idtbl_order`='$record'";
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
    $sql="UPDATE `tbl_order` SET `deliverystatus`='1',`updatedatetime`='$updatedatetime',`updateuser`='$userID' WHERE `idtbl_order`='$record'";
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
    $sql="UPDATE `tbl_order` SET `status`='2',`cancelreason`='$cancelreason',`updatedatetime`='$updatedatetime',`updateuser`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        header("Location:../orderlist.php?action=7");
    }
    else{header("Location:../orderlist.php?action=5");}
}
else if($type==5){
    $sql="UPDATE `tbl_order` SET `acceptstatus`='1',`updatedatetime`='$updatedatetime',`updateuser`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
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
    $sql="UPDATE `tbl_order` SET `callstatus`='1',`updatedatetime`='$updatedatetime',`updateuser`='$userID' WHERE `idtbl_order`='$record'";
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
    $sql="UPDATE `tbl_order` SET `status`='1',`updatedatetime`='$updatedatetime',`updateuser`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        $sqlreturn="UPDATE `tbl_order_return` SET `status`='2',`updatedatetime`='$updatedatetime',`updateuser`='$userID' WHERE `tbl_order_idtbl_order`='$record'";
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
    $sql="UPDATE `tbl_order` SET `returnstatus`='1',`status`='2',`updatedatetime`='$updatedatetime',`updateuser`='$userID' WHERE `idtbl_order`='$record'";
    if($conn->query($sql)==true){
        $sqlorder="SELECT `idtbl_order`, `orderdate`, `total`, `discount`, `dropdiscountstatus`, `tbl_customer_idtbl_customer` FROM `tbl_order` WHERE `idtbl_order`='$record'";
        $resultorder=$conn->query($sqlorder);
        $roworder=$resultorder->fetch_assoc();

        $customerID=$roworder['tbl_customer_idtbl_customer'];
        $orderdate=$roworder['orderdate'];
        $returndate=date('Y-m-d');

        $insertreturn="INSERT INTO `tbl_order_return`(`returndate`, `orderdate`, `comment`, `returnconfirm`, `status`, `insertuser`, `insertdatetime`, `updateuser`, `updatedatetime`, `tbl_order_idtbl_order`, `tbl_customer_idtbl_customer`) VALUES ('$returndate','$orderdate','$returnreason','$returnprice','1','$userID','$updatedatetime','','','$record','$customerID')";
        $conn->query($insertreturn);
        
        header("Location:../orderlist.php?action=8");
    }
    else{header("Location:../orderlist.php?action=5");}
}

?>