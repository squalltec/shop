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

if($type==4){
    $sqlimage="SELECT `frontimage` FROM `tbl_product_category` WHERE `idtbl_product_category`='$record'";
    $resultimage=$conn->query($sqlimage);
    $rowimage=$resultimage->fetch_assoc();

    $imagepath=$rowimage['frontimage'];

    unlink('../../'.$imagepath);

    $sql="UPDATE `tbl_product_category` SET `frontstatus`='0',`frontimage`='',`updateuser`='$userID',`updatedatetime`='$updatedatetime' WHERE `idtbl_product_category`='$record'";

    $type=2;
}
else{
    $sql="UPDATE `tbl_product_category` SET `status`='$value',`updateuser`='$userID',`updatedatetime`='$updatedatetime' WHERE `idtbl_product_category`='$record'";
}
if($conn->query($sql)==true){header("Location:../productcategory.php?action=$type");}
else{header("Location:../productcategory.php?action=5");}
?>