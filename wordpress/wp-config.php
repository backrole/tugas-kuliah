<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pkl_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'U8YC3V{qTH*L{e-# (aDk}/1~AunVJ@QI-2C|RuF#]7-yS11GcYp6r.y3_$!AJ<Z' );
define( 'SECURE_AUTH_KEY',  'x~x-b`_5 8+NNTldkq7t/$~&M Lctlv20y<_q_@gui7}`ozau1!5EMZ&t%nv,F_f' );
define( 'LOGGED_IN_KEY',    'PO`_7Vx8;KP~26iH0v@OFbtJ+rmqI<z]<GTS,otr CXx#yRv<z[JQ<4OR_>qNU7~' );
define( 'NONCE_KEY',        '*qBHM(=9|dg1k`X26C3*mEPIP ]G5lv{z*+W~whLLf <x?%&C3e@ogw5J5zj*hWz' );
define( 'AUTH_SALT',        'WApX%oP[{a,MuFB;Bhaj[O)J+3;hx53<W!>q|kt65#%_}&,$;.iT&C%8AEq},H}.' );
define( 'SECURE_AUTH_SALT', 'pp:(/dcwf[j 6>PN=`/6+}5.fx_$@kh@sicl!w6W`UqakqDYP^+SNi(kofa`)R0s' );
define( 'LOGGED_IN_SALT',   ']QPYz,BbU{)A=Fqx}Q)`}XtstWCn/ZLX5W;+ok9qXO)wxH`U~1-d8(`MPq@=n-/D' );
define( 'NONCE_SALT',       '^GyEsls/NAL$tz0G9aL1ib;e|zIXYGnk&]OhgnJ?}3vGFO)fXf;`mAiISFBPsC*9' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
