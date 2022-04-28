<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_coastalarea` WHERE `idtbl_coastalarea`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->id=$row['idtbl_coastalarea'];
$obj->coastalarea=$row['coastalarea'];
$obj->country=$row['tbl_country_idtbl_country'];

echo json_encode($obj);
?>