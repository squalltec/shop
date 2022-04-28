<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');
$userID=$_SESSION['userid'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$reason=$_POST['reason'];
$updatedatetime=date('Y-m-d h:i:s');

if($recordOption==1){
    $insert="INSERT INTO `tbl_order_suspended_days`(`from`, `to`, `reason`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) VALUES ('$fromdate','$todate','$reason','1','$updatedatetime','$userID')";
    if($conn->query($insert)==true){        
        header("Location:../ordersuspended.php?action=4");
    }
    else{header("Location:../ordersuspended.php?action=5");}
}
else{
    $update="UPDATE `tbl_order_suspended_days` SET `from`='$fromdate',`to`='$todate',`reason`='$reason',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_order_suspended_days`='$recordID'";
    if($conn->query($update)==true){     
        header("Location:../ordersuspended.php?action=6");
    }
    else{header("Location:../ordersuspended.php?action=5");}
}
?>