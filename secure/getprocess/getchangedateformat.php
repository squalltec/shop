<?php
session_start();
require_once('../../connection/db.php');

$paymonth=date("Y M", strtotime($_POST['fromdate']));
$paiddate=date("ym").'05';

$array=array();

$obj=new stdClass();
$obj->paymonth=$paymonth;
$obj->paiddate=$paiddate;

array_push($array, $obj);
echo json_encode($array);