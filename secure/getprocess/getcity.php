<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_city` WHERE `idtbl_city`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->id=$row['idtbl_city'];
$obj->city=$row['city'];
$obj->costalarea=$row['costalarea'];
$obj->country=$row['country'];

echo json_encode($obj);
?>