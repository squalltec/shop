<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');
$userID=$_SESSION['userid'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$productcolour=addslashes($_POST['productcolour']);
$updatedatetime=date('Y-m-d h:i:s');

if($recordOption==1){
    $insert="INSERT INTO `tbl_product_colour`(`colour`, `status`, `insertuser`, `insertdatetime`, `updateuser`, `updatedatetime`) VALUES ('$productcolour','1','$userID','$updatedatetime','','')";
    if($conn->query($insert)==true){        
        header("Location:../productcolour.php?action=4");
    }
    else{header("Location:../productcolour.php?action=5");}
}
else{
    $update="UPDATE `tbl_product_colour` SET `colour`='$productcolour',`updateuser`='$userID',`updatedatetime`='$updatedatetime' WHERE `idtbl_product_colour`='$recordID'";
    if($conn->query($update)==true){     
        header("Location:../productcolour.php?action=6");
    }
    else{header("Location:../productcolour.php?action=5");}
}
?>