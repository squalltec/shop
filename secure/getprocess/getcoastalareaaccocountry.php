<?php 
require_once('../../connection/db.php');

$countryID=$_POST['countryID'];

$sql="SELECT `idtbl_coastalarea`, `coastalarea` FROM `tbl_coastalarea` WHERE `tbl_country_idtbl_country`='$countryID' AND `status`=1";
$result=$conn->query($sql);

$arraylist=array();
while($row=$result->fetch_assoc()){
    $obj=new stdClass();
    $obj->coastalareaid=$row['idtbl_coastalarea'];
    $obj->coastalarea=$row['coastalarea'];
    
    array_push($arraylist, $obj);
}

echo json_encode($arraylist);
?>