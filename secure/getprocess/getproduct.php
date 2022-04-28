<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_product` WHERE `idtbl_product`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$sqlcolour="SELECT `tbl_product_colour_idtbl_product_colour` FROM `tbl_product_has_tbl_product_colour` WHERE `tbl_product_idtbl_product`='$record'";
$resultcolour=$conn->query($sqlcolour);

$colourlistArray=array();
while($rowcolour=$resultcolour->fetch_assoc()){
    $objcolour=new stdClass();
    $objcolour->colourid=$rowcolour['tbl_product_colour_idtbl_product_colour'];
    array_push($colourlistArray, $objcolour);
}

$sqlflavour="SELECT `tbl_product_flavour_idtbl_product_flavour` FROM `tbl_product_has_tbl_product_flavour` WHERE `tbl_product_idtbl_product`='$record'";
$resultflavour=$conn->query($sqlflavour);

$flavourlistArray=array();
while($rowflavour=$resultflavour->fetch_assoc()){
    $objflavour=new stdClass();
    $objflavour->flavourid=$rowflavour['tbl_product_flavour_idtbl_product_flavour'];
    array_push($flavourlistArray, $objflavour);
}

$obj=new stdClass();
$obj->id=$row['idtbl_product'];
$obj->productname=$row['productname'];
$obj->shortdesc=$row['shortdesc'];
$obj->desc=$row['desc'];
$obj->barcode=$row['barcode'];
$obj->weight=$row['weight'];
$obj->stock=$row['stock'];
$obj->customcode=$row['customcode'];
// $obj->specification=$row['specification'];
$obj->price=$row['price'];
$obj->disprice=$row['disprice'];
$obj->disfrom=$row['disfrom'];
$obj->disto=$row['disto'];
$obj->videolink=$row['videolink'];
$obj->category=$row['tbl_product_category_idtbl_product_category'];
$obj->subcategory=$row['tbl_product_sub_category_idtbl_product_sub_category'];
$obj->brand=$row['brand'];
$obj->colour=$colourlistArray;
$obj->flavour=$flavourlistArray;

echo json_encode($obj);
?>