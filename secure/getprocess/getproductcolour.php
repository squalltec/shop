<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_product_colour` WHERE `idtbl_product_colour`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->id=$row['idtbl_product_colour'];
$obj->colour=$row['colour'];

echo json_encode($obj);
?>