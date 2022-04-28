<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');
$userID=$_SESSION['userid'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$shipcost=addslashes($_POST['shipcost']);
$addkg=addslashes($_POST['addkg']);
$coastalarea=$_POST['coastalarea'];
$country=$_POST['country'];
$updatedatetime=date('Y-m-d h:i:s');

if($recordOption==1){
    $insert="INSERT INTO `tbl_ship_rate`(`country`, `costalarea`, `amount`, `addkg`, `status`, `insertuser`, `insertdatetime`, `updateuser`, `updatedatetime`) VALUES ('$country','$coastalarea','$shipcost','$addkg','1','$userID','$updatedatetime','','')";
    if($conn->query($insert)==true){        
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-save';
        $actionObj->title='';
        $actionObj->message='Record Added Successfully';
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
else{
    $update="UPDATE `tbl_ship_rate` SET `country`='$country',`costalarea`='$coastalarea',`amount`='$shipcost',`addkg`='$addkg',`updateuser`='$userID',`updatedatetime`='$updatedatetime' WHERE `idtbl_ship_rate`='$recordID'";
    if($conn->query($update)==true){     
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-save';
        $actionObj->title='';
        $actionObj->message='Record Update Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='primary';

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
?>