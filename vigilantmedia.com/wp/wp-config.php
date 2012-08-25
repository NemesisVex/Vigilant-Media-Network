<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// Read environment variable from file and determine connection settings.
require_once('environment.php');

switch(ENVIRONMENT) {
	case 'development':
		$env_db_name = VIGILANTMEDIA_WP_DB_DEVELOPMENT;
		$env_domain_current_site = 'wp.vigilantmedia.com';
		break;
	case 'testing':
		$env_db_name = VIGILANTMEDIA_WP_DB_TEST;
		$env_domain_current_site = 'wp-test.vigilantmedia.com';
		break;
	case 'production':
		$env_db_name = VIGILANTMEDIA_WP_DB_PRODUCTION;
		$env_domain_current_site = 'blog.vigilantmedia.com';
		break;
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define('DB_NAME', $env_db_name);

/** MySQL database username */
define('DB_USER', VIGILANTMEDIA_DB_USER);

/** MySQL database password */
define('DB_PASSWORD', VIGILANTMEDIA_DB_PASS);

/** MySQL hostname */
define('DB_HOST', VIGILANTMEDIA_DB_HOST);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Ei@IzT018PjkuFm0HciUcLRj?3M%)b+rEm|Lzau!u;e%0~+DjC2w/lhct:Mqg9zL');
define('SECURE_AUTH_KEY',  '/;|e`N4A:)U)zMAoqwY!?nM1gTuEsY+!M!9Je3b4jyA;P@;B+*c;Rj~+&XEb/fS|');
define('LOGGED_IN_KEY',    'rx3Zpqzub;pWuLV#tAnsZHeij!t7BPmb`#&nkxReQVHfx^o~P0ahUSK"xLwEMSux');
define('NONCE_KEY',        'f3)c9Cb)MhyTuEXA9Butu+RU@9&b~fc&^~i3zm/`/+!YpHb((6`0uxpZS@|PcSmn');
define('AUTH_SALT',        'pj!LENSXN?vHZk+XS7TQK~a0U`QR!c/^Lx$XI1TJAfq^+0@H@8EZGRT1tR)Rj9TN');
define('SECURE_AUTH_SALT', 'DRbKgKd`~v|7GN2fnn#qVqwX%`uhf#&)Q#f@4vihJqyD$0Fin^dt*^t9j"Oms@)w');
define('LOGGED_IN_SALT',   'B8Z6We7b*xr$Kr~9wCrGGOLL:;h|&VtLVeIhY%JY689&8(~Nl^NiCeZkadiKqelu');
define('NONCE_SALT',       '"Ur;"ZonWBad_GUmMVGg~USv8Zh7+D8CT"xi/S"kU(bhw7CglFUVbUq%8*fhu4!v');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_urg3mi_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/**
 * Network configuration.
 */
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
$base = '/';
define('DOMAIN_CURRENT_SITE', $env_domain_current_site);
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
define('SUNRISE', 'on');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

