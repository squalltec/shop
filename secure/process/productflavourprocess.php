<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');
$userID=$_SESSION['userid'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$productflavour=addslashes($_POST['productflavour']);
$updatedatetime=date('Y-m-d h:i:s');

if($recordOption==1){
    $insert="INSERT INTO `tbl_product_flavour`(`flavour`, `status`, `insertuser`, `insertdatetime`, `updateuser`, `updatedatetime`) VALUES ('$productflavour','1','$userID','$updatedatetime','','')";
    if($conn->query($insert)==true){        
        header("Location:../productflavour.php?action=4");
    }
    else{header("Location:../productflavour.php?action=5");}
}
else{
    $update="UPDATE `tbl_product_flavour` SET `flavour`='$productflavour',`updateuser`='$userID',`updatedatetime`='$updatedatetime' WHERE `idtbl_product_flavour`='$recordID'";
    if($conn->query($update)==true){     
        header("Location:../productflavour.php?action=6");
    }
    else{header("Location:../productflavour.php?action=5");}
}
?>