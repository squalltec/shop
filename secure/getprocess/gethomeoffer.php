<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_offer_image` WHERE `idtbl_offer_image`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$obj=new stdClass();
$obj->id=$row['idtbl_offer_image'];
$obj->offertype=$row['offertype'];
$obj->titleone=$row['titleone'];
$obj->titletwo=$row['titletwo'];
$obj->titlethree=$row['titlethree'];
$obj->titlefour=$row['titlefour'];
$obj->category=$row['tbl_product_category_idtbl_product_category'];

echo json_encode($obj);
?>