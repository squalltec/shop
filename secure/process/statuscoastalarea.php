<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:../index.php");}
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];
$updatedatetime=date('Y-m-d h:i:s');

$record=$_GET['record'];
$type=$_GET['type'];

if($type==1){$value=1;}
else if($type==2){$value=2;}
else if($type==3){$value=3;}

$sql="UPDATE `tbl_coastalarea` SET `status`='$value' WHERE `idtbl_coastalarea`='$record'";
if($conn->query($sql)==true){header("Location:../coastalarea.php?action=$type");}
else{header("Location:../coastalarea.php?action=5");}
?>