<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'tbl_cutomer_commission';

// Table's primary key
$primaryKey = 'idtbl_cutomer_commission';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`u`.`customerid`', 'dt' => 'customerid', 'field' => 'customerid' ),
	array( 'db' => '`ua`.`firstname`', 'dt' => 'firstname', 'field' => 'firstname' ),
	array( 'db' => '`ua`.`lastname`', 'dt' => 'lastname', 'field' => 'lastname' ),
	array( 'db' => '`u`.`lvl2totcom`', 'dt' => 'lvl2totcom', 'field' => 'lvl2totcom' ),
	array( 'db' => '`ub`.`lvl3totcom`', 'dt' => 'lvl3totcom', 'field' => 'lvl3totcom' ),
	array( 'db' => '`uc`.`lvl4totcom`', 'dt' => 'lvl4totcom', 'field' => 'lvl4totcom' ),
	array( 'db' => '`ud`.`lvl5totcom`', 'dt' => 'lvl5totcom', 'field' => 'lvl5totcom' ),
	array( 'db' => '`ue`.`lvl6totcom`', 'dt' => 'lvl6totcom', 'field' => 'lvl6totcom' ),
	array( 'db' => '`uf`.`lvldrop`', 'dt' => 'lvldrop', 'field' => 'lvldrop' ),
	array( 'db' => '`ug`.`returnprice`', 'dt' => 'returnprice', 'field' => 'returnprice' ),
	array( 'db' => '`uh`.`accountname`', 'dt' => 'accountname', 'field' => 'accountname' ),
	array( 'db' => '`uh`.`accountno`', 'dt' => 'accountno', 'field' => 'accountno' ),
	array( 'db' => '`uh`.`bankcode`', 'dt' => 'bankcode', 'field' => 'bankcode' ),
	array( 'db' => '`uh`.`branchcode`', 'dt' => 'branchcode', 'field' => 'branchcode' ),
	array( 'db' => '`uh`.`bank`', 'dt' => 'bank', 'field' => 'bank' ),
	array( 'db' => '`uh`.`branch`', 'dt' => 'branch', 'field' => 'branch' )
);

// SQL server connection information
require('config.php');
$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];

$joinQuery = "FROM 
(SELECT `customerid`, `level`, SUM(`commission`) AS `lvl2totcom`, `status` FROM `tbl_cutomer_commission` WHERE `status`=1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level`=2 GROUP BY `customerid` ORDER BY `customerid` ASC) `u` 
LEFT JOIN `tbl_customer` AS `ua` ON `ua`.`idtbl_customer`=`u`.`customerid`
LEFT JOIN (SELECT `customerid`, `level`, SUM(`commission`) AS `lvl3totcom`, `status` FROM `tbl_cutomer_commission` WHERE `status`=1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level`=3 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ub`
ON `ub`.`customerid`=`u`.`customerid`
LEFT JOIN (SELECT `customerid`, `level`, SUM(`commission`) AS `lvl4totcom`, `status` FROM `tbl_cutomer_commission` WHERE `status`=1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level`=4 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `uc`
ON `uc`.`customerid`=`u`.`customerid`
LEFT JOIN (SELECT `customerid`, `level`, SUM(`commission`) AS `lvl5totcom`, `status` FROM `tbl_cutomer_commission` WHERE `status`=1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level`=5 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ud`
ON `ud`.`customerid`=`u`.`customerid`
LEFT JOIN (SELECT `customerid`, `level`, SUM(`commission`) AS `lvl6totcom`, `status` FROM `tbl_cutomer_commission` WHERE `status`=1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level`=6 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `ue`
ON `ue`.`customerid`=`u`.`customerid`
LEFT JOIN (SELECT `customerid`, `level`, SUM(`commission`) AS `lvldrop`, `status` FROM `tbl_cutomer_commission` WHERE `status`=1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' AND `level`=0 GROUP BY `customerid` ORDER BY `customerid` ASC) AS `uf`
ON `uf`.`customerid`=`u`.`customerid`
LEFT JOIN (SELECT SUM(`returnprice`) AS `returnprice`, `tbl_customer_idtbl_customer` FROM `tbl_order_return` WHERE `status`=1 AND `orderdate` BETWEEN '$fromdate' AND '$todate' GROUP BY `tbl_customer_idtbl_customer`) AS `ug` 
ON `ug`.`tbl_customer_idtbl_customer`=`u`.`customerid`
LEFT JOIN `tbl_customer_bank` AS `uh` ON `uh`.`tbl_customer_idtbl_customer`=`u`.`customerid`";

$extraWhere = "`u`.`status`='1'";

echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
