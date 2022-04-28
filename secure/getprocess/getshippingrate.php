<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_ship_rate` WHERE `idtbl_ship_rate`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->id=$row['idtbl_ship_rate'];
$obj->country=$row['country'];
$obj->costalarea=$row['costalarea'];
$obj->amount=$row['amount'];
$obj->addkg=$row['addkg'];

echo json_encode($obj);
?>