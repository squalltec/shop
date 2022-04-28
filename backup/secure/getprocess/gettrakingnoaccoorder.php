<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT `trackingnum` FROM `tbl_order` WHERE `idtbl_order`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

echo $row['trackingnum'];

?>