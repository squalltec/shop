<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_slideshow` WHERE `idtbl_slideshow`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->id=$row['idtbl_slideshow'];
$obj->titleone=$row['titleone'];
$obj->titletwo=$row['titletwo'];
$obj->titlethree=$row['titlethree'];
$obj->category=$row['tbl_product_category_idtbl_product_category'];

echo json_encode($obj);
?>