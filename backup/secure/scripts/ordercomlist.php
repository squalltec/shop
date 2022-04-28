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
	array( 'db' => '`u`.`idtbl_cutomer_commission`', 'dt' => 'idtbl_cutomer_commission', 'field' => 'idtbl_cutomer_commission' ),
	array( 'db' => '`u`.`orderid`', 'dt' => 'orderid', 'field' => 'orderid' ),
	array( 'db' => '`u`.`orderdate`', 'dt' => 'orderdate', 'field' => 'orderdate' ),
	array( 'db' => '`u`.`level`', 'dt' => 'level', 'field' => 'level' ),
	array( 'db' => '`u`.`commission`', 'dt' => 'commission', 'field' => 'commission' ),
	array( 'db' => '`ud`.`firstname`', 'dt' => 'firstname', 'field' => 'firstname' ),
	array( 'db' => '`ud`.`lastname`', 'dt' => 'lastname', 'field' => 'lastname' )
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

$joinQuery = "FROM `tbl_cutomer_commission` AS `u` JOIN `tbl_customer` AS `ud` ON (`ud`.`idtbl_customer` = `u`.`customerid`)";

$extraWhere = "`u`.`status`=1";

echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
