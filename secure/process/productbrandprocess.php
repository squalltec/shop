<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');
$userID=$_SESSION['userid'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$productbrand=addslashes($_POST['productbrand']);
$updatedatetime=date('Y-m-d h:i:s');

if($recordOption==1){
    $insert="INSERT INTO `tbl_product_brand`(`brand`, `status`, `insertuser`, `insertdatetime`, `updateuser`, `updatedatetime`) VALUES ('$productbrand','1','$userID','$updatedatetime','','')";
    if($conn->query($insert)==true){        
        header("Location:../productbrand.php?action=4");
    }
    else{header("Location:../productbrand.php?action=5");}
}
else{
    $update="UPDATE `tbl_product_brand` SET `brand`='$productbrand',`updateuser`='$userID',`updatedatetime`='$updatedatetime' WHERE `idtbl_product_brand`='$recordID'";
    if($conn->query($update)==true){     
        header("Location:../productbrand.php?action=6");
    }
    else{header("Location:../productbrand.php?action=5");}
}
?>