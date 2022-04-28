<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');
$userID=$_SESSION['userid'];

$orderID=$_POST['orderID'];
$trackingcode=$_POST['trackingcode'];
$trackingurl=$_POST['trackingurl'];

$updatedatetime=date('Y-m-d h:i:s');

$update="UPDATE `tbl_order` SET `trackingno`='$trackingcode',`trackingweb`='$trackingurl',`updatedatetime`='$updatedatetime',`updateuser`='$userID' WHERE `idtbl_order`='$orderID'";
if($conn->query($update)==true){
    $actionObj=new stdClass();
    $actionObj->icon='fas fa-check';
    $actionObj->title='';
    $actionObj->message='Detail Update Successfully';
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
?>