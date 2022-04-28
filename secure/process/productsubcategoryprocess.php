<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');
$userID=$_SESSION['userid'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$productcategory=$_POST['productcategory'];
$productsubcategory=addslashes($_POST['productsubcategory']);
$updatedatetime=date('Y-m-d h:i:s');

if($recordOption==1){
    $insert="INSERT INTO `tbl_product_sub_category`(`subcategory`, `status`, `insertuser`, `insertdatetime`, `updateuser`, `updatedatetime`, `tbl_product_category_idtbl_product_category`) VALUES ('$productsubcategory','1','$userID','$updatedatetime','','','$productcategory')";
    if($conn->query($insert)==true){        
        header("Location:../productsubcategory.php?action=4");
    }
    else{header("Location:../productsubcategory.php?action=5");}
}
else{
    $update="UPDATE `tbl_product_sub_category` SET `subcategory`='$productsubcategory',`updateuser`='$userID',`updatedatetime`='$updatedatetime',`tbl_product_category_idtbl_product_category`='$productcategory' WHERE `idtbl_product_sub_category`='$recordID'";
    if($conn->query($update)==true){     
        header("Location:../productsubcategory.php?action=6");
    }
    else{header("Location:../productsubcategory.php?action=5");}
}
?>