<?php 
require_once('../../connection/db.php');

$categoryID=$_POST['categoryID'];

$sql="SELECT `idtbl_product_sub_category`, `subcategory` FROM `tbl_product_sub_category` WHERE `status`=1 AND `tbl_product_category_idtbl_product_category`='$categoryID'";
$result=$conn->query($sql);

$arraylist=array();
while($row=$result->fetch_assoc()){
    $obj=new stdClass();
    $obj->subcateid=$row['idtbl_product_sub_category'];
    $obj->subcate=$row['subcategory'];
    
    array_push($arraylist, $obj);
}

echo json_encode($arraylist);
?>