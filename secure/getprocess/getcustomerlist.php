<?php
session_start();
require_once('../../connection/db.php');

ini_set('max_execution_time', 3600); //3600 seconds = 60 minutes

$userID=$_SESSION['userid'];
$searchTerm=$_POST["searchTerm"];

if(!isset($searchTerm)){
    $sqlcustomer="SELECT `idtbl_customer`, `firstname`, `lastname` FROM `tbl_customer` WHERE `status`=1 ORDER BY `idtbl_customer` ASC LIMIT 5";
    $resultcustomer=$conn->query($sqlcustomer);
}
else{
    if(!empty($searchTerm)){
        $sqlcustomer="SELECT `idtbl_customer`, `firstname`, `lastname` FROM `tbl_customer` WHERE `status`=1 AND `firstname` LIKE '$searchTerm%'";
        $resultcustomer=$conn->query($sqlcustomer);
    }
    else{
        $sqlcustomer="SELECT `idtbl_customer`, `firstname`, `lastname` FROM `tbl_customer` WHERE `status`=1 ORDER BY `idtbl_customer` ASC LIMIT 5";
        $resultcustomer=$conn->query($sqlcustomer);
    }
}

$data=array();

while($rowcustomer=$resultcustomer->fetch_assoc()) {
    $data[]=array("id"=>$rowcustomer['idtbl_customer'], "text"=>$rowcustomer['firstname'].' '.$rowcustomer['lastname']);
}

echo json_encode($data);