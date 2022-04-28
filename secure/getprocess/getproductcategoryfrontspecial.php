<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT `frontimage`, `frontstatus`, `titleone`, `titletwo`, `titlethree` FROM `tbl_product_category` WHERE `idtbl_product_category`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

if($row['frontstatus']==1){
    $obj=new stdClass();
    $obj->status=1;
    $obj->titleone=$row['titleone'];
    $obj->titletwo=$row['titletwo'];
    $obj->titlethree=$row['titlethree'];
    $obj->imagepath=$row['frontimage'];
}
else{
    $obj=new stdClass();
    $obj->status=0;
    $obj->imagepath='';
    $obj->titleone='';
    $obj->titletwo='';
    $obj->titlethree='';
}

echo json_encode($obj);
?>