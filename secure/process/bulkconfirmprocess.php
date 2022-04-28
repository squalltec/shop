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
}