<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:../index.php");}
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];
$record=$_POST['imageID'];
$type=$_POST['type'];

$sqlimage="SELECT `imagepath` FROM `tbl_product_images` WHERE `idtbl_product_images`='$record'";
$resultimage=$conn->query($sqlimage);
$rowimage=$resultimage->fetch_assoc();

$imagepath=$rowimage['imagepath'];

unlink('../../'.$imagepath);
$deleteimage="DELETE FROM `tbl_product_images` WHERE `idtbl_product_images`='$record'";
$conn->query($deleteimage)

?>