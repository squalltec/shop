<?php 
require_once('../../connection/db.php');

$sql="SELECT `idtbl_product_brand`, `brand` FROM `tbl_product_brand` WHERE `status`=1";
$result=$conn->query($sql);

$arraylist=array();
while($row=$result->fetch_assoc()){
    $obj=new stdClass();
    $obj->brandid=$row['idtbl_product_brand'];
    $obj->brand=$row['brand'];
    
    array_push($arraylist, $obj);
}

echo json_encode($arraylist);
?>