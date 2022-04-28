<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:../index.php");}
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];
$record=$_POST['imageID'];
$type=$_POST['type'];

$sqlimage="SELECT `imagepath` FROM `tbl_product_image` WHERE `idtbl_product_image`='$record'";
$resultimage=$conn->query($sqlimage);
$rowimage=$resultimage->fetch_assoc();

$imagepath=$rowimage['imagepath'];

unlink('../../'.$imagepath);
$deleteimage="DELETE FROM `tbl_product_image` WHERE `idtbl_product_image`='$record'";
$conn->query($deleteimage)

?>