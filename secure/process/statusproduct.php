<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:../index.php");}
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];
$record=$_GET['record'];
$type=$_GET['type'];

$updatedatetime=date('Y-m-d h:i:s');

if($type==1){$value=1;}
else if($type==2){$value=2;}
else if($type==3){$value=3;}

$sql="UPDATE `tbl_product` SET `status`='$value',`updateuser`='$userID', `updatedatetime`='$updatedatetime' WHERE `idtbl_product`='$record'";
if($conn->query($sql)==true){
    if($type==1){
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-check-circle';
        $actionObj->title='';
        $actionObj->message='Record Activate Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='success';

        echo $actionJSON=json_encode($actionObj);
    }
    else if($type==2){
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-times-circle';
        $actionObj->title='';
        $actionObj->message='Record Deativate Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='warning';

        echo $actionJSON=json_encode($actionObj);
    }
    else if($type==3){
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-trash-alt';
        $actionObj->title='';
        $actionObj->message='Record Delete Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='danger';

        echo $actionJSON=json_encode($actionObj);
    }
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
?>