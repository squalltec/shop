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
$table = 'tbl_order';

// Table's primary key
$primaryKey = 'idtbl_order';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`u`.`idtbl_order`', 'dt' => 'idtbl_order', 'field' => 'idtbl_order' ),
	array( 'db' => '`u`.`orderdate`', 'dt' => 'orderdate', 'field' => 'orderdate' ),
	array( 'db' => '`u`.`nettotal`', 'dt' => 'nettotal', 'field' => 'nettotal' ),
	array( 'db' => '`u`.`total`', 'dt' => 'total', 'field' => 'total' ),
	array( 'db' => '`u`.`paystatus`', 'dt' => 'paystatus', 'field' => 'paystatus' ),
	array( 'db' => '`u`.`shipstatus`', 'dt' => 'shipstatus', 'field' => 'shipstatus' ),
	array( 'db' => '`u`.`deliverystatus`', 'dt' => 'deliverystatus', 'field' => 'deliverystatus' ),
	array( 'db' => '`u`.`status`', 'dt' => 'status', 'field' => 'status' ),
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

$joinQuery = "FROM `tbl_order` AS `u` JOIN `tbl_customer` AS `ud` ON (`ud`.`idtbl_customer` = `u`.`tbl_customer_idtbl_customer`)";

$monthID=$_POST['monthID'];
$userID=$_POST['userID'];
if($userID==1){
    $extraWhere = "`u`.`status` IN (1, 2) AND MONTH(`u`.`orderdate`)='$monthID'";
}
else{
    $extraWhere = "`u`.`status` IN (1, 2) AND MONTH(`u`.`orderdate`)='$monthID'";
}

echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
