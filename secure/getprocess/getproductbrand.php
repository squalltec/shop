<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_product_brand` WHERE `idtbl_product_brand`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->id=$row['idtbl_product_brand'];
$obj->brand=$row['brand'];

echo json_encode($obj);
?>