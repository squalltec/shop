<?php 
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_user` WHERE `idtbl_user`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$sqlcompany="SELECT `tbl_company_idtbl_company` FROM `tbl_user_has_tbl_company` WHERE `tbl_user_idtbl_user`='$record'";
$resultcompany=$conn->query($sqlcompany);

$companyArray=array();
while($rowcompany=$resultcompany->fetch_assoc()){
    $objcompany=new stdClass();
    $objcompany->companyID=$rowcompany['tbl_company_idtbl_company'];
    array_push($companyArray, $objcompany);
}

$obj=new stdClass();
$obj->id=$row['idtbl_user'];
$obj->name=$row['name'];
$obj->mobile=$row['mobile'];
$obj->username=$row['username'];
$obj->type=$row['tbl_user_type_idtbl_user_type'];
$obj->company=$companyArray;

echo json_encode($obj);
?>