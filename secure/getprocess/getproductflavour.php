<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_product_flavour` WHERE `idtbl_product_flavour`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->id=$row['idtbl_product_flavour'];
$obj->flavour=$row['flavour'];

echo json_encode($obj);
?>