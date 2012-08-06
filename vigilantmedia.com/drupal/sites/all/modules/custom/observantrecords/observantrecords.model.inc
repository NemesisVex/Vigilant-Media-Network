<?php

/**
 * @file
 * A library to connect to the Observant Records database.
 *
 */

function observantrecords_db_init() {
	$database = array(
		'database' => 'observantrecords',
		'username' => 'eponymous4',
		'password' => '3825crux',
		'host' => 'mysql.eponymous4.com',
		'driver' => 'mysql'
	);

	Database::addConnectionInfo('ObservantRecordsDb', 'default', $database);
}

