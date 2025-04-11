<?php
define( 'WP_CACHE', false ); // Added by WP Rocket

require_once dirname(__FILE__) . '/vendor/autoload.php';
$dotenv = new Dotenv\Dotenv( __DIR__,'../.env' );
$dotenv->load();

define( 'FORCE_SSL_ADMIN', strtolower( getenv( 'FORCE_SSL_ADMIN' ) ) === 'true' );
define( 'FORCE_SSL_LOGIN', strtolower( getenv( 'FORCE_SSL_LOGIN' ) ) === 'true' );

if ( $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
    $_SERVER['HTTPS'] = 'on';
}

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv( 'WPDBNAME' ) );

/** Database username */
define( 'DB_USER', getenv( 'WPUSER') );

/** Database password */
define( 'DB_PASSWORD', getenv( 'WPDBPASS' ) );

/** Database hostname */
define( 'DB_HOST', getenv( 'WPDBHOST' ) );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'RR}*;,/m7^Wn$O;:gAND:12913m@!j7w*z~yu@>BFP7V[rvV4~vSClpCFe5acHH+' );
define( 'SECURE_AUTH_KEY',   'lfl+7n{/3?Xetq:mXI_VhD;cZ-Y-#r*&);K>=6a;3L7v;--O8YF!;HsZlqrQyXw>' );
define( 'LOGGED_IN_KEY',     'R6v`o/`m=jGV|?iS4D5 )M~sU%Q#i?e`UzRQ`Hfe~ToW&D8u`.3/)ddiEI/2TW(Y' );
define( 'NONCE_KEY',         '_IapO@)%:bC}gDb_c{UaWe,w2]c`S44.njjv4he/5@m3YDlttHnOW(#7,>>IIk$N' );
define( 'AUTH_SALT',         'C8r9svUuuu0c)fll)DG.;iw8=lcRh?8zP:!0b.f-@j*&yt@oTm7(;Awl^qi4g;C7' );
define( 'SECURE_AUTH_SALT',  '8~O<f/}gKYn@hAyK!Yp>%LQz%Pr2:r|6yK2:8I=meT9oMVNL_VF8L[JDmxeGsA9}' );
define( 'LOGGED_IN_SALT',    'XIF OZ^gloK})s:{,$Xx3[r]RGG1t/rlN4[lybU<uZV$fw`y&Y@p _-0b|3nLG5&' );
define( 'NONCE_SALT',        '#AjKE|TM2arnV_XujRh3|cyw2L V]nU7oChYSvMP+.*UM[Oi,XN7>yU%$WUUe_@b' );
define( 'WP_CACHE_KEY_SALT', '|&+p63sKC~_#T 6zoims7k<!aC*XUhpQnY@ZlwjIjEj6o4;gBs0t!WXj#<wx>O|}' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', strtolower( getenv( 'WP_DEBUG' ) ) === 'true' );
define( 'WP_DEBUG_DISPLAY', strtolower( getenv( 'WP_DEBUG_DISPLAY' ) ) === 'true' );
define( 'WP_DEBUG_LOG', strtolower( getenv( 'WP_DEBUG_LOG' ) ) === 'true' );
define( 'SCRIPT_DEBUG', strtolower( getenv( 'SCRIPT_DEBUG' ) ) === 'true' );
define( 'SAVEQUERIES', strtolower( getenv( 'SAVEQUERIES' ) ) === 'true' );


/* Add any custom values between this line and the "stop editing" line. */
define( 'WP_CACHE', strtolower( getenv( 'WP_CACHE' ) ) === 'true' ); // WP Rocket needs it true.
define( 'DISABLE_WP_CRON', strtolower( getenv( 'DISABLE_WP_CRON' ) ) === 'true' );
define( 'JWT_AUTH_SECRET_KEY', getenv( 'JWTSECRET' ) );
define( 'RT_WP_NGINX_HELPER_CACHE_PATH', getenv('RT_WP_NGINX_HELPER_CACHE_PATH') );
define( 'WP_MEMORY_LIMIT', getenv('WP_MEMORY_LIMIT') );
define( 'WP_ENVIRONMENT_TYPE', getenv( 'WPENV' ) );

/* Remove theme file editor */
define( 'DISALLOW_FILE_EDIT', true );

if ( 'development' === getenv( 'WPENV' ) ) {
	define( 'WP_CONTENT_DIR', __DIR__ . '/wp-content/' );
	define( 'WP_CONTENT_URL', '/wp-content' );
}

/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . getenv('WPCORE'). '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
