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
else if($type==3){
    $value=3;
    
    $sqlimage="SELECT `imagepath` FROM `tbl_slideshow` WHERE `idtbl_slideshow`='$record'";
    $resultimage=$conn->query($sqlimage);
    $rowimage=$resultimage->fetch_assoc();

    $imagepath=$rowimage['imagepath'];

    unlink('../../'.$imagepath);
}

$sql="UPDATE `tbl_slideshow` SET `status`='$value',`updatedatetime`='$updatedatetime' WHERE `idtbl_slideshow`='$record'";
if($conn->query($sql)==true){header("Location:../slideshow.php?action=$type");}
else{header("Location:../slideshow.php?action=5");}
?>