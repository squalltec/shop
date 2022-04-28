<?php 
ini_set('max_execution_time', 6200); //3600 seconds = 60 minutes
session_start();
if(!isset($_SESSION['userid'])){header ("Location:../index.php");}
require_once('../../connection/db.php');

$updatedatetime=date('Y-m-d h:i:s');
$userID=$_SESSION['userid'];

$date = new DateTime("now", new DateTimeZone('Asia/Colombo') );
$dateset=$date->format('Y-m-d H:i:s');

$showdate=date("Y-m", strtotime($dateset));
$startdate=$showdate.'-01';

$lastday = date('Y-m-t',strtotime($startdate));

$delete="DELETE FROM `tbl_customer_monthly_commission` WHERE `month`='$startdate'";
$conn->query($delete);

$insertdata="INSERT INTO `tbl_customer_monthly_commission`(`month`, `customerid`, `lvl2totcom`, `lvl3totcom`, `lvl4totcom`, `lvl5totcom`, `lvl6totcom`, `lvldrop`, `returnprice`, `status`, `updatedatetime`, `tbl_user_idtbl_user`) SELECT '$startdate' AS `month`, `ui`.`customerid`,`u`.`lvl2totcom`,`ub`.`lvl3totcom`,`uc`.`lvl4totcom`,`ud`.`lvl5totcom`,`ue`.`lvl6totcom`,`uf`.`lvldrop`,`ug`.`returnprice`, '1' AS `status`, '$updatedatetime' AS `dattime`, '$userID' AS `user` FROM (SELECT`customerid`,`status` FROM`tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$startdate' AND '$lastday' GROUP BY `customerid` ORDER BY`customerid` ASC) `ui` LEFT JOIN `tbl_customer` AS `ua` ON `ua`.`idtbl_customer` = `ui`.`customerid` LEFT JOIN (SELECT`customerid`,`level`,SUM(`commission`) AS `lvl2totcom`,`status` FROM`tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$startdate' AND '$lastday' AND `level` = 2 GROUP BY `customerid` ORDER BY`customerid` ASC) `u` ON `u`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl3totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$startdate' AND '$lastday' AND `level` = 3 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ub` ON `ub`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl4totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$startdate' AND '$lastday' AND `level` = 4 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `uc` ON `uc`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl5totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$startdate' AND '$lastday' AND `level` = 5 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ud` ON `ud`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvl6totcom`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$startdate' AND '$lastday' AND `level` = 6 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ue` ON `ue`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT `customerid`,`level`,SUM(`commission`) AS `lvldrop`,`status` FROM `tbl_cutomer_commission` WHERE `status` = 1 AND `orderdate` BETWEEN '$startdate' AND '$lastday' AND `level` = 0 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `uf` ON `uf`.`customerid` = `ui`.`customerid` LEFT JOIN (SELECT SUM(`returnprice`) AS `returnprice`,`tbl_customer_idtbl_customer` FROM `tbl_order_return` WHERE `status` = 1 AND `orderdate` BETWEEN '$startdate' AND '$lastday' GROUP BY `tbl_customer_idtbl_customer`) AS `ug` ON `ug`.`tbl_customer_idtbl_customer` = `ui`.`customerid` LEFT JOIN `tbl_customer_bank` AS `uh` ON `uh`.`tbl_customer_idtbl_customer` = `ui`.`customerid` WHERE `ui`.`status` = '1'";
if($conn->query($insertdata)==true){        
    header("Location:../dashboard.php?action=4");
}
else{header("Location:../dashboard.php?action=5");}