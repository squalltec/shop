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

$sql="UPDATE `tbl_user` SET `status`='$value',`updatedatetime`='$updatedatetime' WHERE `idtbl_user`='$record'";
if($conn->query($sql)==true){
    $sqlcustomer="UPDATE `tbl_customer` SET `status`='$value',`updatedatetime`='$updatedatetime' WHERE `tbl_user_idtbl_user`='$record'";
    $conn->query($sqlcustomer);
    header("Location:../useraccount.php?action=$type");
}
else{header("Location:../useraccount.php?action=5");}
?>