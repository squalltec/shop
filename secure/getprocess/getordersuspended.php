<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_order_suspended_days` WHERE `idtbl_order_suspended_days`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->id=$row['idtbl_order_suspended_days'];
$obj->from=$row['from'];
$obj->to=$row['to'];
$obj->reason=$row['reason'];

echo json_encode($obj);
?>