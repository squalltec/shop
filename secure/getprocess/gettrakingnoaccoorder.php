<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT `trackingno`, trackingweb FROM `tbl_order` WHERE `idtbl_order`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->trackingno=$row['trackingno'];
$obj->trackingweb=$row['trackingweb'];

echo json_encode($obj);

?>