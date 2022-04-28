<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT `tbl_customer`.`phone`, `tbl_order`.`trackingnum`, `tbl_order`.`trackingwebsite` FROM `tbl_order` LEFT JOIN `tbl_customer` ON `tbl_customer`.`idtbl_customer`=`tbl_order`.`tbl_customer_idtbl_customer` WHERE `tbl_order`.`idtbl_order`='$record' AND `tbl_order`.`status`=1";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$msg='Your Order is posted. Tracking No : '.$row['trackingnum'].' url '.$row['trackingwebsite'];

$obj=new stdClass();
$obj->mobile=substr($row['phone'],1);
$obj->msg=$msg;

echo json_encode($obj);
?>