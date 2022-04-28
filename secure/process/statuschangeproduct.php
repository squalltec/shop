<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:../index.php");}
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];
$record=$_GET['record'];
$type=$_GET['type'];

if($type==1){
    $sql="UPDATE `tbl_product` SET `disstatus`='0',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_product`='$record'";
    if($conn->query($sql)==true){header("Location:../product.php");}
    else{header("Location:../product.php?action=5");}
}
else if($type==2){
    $sql="UPDATE `tbl_product` SET `disstatus`='1',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_product`='$record'";
    if($conn->query($sql)==true){header("Location:../product.php");}
    else{header("Location:../product.php?action=5");}
}
else if($type==3){
    $sql="UPDATE `tbl_product` SET `newstatus`='0',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_product`='$record'";
    if($conn->query($sql)==true){header("Location:../product.php");}
    else{header("Location:../product.php?action=5");}
}
else if($type==4){
    $sql="UPDATE `tbl_product` SET `newstatus`='1',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_product`='$record'";
    if($conn->query($sql)==true){header("Location:../product.php");}
    else{header("Location:../product.php?action=5");}
}
else if($type==5){
    $sql="UPDATE `tbl_product` SET `weekstatus`='0',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_product`='$record'";
    if($conn->query($sql)==true){header("Location:../product.php");}
    else{header("Location:../product.php?action=5");}
}
else if($type==6){
    $sql="UPDATE `tbl_product` SET `weekstatus`='1',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_product`='$record'";
    if($conn->query($sql)==true){header("Location:../product.php");}
    else{header("Location:../product.php?action=5");}
}
else if($type==7){
    $sql="UPDATE `tbl_product` SET `topstatus`='0',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_product`='$record'";
    if($conn->query($sql)==true){header("Location:../product.php");}
    else{header("Location:../product.php?action=5");}
}
else if($type==8){
    $sql="UPDATE `tbl_product` SET `topstatus`='0',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_product`='$record'";
    if($conn->query($sql)==true){header("Location:../product.php");}
    else{header("Location:../product.php?action=5");}
}
?>