<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:../index.php");}
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];
$record=$_GET['record'];
$type=$_GET['type'];

if($type==1){$value=1;}
else if($type==2){$value=2;}
else if($type==3){$value=3;}

$sql="UPDATE `tbl_product` SET `status`='$value',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_product`='$record'";
if($conn->query($sql)==true){header("Location:../product.php?action=$type");}
else{header("Location:../product.php?action=5");}
?>