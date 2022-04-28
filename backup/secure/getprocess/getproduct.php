<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_product` WHERE `idtbl_product`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->id=$row['idtbl_product'];
$obj->productname=$row['productname'];
$obj->shortdesc=$row['shortdesc'];
$obj->desc=$row['desc'];
$obj->specification=$row['specification'];
$obj->price=$row['price'];
$obj->category=$row['tbl_product_category_idtbl_product_category'];

echo json_encode($obj);
?>