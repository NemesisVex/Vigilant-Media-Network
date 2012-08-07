<?php

/**
 * @file
 * A library to connect to the Observant Records database.
 *
 */

function observantrecords_db_init() {
	$database_name = (ENVIRONMENT != 'production') ? 'observantrecords_dev' : 'observantrecords';
	$database = array(
		'database' => $database_name,
		'username' => 'eponymous4',
		'password' => '3825crux',
		'host' => 'mysql.eponymous4.com',
		'driver' => 'mysql'
	);

	Database::addConnectionInfo('ObservantRecordsDb', 'default', $database);
}

function observantrecords_get_artists() {
	observantrecords_db_init();

	db_set_active('ObservantRecordsDb');
	$results = db_select('ep4_artists', 'a')->fields('a')->orderBy('artist_last_name')->execute();
	db_set_active();

	return $results;
}