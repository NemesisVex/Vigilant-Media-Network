<?php
/**
 * Project: Vigilante
 * File: env.php
 *
 * The ENVIRONMENT constant determines under which development environment
 * the entire site runs. Possible options:
 *
 * dev
 * For a local environment in which scripts use a development database.
 *
 * test
 * For a test environment in which scripts are tested with a production database.
 * Currently not supported.
 *
 * prod
 * For a production environment in which scripts uses a production database.
 *
 * @author Greg Bueno <nemesisv@io.com>
 */

define('ENVIRONMENT', "dev");
//define('ENVIRONMENT', "test");
//define('ENVIRONMENT', "prod");
?>